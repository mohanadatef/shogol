<?php

namespace App\Http\Controllers;

use App\Service\HomeService;
use Modules\Basic\Http\Controllers\BasicController;

class HomeController extends BasicController
{
    protected $service;
    /**
     * @required must user be login
     *
     * @return void
     */
    public function __construct(HomeService $service)
    {
        $this->middleware(['auth','admin']);
        $this->middleware('permission:dashboard')->only('show');
        $this->service = $service;
    }

    /**
     * @result page main in system
     */
    public function index()
    {
        $datas['task'] = $this->service->getTaskCount();
        $datas['ad'] = $this->service->getAdCount();
        $datas['offer'] = $this->service->getOfferCount();
        $datas['tag'] = $this->service->getTagCount();
        $datas['category']= $this->service->getCategoryCount();
        $datas['freelancer'] = $this->service->getFreelancerCount();
        $datas['client'] = $this->service->getClientCount();
        $datas['visitor'] = $this->service->getVisitorCount();
        ActiveLog(null,actionType()['va'],'DashBoard');
        return view(checkView('admin.index'),compact('datas'));
    }

    /**
     * @result page 404
     */
    public function error_404()
    {
        ActiveLog(null,actionType()['va'],'404');
        return view(checkView('errors.404'));
    }
}
