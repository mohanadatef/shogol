<?php

namespace Modules\Acl\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Acl\Http\Requests\RegisterMobile\Api\CheckMobileRequest;
use Modules\Acl\Service\RegisterMobileService;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Basic\Traits\validationRulesTrait;

class RegisterMobileController extends BasicController
{
    use validationRulesTrait;
    private $service;

    public function __construct(RegisterMobileService $Service)
    {
        $this->service = $Service;
    }

    public function store(Request $request)
    {
        $request->merge(['mobile' => $this->convertPersian($request->mobile)]);
       $data = $this->service->store($request);
       if($data['result'] == true){
           return $this->createResponse($data['data'],getCustomTranslation('code_send'));
       }
       return $this->unKnowError($data['message']??getCustomTranslation('failed'));
    }

    public function check(CheckMobileRequest $request)
    {
        $data = $this->service->check($request);
        if ($data && isset($data['result'])) {
            if ($data['result'] !=false) {
                return $this->apiResponse([], getCustomTranslation($data['message']));
            } else {
                return $this->unKnowError($data['message']);
            }
        }
        return $this->unKnowError(getCustomTranslation('failed'));
    }

    public function resend(Request $request)
    {
        $request->merge(['mobile' => $this->convertPersian($request->mobile)]);
        $data = $this->service->resend($request);
        if($data){
            return $this->createResponse([],getCustomTranslation('code_send'));
        }
        return $this->unKnowError(getCustomTranslation('failed'));
    }
}
