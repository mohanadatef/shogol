<?php

namespace Modules\Basic\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Service\LogService;

class LogController extends BasicController
{
    protected $service;

    public function __construct(LogService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:log-system')->only('index');
        $this->middleware('permission:log-search')->only('searchIndex');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view('basic::log.index', compact('datas'));
    }
    public function searchIndex(Request $request)
    {
        $request = $request->merge(['action'=> actionType()['sea']]);
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view('basic::log.search', compact('datas'));
    }

}
