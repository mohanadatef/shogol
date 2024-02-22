<?php

namespace Modules\Acl\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Modules\Acl\Http\Requests\User\Api\changePasswordRequest;
use Modules\Acl\Http\Requests\User\Api\CreateRequest;
use Modules\Acl\Http\Requests\User\Api\EmailRequest;
use Modules\Acl\Http\Requests\User\Api\UpdateRequest;
use Modules\Acl\Http\Requests\User\Api\UserNameRequest;
use Modules\Acl\Http\Resources\User\UserProfileResource;
use Modules\Acl\Service\UserService;
use Modules\Basic\Http\Controllers\BasicController;
use PDF;

class UserController extends BasicController
{
    protected $service;

    public function __construct(UserService $Service)
    {
        $this->middleware('auth:api')->only(['update', 'status', 'account', 'changePassword']);
        $this->middleware('permission:user-convert-profile')->only(['account']);
        $this->service = $Service;
    }

    public function store(CreateRequest $request)
    {
        $data = $this->service->store($request);
        if($data)
        {
            return $this->createResponse($data, getCustomTranslation('Register_message'));
        }
        return $this->unKnowError();
    }

    public function verified(Request $request)
    {
        $data = $this->service->verified($request);
        if($data)
        {
            return Route::redirect('https://shogol.sa/settings');
        }
        return $this->unKnowError();
    }

    public function profile(Request $request)
    {
        $data = $this->service->profile($request);
        if($data)
        {
            return $this->apiResponse(new UserProfileResource($data), getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function listFreelancer(Request $request)
    {
        $recursiveRel = [
            'role' => [
                'type' => 'whereHas',
                'recursive' => [
                    'permission' => [
                        'type' => 'whereHas',
                        'where' => ['name' => 'ad-create']
                    ]
                ],
                'where' => ['is_web' => [1]],
            ]
        ];
        $request->merge(['status' => activeType()['as'], 'approve' => approveStatusType()['aa']]);
        return $this->apiResponse($this->service->list($request, $this->pagination(), $this->perPage(), $recursiveRel),
            getCustomTranslation('Done'));
    }

    public function update(UpdateRequest $request, $id)
    {
        if(user()->id == $id)
        {
            $data = $this->service->update($request, $id);
            if($data)
            {
                return $this->updateResponse(new UserProfileResource($data), getCustomTranslation('Done'));
            }
        }
        return $this->unKnowError();
    }

    public function account()
    {
        $data = $this->service->convertAccount(user());
        if($data)
        {
            return $this->updateResponse(new UserProfileResource($data), getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function status()
    {
        $data = $this->service->changeStatus(user()->id, 'available');
        if($data)
        {
            return $this->apiResponse([], getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function changePassword(changePasswordRequest $request)
    {
        $data = $this->service->update($request);
        if($data)
        {
            return $this->updateResponse([], getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function checkUserName(UserNameRequest $request)
    {
        return $this->apiResponse([], getCustomTranslation('Done'));
    }

    public function checkEmail(EmailRequest $request)
    {
        return $this->apiResponse([], getCustomTranslation('Done'));
    }

    public function cv()
    {
        $pdf = PDF::loadView('acl::user.cv.cv');
        return $pdf->download('articles.pdf');
    }

    public function searchTitle(Request $request)
    {
        $user = [];
        if(!empty($request->searchName) && strlen($request->searchName) > 2)
        {
            ActiveLog(null, actionType()['ssea'], $request->searchName, User::class, 1);
            $data = $this->service->findBy(new Request(['fullname' => $request->searchName]), limit: 4);
            $user = $data->pluck('fullname')->toArray();
            if(count($user))
            {
                return $this->apiResponse($user, getCustomTranslation('Done'));
            }
            return $this->apiResponse([], getCustomTranslation('Done'));
        }
        return $this->unKnowError('problem');
    }

    public function deleteProfileExternData(Request $request)
    {
        $data = $this->service->deleteProfileExternData($request);
        if($data)
        {
            return $this->deleteResponse(getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function sendEmailVerified(Request $request)
    {
        $data = $this->service->sendEmailVerified($request);
        if($data)
        {
            return $this->apiResponse([], getCustomTranslation('Done'));
        }
        return $this->unKnowError('problem');
    }
}