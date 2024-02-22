<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Service\ReportService;

class ReportController extends BasicController
{
    protected $service;

    public function __construct(ReportService $Service)
    {
        $this->middleware('auth:api');
        $this->middleware('permission:report-create')->only('store');
        $this->service = $Service;
    }

    public function store(Request $request)
    {
        $data = $this->service->store($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('done'));
        }
        return $this->unKnowError();
    }

}
