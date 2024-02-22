<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;

class ForgetPasswordService extends BasicService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $user = $this->getUser($request);
        if($user)
        {
            ActiveLog($user, actionType()['gca'], 'code_send');
            $otp = $this->sendOTP($request->country_code . $request->mobile);
            if($otp == true)
            {
                return $user;
            }else
            {
                return false;
            }
        }
        ActiveLog(null, actionType()['gca'], 'problem');
        return false;
    }

    public function check(Request $request)
    {
        $user = $this->getUser($request);
        if($user)
        {
            $check = $this->checkOTP($request->country_code . $request->mobile, $request->code);
            if($check == "incorrect")
            {
                $check = 0;
            }
            if($check)
            {
                ActiveLog($user, actionType()['gca'], 'done');
                return ['result' => $user, 'message' => getCustomTranslation('done')];
            }else
            {
                ErrorLog('sms_sendOTP', 'error_on_check', $request->mobile);
            }
        }
        ActiveLog(null, actionType()['gca'], 'problem');
        return false;
    }

    public function changePassword(Request $request)
    {
        $user = $this->getUser($request);
        if($user)
        {
            $newRequest = new Request($request->except(['mobile', 'status']));
            $newRequest->merge(['id' => $user->id]);
            $data = $this->userService->update($newRequest);
            if($data)
            {
                ActiveLog($data, actionType()['gca'], 'password_change');
                return true;
            }
            ActiveLog($data, actionType()['gca'], 'problem');
        }
        return false;
    }

    public function getUser(Request $request)
    {
        if(isset($request->user_id) || isset($request->id) || isset($request->mobile))
        {
            return $this->userService->findBy($request, [], 'first', ['id', 'mobile']);
        }
        return null;
    }
}
