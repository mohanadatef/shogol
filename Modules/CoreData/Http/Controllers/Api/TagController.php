<?php

namespace Modules\CoreData\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Service\TagService;

class TagController extends BasicController
{
    private $service;

    public function __construct(TagService $Service)
    {
        $this->service = $Service;
    }

    public function search(Request $request)
    {
        return $this->apiResponse($this->service->search($request),getCustomTranslation('Done'));
    }

}
