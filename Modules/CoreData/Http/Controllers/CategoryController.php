<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Category\CreateRequest;
use Modules\CoreData\Http\Requests\Category\EditRequest;
use Modules\CoreData\Service\CategoryService;

class CategoryController extends BasicController
{
    protected $service;

    public function __construct(CategoryService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:category-index')->only('index');
        $this->middleware('permission:category-create')->only('store');
        $this->middleware('permission:category-edit')->only('update');
        $this->middleware('permission:category-change-status')->only('changeStatus');
        $this->middleware('permission:category-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'category');
        $datas = $this->service->findBy($request,true , $this->perPage());
        return view(checkView('coredata::category.index'), compact('datas'));
    }

    public function parent(Request $request)
    {
        return $this->service->parent($request);
    }

    public function create(Request $request)
    {
        $category = $this->service->list($request);
        return view(checkView('coredata::category.create'), compact('category'));
    }

    public function store(CreateRequest $request)
    {
        $data= $this->service->store($request);
        if($data)
        {
            return redirect(route('category.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('category.create'))->with(getCustomTranslation('problem'));
    }

    public function edit($id)
    {
        $data = $this->service->show($id);
        $category = $this->service->list(new Request());
        ActiveLog($data, actionType()['va'], 'category');
        return view(checkView('coredata::category.edit'),compact('data','category'));
    }

    public function update(EditRequest $request, $id)
    {
        $data= $this->service->update($request,$id);
        if($data)
        {
            return redirect(route('category.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('category.edit'))->with(getCustomTranslation('problem'));
    }

}
