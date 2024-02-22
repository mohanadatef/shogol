<?php

namespace Modules\Acl\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Acl\Http\Requests\Login\Api\LoginRequest;
use Modules\Acl\Http\Resources\User\UserLoginResource;
use Modules\Acl\Service\UserService;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Acl\Service\DeviceTokenService;

/**
 * @extends BasicController
 * controller auth for login and auth function
 */
class AuthController extends BasicController
{
    protected $deviceTokenService, $userService;

    public function __construct(DeviceTokenService $deviceTokenService, UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->deviceTokenService = $deviceTokenService;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * can login by mobile or email or username
     * @must by status => active 1,make confirm email , approve by admin
     */
    public function login(LoginRequest $request)
    {
        $moreConditionForFirstLevel = [
            'whereCustom' => [
                'where' => [['email' => $request->email], ['username' => $request->email], ['mobile' => ['like','%'.$request->email.'%']]],
            ]
        ];
        $recursiveRel = ['role' =>
            [
                'type' => 'whereHas',
                'where' => ['is_web' => [1]],
            ]];
        $user = $this->userService->findBy(new Request(), $moreConditionForFirstLevel, 'first', ['*'], false, 10, $recursiveRel, ['avatar','gender', 'job_name',  'nationality', 'social', 'category']);
        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                ActiveLog($user, actionType()['la'], 'failed_password');
                return $this->unauthorizedResponse(getCustomTranslation('failed_password'));
            }
            if ($user->email_verified_at == null && $user->role->is_verified) {
                ActiveLog($user, actionType()['la'], 'verified');
                return $this->unauthorizedResponse(getCustomTranslation('verified'));
            }
            if ($user->status == activeType()['us']) {
                ActiveLog($user, actionType()['la'], 'support');
                return $this->unauthorizedResponse(getCustomTranslation('support'));
            }
            if ($user->approve != approveStatusType()['aa'] && $user->role->is_approve) {
                ActiveLog($user, actionType()['la'], 'approve');
                return $this->unauthorizedResponse(getCustomTranslation('approve'));
            }
            Auth::loginUsingId($user->id);
            $token = user()->createToken('Shogol Personal Access Client')->accessToken;
            $user->update(['token' => $token]);
            if ($request->device_token) {
                $user->deviceTokens()->firstOrCreate(['device_token' => $request->device_token]);
            }
            ActiveLog($user, actionType()['la'], 'login');
            return $this->apiResponse(new UserLoginResource($user), getCustomTranslation('login'));
        } else {
            ActiveLog(null, actionType()['la'], 'failed');
            return $this->unauthorizedResponse(getCustomTranslation('failed'));
        }
    }

    public function logout(Request $request)
    {
        $this->deviceTokenService->deleteToken($request);
        user()->token()->revoke();
        ActiveLog([], actionType()['loa'], 'logout');
        return $this->apiResponse([], getCustomTranslation('logout_done'));
    }

    /**
     * check if header have token so send data for user login
     */
    public function getUserByToken()
    {
        if (user()) {
            return $this->apiResponse(new UserLoginResource(user()), getCustomTranslation('done'), 200);
        }
        return $this->unauthorizedResponse(getCustomTranslation('failed'));
    }
}
