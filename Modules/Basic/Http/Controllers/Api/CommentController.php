<?php

namespace Modules\Basic\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Basic\Service\CommentService;

class CommentController extends BasicController
{
    private $service;

    public function __construct(CommentService $Service)
    {
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }
}
