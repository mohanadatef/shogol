<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;

class RegisterMobileService extends BasicService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $data = $this->userService->findBy($request, [], 'count');
        if ($data == 0) {
            $this->sendOTP($request->country_code . $request->mobile);
            return ['result' => true, 'data' => []];
        }
        ActiveLog(null, actionType()['gca'], 'this_mobile_used');
        return ['result' => false, 'message' => getCustomTranslation('this_mobile_used')];
    }

    public function check(Request $request)
    {
        $check = $this->checkOTP($request->country_code .$request->mobile, $request->code);
        if ($check =="incorrect") {
            $check = 0;
        }
        if ($check) {
            ActiveLog(null, actionType()['gca'], 'done');
            return ['result' => $check, 'message' => getCustomTranslation('done')];
        } else {
            ErrorLog('sms_sendOTP', 'error_on_check', $request->mobile);
        }
        return false;
    }

    public function resend(Request $request)
    {
        $user = $this->userService->findBy(new Request(['mobile' => $request->mobile]), [], 'first');
        if (!$user) {
            $this->sendOTP($request->country_code .$request->mobile);
            ActiveLog(null, actionType()['gca'], 'code_send');
            return true;
        }
        ErrorLog('sms_sendOTP', 'error_on_check', $request->mobile);
        return false;
    }
}
