<?php

namespace Modules\Acl\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Acl\Service\RoleService;

class RoleController extends BasicController
{
    private $service;

    public function __construct(RoleService $Service)
    {
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        $request->merge(['is_web'=>1]);
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }

}
