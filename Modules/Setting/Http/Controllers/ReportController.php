<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Service\ReportService;
/**
 * @extends BasicController
 * controller role about web function
 */
class ReportController extends BasicController
{
    protected $service;
    /**
     * @extends BasicController
     * controller role about web function
     */
    public function __construct(ReportService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:report-index')->only('index');
        $this->middleware('permission:report-solved')->only('solved');
        $this->service = $Service;
    }
    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,  $this->perPage());
        return view(checkView('setting::report.index'), compact('datas'));
    }
    public function solved(Request $request,$id)
    {
        return $this->service->changeStatus($id,'solved');
    }
}
