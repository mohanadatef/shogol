<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Http\Requests\Setting\EditRequest;
use Modules\Setting\Service\SettingService;

class SettingController extends BasicController
{
    protected $service;

    public function __construct(SettingService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:setting-edit')->only('edit');
        $this->middleware('permission:setting-home')->only('home');
        $this->service = $Service;
    }

    public function edit(Request $request)
    {
        $datas = $this->service->findBy($request,'',['value','key']);
        ActiveLog(null, actionType()['va'], 'setting');

        return view('setting::setting.edit',compact('datas'));
    }
    public function home(Request $request)
    {
        $request->merge(['key'=>'home']);
        $datas = $this->service->findBy($request,'',['value','key']);
        $category = $this->service->categoryList(new Request());
        ActiveLog(null, actionType()['va'], 'setting home');
        return view('setting::setting.home',compact('datas','category'));
    }


    public function update(EditRequest $request)
    {
        $data= $this->service->update($request);
        if($data)
        {
            return redirect(route('setting.edit'))->with(getCustomTranslation('Done'));
        }
        return redirect()->back()->with(getCustomTranslation('problem'));
    }


}
