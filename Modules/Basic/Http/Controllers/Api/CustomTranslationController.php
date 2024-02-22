<?php

namespace Modules\Basic\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Basic\Service\CustomTranslationService;

class CustomTranslationController extends BasicController
{
    private $service;

    public function __construct(CustomTranslationService $Service)
    {
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }
}
