<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Service\NotificationService;
use Symfony\Component\Mime\Message;

class NotificationController extends BasicController
{
    protected $service;

    public function __construct(NotificationService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:notification')->only('index');
        $this->middleware('permission:notification-push')->only(['create','store']);
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        $request->merge(['receiver_id' =>user()->id]);
        ActiveLog(null,actionType()['va'],'notification');
        $datas = $this->service->findBy($request,true,$this->perPage());
        return view(checkView('setting::notification.index'), compact('datas'));
    }
    public function create()
    {
        return view(checkView('setting::notification.push'));
    }

    public function store(Request $request)
    {
        $data= $this->service->push($request);
        if($data)
        {
            return redirect(route('notification.push'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('notification.push'))->with(getCustomTranslation('problem'));
    }

    public function readNotification($id)
    {
        $notification =$this->service->readNotification($id);
        return redirect($notification->urlValue);
    }
    public function systemNotification(Request $request)
    {
        $datas =$this->service->findBy($request,true,$this->perPage());
        ActiveLog(null,actionType()['va'],'notification');
        return view(checkView('setting::notification.index'), compact('datas'));
    }

}
