<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Service\SettingService;
use Modules\Setting\Http\Resources\Setting\HomeSettingListResource;

class SettingController extends BasicController
{
    private $service;

    public function __construct(SettingService $Service)
    {
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        if($request->home == 1)
        {
            $request->merge(['key' => 'home_section']);
            return $this->apiResponse(HomeSettingListResource::collection($this->service->list($request,
                $this->pagination(), $this->perPage())), getCustomTranslation('Done'));
        }
        return $this->apiResponse($this->service->list($request, $this->pagination(), $this->perPage()),
            getCustomTranslation('Done'));
    }

    public function home()
    {
        $task = $this->service->taskCount();
        $user = $this->service->userCount();
        $ad = $this->service->adCount();
        $categoryCount = $this->service->categoryCount();
        $main_category = $this->service->categoryList(new Request(['id' => getSetting('home_main_category')->value]))->first();
        if($main_category)
        {
            $main_category = ['countTask' => $main_category->task()->count() ?? 0, 'countUser' => $main_category->user()->count() ?? 0, 'name' => $main_category->name->value  ?? ""];
        }else{
            $main_category = [];
        }
        if(getSetting('home_category')->value)
        {
        $six_category = $this->service->categoryList(new Request(['id' => getSetting('home_category')->value]));
        }else{
            $six_category=[];
        }
        $category = [];
        foreach($six_category as $six)
        {
            $category[]=['countTask' => $six->task()
                ->count() ?? 0, 'countUser' => $six->user()->count() ?? 0, 'name' => $six->name->value ?? ""];
        }
        return $this->apiResponse(['taskCount' => $task ?? 0, 'userCount' => $user ?? 0, 'adCount' => $ad ?? 0,
            'CategoryCount' => $categoryCount ?? 0, 'mainCategory' => $main_category,
            'category' => $category],
            getCustomTranslation('Done'));
    }
}
