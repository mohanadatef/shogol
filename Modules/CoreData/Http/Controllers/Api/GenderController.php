<?php

namespace Modules\CoreData\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Service\GenderService;

class GenderController extends BasicController
{
    private $service;

    public function __construct(GenderService $Service)
    {
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }

}
