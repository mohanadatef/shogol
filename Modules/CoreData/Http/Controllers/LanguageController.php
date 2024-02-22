<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Language\CreateRequest;
use Modules\CoreData\Http\Requests\Language\EditRequest;
use Modules\CoreData\Service\LanguageService;

class LanguageController extends BasicController
{
    protected $service;

    public function __construct(LanguageService $Service)
    {
        $this->middleware('auth')->except(['language']);
        $this->middleware('permission:language-index')->only('index');
        $this->middleware('permission:language-create')->only('store');
        $this->middleware('permission:language-edit')->only('update');
        $this->middleware('permission:language-change-status')->only('changeStatus');
        $this->middleware('permission:language-delete')->only('delete');
       $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'language');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('coredata::language.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->service->store($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->service->update($request, $id));
    }

    public function language(Request $request)
    {
        //save for 1 month
        return redirect()->back()->withCookie('language', $request->lang, 45000);
    }
}
