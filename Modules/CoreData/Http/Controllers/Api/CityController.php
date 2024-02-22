<?php

namespace Modules\CoreData\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Service\CityService;

class CityController extends BasicController
{
    private $service;

    public function __construct(CityService $Service)
    {
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage(),['country']),getCustomTranslation('Done'));
    }

}
