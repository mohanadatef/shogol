<?php

namespace Modules\Task\Service;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Acl\Service\UserService;
use Modules\Basic\Service\BasicService;
use Modules\Task\Http\Resources\Ad\AdListResource;
use Modules\Task\Http\Resources\Ad\AdResource;
use Modules\Task\Repositories\AdRepository;
use App\Providers\notificationEvent;

class AdService extends BasicService
{
    protected $repo, $userService;

    public function __construct(AdRepository $repository, UserService $userService)
    {
        $this->repo = $repository;
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        if (permissionShow('ad-create')) {
            if (user()->ad()->count() <= getValueSetting("freelancer_ad_count") || getValueSetting("freelancer_ad_count") == 0) {
                //ToDo - currency manual not auto
                $request->merge(['user_id' => user()->id, 'status_id' => statusType()['as'], 'currency_id' => 1]);
                $document = [];
                if (isset($request->images)) {
                    $document = array_merge($document, $request->images ?? []);
                }
                if (isset($request->videos)) {
                    $document = array_merge($document, $request->videos ?? []);
                }
                if (isset($request->file) && !empty($request->file)) {
                    $document = array_merge($document, $request->file ?? []);
                }
                $request->merge(['document' => $document]);
                $data = $this->repo->save($request);
                ActiveLog($data, actionType()['ca'], 'ad');
                return new AdResource($data);
            }
            ActiveLog(null, actionType()['pa'], 'problem in create ad');
            return getCustomTranslation('you_have_many_ad');
        }
        ActiveLog(null, actionType()['pa'], 'problem in create ad');
        return getCustomTranslation('only_freelancer');
    }

    public function update(Request $request, $id)
    {
        if (permissionShow('ad-edit')) {
            $data = $this->repo->findOne($id);
            if ($data) {
                if (in_array($data->status_id, [statusType()['as'], statusType()['ts']]) && user()->id == $data->user_id) {
                    $request->merge(['document' => array_merge($request->images ?? [], $request->videos ?? [])]);
                    $data = $this->repo->save($request, $id);
                    ActiveLog($data, actionType()['ua'], 'ad');
                    return new AdResource($data);
                }
                ActiveLog(null, actionType()['pa'], 'problem in update ad');
                return getCustomTranslation('cant_edit');
            }
            ActiveLog(null, actionType()['pa'], 'problem in update ad');
            return false;
        }
        ActiveLog(null, actionType()['pa'], 'problem in update ad');
        return getCustomTranslation('only_freelancer');
    }

    public function list(Request $request, $pagination = false, $perPage = 10)
    {
        $moreConditionForFirstLevel = $recursiveRel = [];
        if ($request->search == true) {
            $moreConditionForFirstLevel += [
                'whereCustom' => [
                    'orWhere' => [['name' => ['like', '%' . $request->search_value . '%']], ['description' => ['like', '%' . $request->search_value . '%']]],
                ]
            ];
            ActiveLog(null, actionType()['sea'], $request->search_value ?? "",null,1);
        } else {
            ActiveLog(null, actionType()['va'], 'ad');
        }
        $request->merge(['status_id' => statusType()['as']]);
        if (isset($request->without)) {
            $moreConditionForFirstLevel = ['whereNot' => ['id' => ['!=', $request->without]]];
        }
        if ($request->popular == true) {
            $request->merge(['id' => $this->popularAdsUser()]);
        }
        if (isset($request->price)) {
            $price = [];
            if (is_array($request->price)) {
                $price = $request->price;
            } elseif (strpos($request->price, ',') !== false) {
                $price = explode(',', $request->price);
            }
            if (!empty(array_filter($price))) {
                $moreConditionForFirstLevel += ['whereBetween' => ['price' => [$price[0], $price[1]]]];
            }
            unset($request['price']);
        }
        if (isset($request->without) && !empty($request->without)) {
            $moreConditionForFirstLevel += ['where' => ['id' => ['!=',$request->without]]];
        }
        if (isset($request->rate_count)) {
            $rate_count = [];
            if (is_array($request->rate_count)) {
                $rate_count = $request->rate_count;
            } elseif (strpos($request->rate_count, ',') !== false) {
                $rate_count = explode(',', $request->rate_count);
            }
            if (!empty(array_filter($rate_count))) {
                $recursiveRel += [
                    'user' => [
                        'type' => 'whereHas',
                        'whereBetween' => ['rate_count' => [$rate_count[0], $rate_count[1]]]
                    ]
                ];
            }
            unset($request['rate_count']);
        }
        if (isset($request->category)) {
            $category = [];
            if (is_array($request->category)) {
                $category = $request->category;
            } elseif (strpos($request->category, ',') !== false) {
                $category = explode(',', $request->category);
            } else {
                $category = [$request->category];
            }
            if (!empty(array_filter($category))) {
                $request->merge(['category' => $category]);
            }
        }
        $role_id = [];
        if (isset($request->freelancer)) {
            if ($request->freelancer == "true") {
                $request->merge(['role' => array_merge($role_id, [3])]);
            }
        }
        if (isset($request->compnay)) {
            if ($request->compnay == "true") {
                $request->merge(['role' => array_merge($role_id, [4])]);
            }
        }
        if(isset($request->lat) && isset($request->lan) && !empty($request->lat) && !empty($request->lan))
        {
            $moreConditionForFirstLevel += ['columns'=>['*',DB::raw("SQRT( POW(69.1 * (lat - " . $request->lat . "), 2) + POW(69.1 * (" . $request->lan . " - lan) * COS(lat / 57.3), 2)) AS distance")]];
            $moreConditionForFirstLevel += ['having' => ['distance' => ['<=','150']]];
        }
        return AdListResource::collection($this->repo->findBy($request, $moreConditionForFirstLevel, $pagination, $perPage, '', ['column' => 'id', 'order' => 'desc'], '', $recursiveRel));
    }

    public function myList(Request $request, $pagination = false, $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'ad');
        $request->merge(['user_id' => user()->id]);
        return AdResource::collection($this->repo->findBy($request, [], $pagination, $perPage, ['column' => 'id', 'order' => 'desc']));
    }

    public function findBy(Request $request, $pagination = false, $perPage = 10, $get = '', $moreConditionForFirstLevel = [], $latest = '', $limit = null)
    {
        return $this->repo->findBy($request, $moreConditionForFirstLevel, $pagination, $perPage, $get, [], $latest, limit: $limit);

    }

    public function cansel(Request $request)
    {
        $data = $this->repo->findOne($request->id);
        if ($data) {
            if (in_array($data->status_id, [statusType()['as'], statusType()['ts']]) && ((user() && user()->id == $data->user_id) || permissionShow('ad-cansel'))) {
                $request->merge(['status_id' => statusType()['cs']]);
                ActiveLog($data, actionType()['csa'], 'ad');
                $data = $this->repo->comment($request, commentType()['ac']);
                if ($data) {
                    return true;
                }
                if (permissionShow('ad-cansel')) {
                    event(new notificationEvent($data->user, $data, 'cancel_ads'));
                }
            }
            return getCustomTranslation('cant_edit');
        }
        return false;
    }

    public function show($id, $view = false)
    {
        $data = $this->repo->findOne($id);
        if ($data) {
            if ($view) {
                $data = $this->repo->save(new Request(['view' => $data->view+1]), $data->id);
            }
            ActiveLog($data, actionType()['va'], 'ad');
        }
        return $data;
    }

    public function timeOut()
    {
        if (getValueSetting('time_out_ad') != 0) {
            $datas = $this->repo->findBy(new Request(['status_id' => statusType()['as']]));
            foreach ($datas as $data) {
                if ($data->updated_at->diffInDays(Carbon::now()) >= getValueSetting('time_out_ad')) {
                    ActiveLog($data, actionType()['sa'], 'ad');
                    $this->repo->changeStatus(new Request(['status_id' => statusType()['ts']]), $data->id);
                    event(new notificationEvent($data->user, $data, 'timeout_ads'));
                }
            }
        }
    }

    public function updateTime($id)
    {
        $data = $this->repo->findOne($id);
        if ($data) {
            ActiveLog($data, actionType()['sa'], 'ad');
            $this->repo->changeStatus(new Request(['status_id' => statusType()['as']]), $data->id);
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $data = $this->repo->findOne($id);
        if ($data->user_id == user()->id || permissionShow('ad-delete')) {
            return $this->repo->delete($id);
        }
        return false;
    }

    public function popularAdsUser()
    {
        $users = $this->userService->findBy(new Request(), [], 'get', [], false, '', ['ad' => ['type' => 'whereHas', 'where' => ['status_id' => [statusType()['as']]]]], [], ['column' => 'rate', 'order' => 'desc']);
        $ads = [];
        foreach ($users as $user) {
            $ads[] = $this->findBy(new Request(['user_id' => $user->id]), false, '', 'first', [], 'latest')->id;
        }
        return $ads;
    }

    public function updateUserCategory(Request $request)
    {
        $this->userService->updateCategory($request);
    }
}
