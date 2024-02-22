<?php

namespace Modules\Acl\Service;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Acl\Events\approveEmailEvent;
use Modules\Acl\Events\verifiedEmailEvent;
use Modules\Acl\Http\Resources\User\UserListResource;
use Modules\Acl\Http\Resources\User\UserLoginResource;
use Modules\Acl\Http\Resources\User\UserProfileResource;
use Modules\Acl\Repositories\UserRepository;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Service\NationalityService;
use App\Providers\notificationEvent;

class UserService extends BasicService
{
    protected $repo, $nationalityService;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repository, NationalityService $nationalityService)
    {
        $this->repo = $repository;
        $this->nationalityService = $nationalityService;
    }

    public function findBy(Request $request, $moreConditionForFirstLevel = [], $get = '', $column = ['*']
        , $pagination = false, $perPage = 10, $recursiveRel = [], $withRelations = [], $orderBy = [], $limit = null)
    {
        return $this->repo->findBy($request, $moreConditionForFirstLevel, $withRelations, $get, $column, $pagination,
            $perPage, $recursiveRel, $limit, $orderBy);
    }

    public function show($id)
    {
        $data = $this->repo->findOne($id);
        ActiveLog($data, actionType()['va'], 'user');
        return new UserLoginResource($data);
    }

    public function changeStatus($id, $key)
    {
        $data = $this->repo->updateValue($id, $key);
        if($data)
        {
            if($key == 'approve')
            {
                ActiveLog($this->repo->findOne($id), actionType()['aa'], 'user');
                $data = $this->repo->save(new Request(['approved_at' => Carbon::now()]), $id);
                event(new approveEmailEvent($data, $this->approveMessage(approveType()['aa']),
                    approveType()['aa'] . '_' . 'email'));
            }else
            {
                ActiveLog($data, actionType()['sa'], 'user');
            }
            return true;
        }
        return false;
    }

    public function rejectApprove(Request $request)
    {
        $data = $this->repo->comment($request, commentType()['rac']);
        ActiveLog($data, actionType()['uaa'], 'user');
        if($data)
        {
            event(new approveEmailEvent($data, $this->approveMessage(approveType()['ra'], $request->comment),
                approveType()['ra'] . '_' . 'email'));
            return true;
        }
        return false;
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'user');
        $data = $this->completeProfileCount($data);
        if($data)
        {
            return new UserProfileResource($data);
        }
        return false;
    }

    public function sendEmailVerified(Request $request)
    {
        $data = $this->repo->findOne($request->id);
        if($data && empty($data->email_verified_at))
        {
            try{
                event(new verifiedEmailEvent($data, $this->verify($data)));
            }catch(\Exception $e)
            {
                ErrorLog('user_email', $e->getMessage());
            }
            return true;
        }
        return false;
    }

    public function update(Request $request)
    {
        $request = new Request($request->except(['mobile', 'username']));
        $data = $this->repo->save($request, $request->id ?? user()->id);
        ActiveLog($data, actionType()['ua'], 'user');
        $data = $this->completeProfileCount($data);
        if($data)
        {
            return $data;
        }
        return false;
    }

    public function convertAccount($user)
    {
        if(permissionShow('user-convert-profile'))
        {
            $request = new Request(['role_id' => 3]);
            $data = $this->repo->save($request, $user->id);
            ActiveLog($data, actionType()['coa'], 'user');
            if($data)
            {
                return $data;
            }
            return false;
        }
        return false;
    }

    /**
     * @param Request $request
     * verified email and @send email for user to wait approve admin
     * @required make this @step in one time and stop him @if @try to make it again
     */
    public function verified(Request $request)
    {
        if($request->id)
        {
            $data = $this->repo->findOne($request->id);
            if($data && empty($data->email_verified_at))
            {
                ActiveLog($data, actionType()['vea'], 'user');
                $newRequest = new Request(['email_verified_at' => Carbon::now()]);
                $this->repo->save($newRequest, $data->id);
                return true;
            }
        }
        return false;
    }

    public function profile(Request $request)
    {
        if(isset($request->id) && !empty($request->id))
        {
            $data = $this->repo->findOne($request->id);
            ActiveLog($data, actionType()['va'], 'user');
            return new UserProfileResource($data);
        }elseif(isset($request->username) && !empty($request->username))
        {
            $request->merge(['role_id' => [2, 3, 4]]);
            $data = $this->repo->findBy($request, get: 'first');
            if($data)
            {
                ActiveLog($data, actionType()['va'], 'user');
                return new UserProfileResource($data);
            }
        }
        return false;
    }

    public function list(Request $request, $pagination = false, $perPage = 10, $recursiveRel = [])
    {
        $moreConditionForFirstLevel = [];
        if($request->search == true)
        {
            $moreConditionForFirstLevel += [
                'whereCustom' => [
                    'orWhere' => [['fullname' => ['like', '%' . $request->search_value . '%']], ['description' => ['like', '%' . $request->search_value . '%']]],
                ]
            ];
            ActiveLog(null, actionType()['sea'], $request->search_value ?? "", null, 1);
        }else
        {
            ActiveLog(null, actionType()['va'], 'user');
        }
        if(isset($request->category))
        {
            $category = [];
            if(is_array($request->category))
            {
                $category = $request->category;
            }elseif(strpos($request->category, ',') !== false)
            {
                $category = explode(',', $request->category);
            }else
            {
                $category = [$request->category];
            }
            if(!empty(array_filter($category)))
            {
                $request->merge(['category' => $category]);
            }
        }
        $role_id = [];
        if(isset($request->freelancer))
        {
            if($request->freelancer == "true")
            {
                $request->merge(['role_id' => array_merge($role_id, [3])]);
            }
        }
        if(isset($request->compnay))
        {
            if($request->compnay == "true")
            {
                $request->merge(['role_id' => array_merge($role_id, [4])]);
            }
        }
        if(isset($request->lat) && isset($request->lan) && !empty($request->lat) && !empty($request->lan))
        {
            $moreConditionForFirstLevel += ['columns' => ['*', DB::raw("SQRT( POW(69.1 * (lat - " . $request->lat . "), 2) + POW(69.1 * (" . $request->lan . " - lan) * COS(lat / 57.3), 2)) AS distance")]];
            $moreConditionForFirstLevel += ['having' => ['distance' => ['<=', '150']]];
        }
        return UserListResource::collection($this->repo->findBy($request, $moreConditionForFirstLevel, [], '', ['*'],
            $pagination, $perPage, $recursiveRel, null, ['column' => 'id', 'order' => 'desc']));
    }

    public function completeProfileCount($data)
    {
        $complete = 0;
        if($data)
        {
            $complete += 25;
            if($data->mobile)
            {
                $complete += 10;
            }
            if($data->category)
            {
                $complete += 10;
            }
            if($data->nationality_id)
            {
                $complete += 5;
            }
            if($data->email)
            {
                $complete += 1;
            }
            if ($data->email_verified_at && !empty($data->email_verified_at)) {
                $complete += 4;
            }
            if(($data->nationality_number && !empty($data->nationality_number)) || ($data->commercial_number && !empty($data->commercial_number)))
            {
                $complete += 5;
            }
            if($data->info && !empty($data->info))
            {
                $complete += 10;
            }
            if($data->avatar)
            {
                $complete += 5;
            }
            if($data->documents)
            {
                $complete += 5;
            }
            if($data->certificate)
            {
                $complete += 5;
            }
            if($data->language)
            {
                $complete += 5;
            }
            if($data->social)
            {
                $complete += 5;
            }
            $request = new Request(['complete_profile' => $complete]);
            return $this->repo->update($request->toArray(), $data->id);
        }
    }

    public function updateCategory(Request $request)
    {
        $newRequest = new Request(['id' => user()->id, 'category' => $request->category]);
        $this->update($newRequest);
    }

    public function deleteProfileExternData(Request $request)
    {
        $data = $this->repo->findOne(user()->id);
        if($request->model == 'social')
        {
            $data->user_social()->where('id', $request->id)->delete();
        }elseif($request->model == 'skill')
        {
            $data->skills()->where('id', $request->id)->delete();
        }
        return true;
    }
}
