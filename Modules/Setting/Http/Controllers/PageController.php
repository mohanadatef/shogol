<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Http\Requests\Page\CreateRequest;
use Modules\Setting\Http\Requests\Page\EditRequest;
use Modules\Setting\Service\PageService;

class PageController extends BasicController
{
    protected $service;

    public function __construct(PageService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:page-index')->only('index');
        $this->middleware('permission:page-create')->only(['create','store']);
        $this->middleware('permission:page-edit')->only(['edit','update']);
        $this->middleware('permission:page-change-status')->only('changeStatus');
        $this->middleware('permission:page-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('setting::page.index'), compact('datas'));
    }

    public function create()
    {
        return view(checkView('setting::page.create'));
    }

    public function store(CreateRequest $request)
    {
        $data= $this->service->store($request);
        if($data)
        {
            return redirect(route('page.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('page.create'))->with(getCustomTranslation('problem'));
    }

    public function edit($id)
    {
        $data = $this->service->show($id);
        ActiveLog($data, actionType()['va'], 'page');
        return view(checkView('setting::page.edit'),compact('data'));
    }

    public function update(EditRequest $request, $id)
    {
        $data= $this->service->update($request,$id);
        if($data)
        {
            return redirect(route('page.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('page.edit'))->with(getCustomTranslation('problem'));
    }
}
