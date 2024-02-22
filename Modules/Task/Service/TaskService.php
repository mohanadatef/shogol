<?php

namespace Modules\Task\Service;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Service\CategoryService;
use Modules\Task\Http\Resources\Task\TaskListResource;
use Modules\Task\Http\Resources\Task\TaskResource;
use Modules\Task\Repositories\TaskRepository;
use App\Providers\notificationEvent;
use Modules\Acl\Service\UserService;

/**
 * @extends BasicService
 * service task about function api & dashboard
 */
class TaskService extends BasicService
{
    protected $repo, $categoryService, $userService;

    /**
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository, CategoryService $categoryService, UserService $userService)
    {
        $this->repo = $repository;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @TODO currency manual not automatic
     * @result create new task status 1 new
     * @required user login
     * @if user have old task count max with setting value @can't add
     * @if count setting value 0
     * @if request have freelancer this task is special for him ,but it hasn't this is general can anyone take it
     */
    public function store(Request $request)
    {
        if(user()->task()->whereNotIn('status_id', [statusType()['cs'], statusType()['us'], statusType()['ds']])
                ->count() <= getValueSetting("client_task_count") || getValueSetting("client_task_count") == 0)
        {
            $request->merge(['user_id' => user()->id, 'status_id' => statusType()['as'], 'currency_id' => 1]);
            $request->merge(['document' => array_merge($request->images ?? [], $request->videos ?? [],
                $request->file ?? [])]);
            if(isset($request->freelancer_id) && !empty($request->freelancer_id))
            {
                $request->merge(['type' => taskType()['st'], 'status_id' => statusType()['as']]);
            }else
            {
                $request->merge(['type' => taskType()['gt']]);
            }
            $data = $this->repo->save($request);
            ActiveLog($data, actionType()['ca'], 'task');
            return new TaskResource($data);
        }
        return getCustomTranslation('you_have_many_task');
    }

    /**
     * @param Request $request
     * @param $id
     * @TODO TODO currency manual not automatic
     * @result update task in database
     * @required user login
     * @required user owner this task
     */
    public function update(Request $request, $id)
    {
        $data = $this->repo->findOne($id);
        if($data)
        {
            if(user() && in_array($data->status_id,
                    [statusType()['ns'], statusType()['os'], statusType()['as'], statusType()['ts']]) && user()->id == $data->user_id || (permissionShow('task-edit') && permissionShow('dashboard')))
            {
                if(!isset($request->status_id))
                {
                    $request->merge(['status_id' => statusType()['as']]);
                }
                $request->merge(['document' => array_merge($request->images ?? [], $request->videos ?? [])]);
                $data = $this->repo->save($request, $id);
                ActiveLog($data, actionType()['ua'], 'task');
                return new TaskResource($data);
            }
            return getCustomTranslation('cant_edit');
        }
        return false;
    }

    /**
     * @param Request $request
     * @result get all task in system status 3 active
     */
    public function list(Request $request, $pagination = false, $perPage = 10, $moreConditionForFirstLevel = [])
    {
        $request->merge(['status_id' => statusType()['as']]);
        if($request->search == true)
        {
            $moreConditionForFirstLevel += [
                'whereCustom' => [
                    'orWhere' => [['name' => ['like', '%' . $request->search_value . '%']], ['description' => ['like', '%' . $request->search_value . '%']]],
                ]
            ];
            ActiveLog(null, actionType()['sea'], $request->search_value ?? "",null,1);
        }else
        {
            ActiveLog(null, actionType()['va'], 'task');
        }
        if(isset($request->price))
        {
            $price = [];
            if(is_array($request->price))
            {
                $price = $request->price;
            }elseif(strpos($request->price, ',') !== false)
            {
                $price = explode(',', $request->price);
            }
            if(!empty(array_filter($price)))
            {
                $moreConditionForFirstLevel += ['whereBetween' => ['price' => [$price[0], $price[1]]]];
            }
            unset($request['price']);
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
                $request->merge(['role' => array_merge($role_id, [3])]);
            }
        }
        if(isset($request->compnay))
        {
            if($request->compnay == "true")
            {
                $request->merge(['role' => array_merge($role_id, [4])]);
            }
        }
        $column=['*'];
        if(isset($request->lat) && isset($request->lan) && !empty($request->lat) && !empty($request->lan))
        {
            $moreConditionForFirstLevel += ['columns'=>['*',DB::raw("SQRT( POW(69.1 * (lat - " . $request->lat . "), 2) + POW(69.1 * (" . $request->lan . " - lan) * COS(lat / 57.3), 2)) AS distance")]];
            $moreConditionForFirstLevel += ['having' => ['distance' => ['<=','150']]];
        }

        return TaskListResource::collection($this->repo->findBy($request, $pagination, $perPage, '',
            $moreConditionForFirstLevel, [], ['column' => 'created_at', 'order' => 'desc'],column:$column));
    }

    /**
     * @param Request $request
     * @result get all task in system for this user general
     * @required user login
     */
    public function myList(Request $request, $pagination = false, $perPage = 10)
    {
        $request->merge(['user_id' => user()->id, 'type' => taskType()['gt']]);
        ActiveLog(null, actionType()['va'], 'task');
        return TaskResource::collection($this->repo->findBy($request, $pagination, $perPage, '', [], [],
            ['column' => 'created_at', 'order' => 'desc']));
    }

    public function myListSpecial(Request $request, $pagination = false, $perPage = 10)
    {
        $request->merge(['user_id' => user()->id, 'type' => taskType()['st']]);
        ActiveLog(null, actionType()['va'], 'task');
        return TaskResource::collection($this->repo->findBy($request, $pagination, $perPage, '', [], [],
            ['column' => 'created_at', 'order' => 'desc']));
    }

    public function listCopy(Request $request, $pagination = false, $perPage = 10)
    {
        $request->merge(['category' => user()->category->pluck('id')
            ->toArray(), 'type' => taskType()['gt'], 'status_id' => statusType()['as']]);
        ActiveLog(null, actionType()['va'], 'task');
        $moreConditionForFirstLevel = ['where' => ['user_id' => ['!=', user()->id]]];
        return TaskResource::collection($this->repo->findBy($request, $pagination, $perPage, '',
            $moreConditionForFirstLevel, [], ['column' => 'created_at', 'order' => 'desc']));
    }

    /**
     * @param Request $request
     * @result get all task in system for this user special
     * @required user login
     */
    public function ListSpecial(Request $request, $pagination = false, $perPage = 10)
    {
        $request->merge(['freelancer_id' => user()->id, 'type' => taskType()['st']]);
        ActiveLog(null, actionType()['va'], 'task');
        return TaskResource::collection($this->repo->findBy($request, $pagination, $perPage, '', [], [],
            ['column' => 'created_at', 'order' => 'desc']));
    }

    /**
     * @param Request $request
     * @result get all task in system for this user special
     * @required user login
     */
    public function myListOffer(Request $request, $pagination = false, $perPage = 10)
    {
        $recursiveRel = ['offers' =>
            [
                'type' => 'whereHas',
                'where' => ['user_id' => [user()->id]],
            ]];
        ActiveLog(null, actionType()['va'], 'task');
        return TaskResource::collection($this->repo->findBy($request, $pagination, $perPage, '', [], $recursiveRel,
            ['column' => 'created_at', 'order' => 'desc']));
    }

    /**
     * @param Request $request
     * search in task | get all data in task | get task by status
     */
    public function findBy(Request $request, $pagination = false, $perPage = 10, $get = '',
        $moreConditionForFirstLevel = [], $recursiveRel = [], $limit = null)
    {
        return $this->repo->findBy($request, $pagination, $perPage, $get, $moreConditionForFirstLevel, $recursiveRel,
            ['column' => 'id', 'order' => 'desc'], $limit);
    }

    /**
     * @param Request $request
     * admin reject show this task
     * change status for task and add comment reject
     */
    public function rejectApprove(Request $request)
    {
        $request->merge(['status_id' => statusType()['us']]);
        $data = $this->repo->comment($request, commentType()['rac']);
        ActiveLog($data, actionType()['sa'], 'task');
        $data = $this->repo->save($request, $request->id);
        event(new notificationEvent($data->user, $data, 'reject_Task'));
        if($data)
        {
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * admin approve show this task
     * change status for task
     */
    public function approve($id)
    {
        $data = $this->repo->changeStatus(new Request(['status_id' => statusType()['as']]), $id);
        if($data)
        {
            ActiveLog($data, actionType()['sa'], 'task');
            $data = $this->repo->save(new Request(['approved_at' => Carbon::now()]), $id);
            event(new notificationEvent($data->user, $data, 'approve_Task'));
            $users = $this->userService->findBy(new Request(['category' => $data->category->pluck('id')->toArray()
                /*,'country_id' => $data->country_id, 'city_id' => $data->city_id*/]), [], [], "", [], false,
                [
                    'role' => ['type' => 'whereHas',
                        'where' => ['is_web' => [1]],
                        'recursive' => [
                            'permission' => [
                                'type' => 'whereHas',
                                'where' => ['name' => 'offer-create']
                            ]
                        ]
                    ],
                ]);
            if($users)
            {
                foreach($users as $user)
                {
                    event(new notificationEvent($user, $data, 'new_Task'));
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @param Request $request
     * admin cansel this task or owner task
     */
    public function cansel(Request $request)
    {
        $data = $this->repo->findOne($request->id);
        if($data)
        {
            if(in_array($data->status_id,
                    [statusType()['ns'], statusType()['os'], statusType()['as'], statusType()['ts']]) && ((user() && user()->id == $data->user_id) || permissionShow('task-cansel')))
            {
                $request->merge(['status_id' => statusType()['cs']]);
                ActiveLog($data, actionType()['csa'], 'task');
                $data = $this->repo->comment($request, commentType()['ac']);
                if($data)
                {
                    return true;
                }
                return false;
            }
            event(new notificationEvent($data->user, $data, 'cancel_Task'));
            return getCustomTranslation('cant_edit');
        }
        return false;
    }

    /**
     * @param int $id
     * change status task
     * @result task data
     */
    public function show($id, $view = false)
    {
        $data = $this->repo->findOne($id);
        if($data)
        {
            if($view)
            {
                $data = $this->repo->save(new Request(['view' => $data->view + 1]), $data->id);
            }
            ActiveLog($data, actionType()['va'], 'task');
            if($data->status_id == statusType()['ns'] && user() && permissionShow('task-show'))
            {
                $this->repo->changeStatus(new Request(['status_id' => statusType()['os']]), $data->id);
                event(new notificationEvent($data->user, $data, 'opened_Task'));
            }
            return $data;
        }
        return false;
    }

    /**
     * @required setting value not 0
     * @note this function work in cron job
     * change status task
     */
    public function timeOut()
    {
        if(getValueSetting('time_out_task') != 0)
        {
            $datas = $this->repo->findBy(new Request(['status_id' => statusType()['as']]));
            foreach($datas as $data)
            {
                ActiveLog($data, actionType()['sa'], 'task');
                if($data->approve_at->diffInHours(Carbon::now()) >= getValueSetting('time_out_task'))
                {
                    $this->repo->changeStatus(new Request(['status_id' => statusType()['ts']]), $data->id);
                }
                event(new notificationEvent($data->user, $data, 'time_out_Task'));
            }
        }
    }

    /**
     * @param int $id
     * change status task
     * updated task for request to admin to show it in system again
     */
    public function updateTime(int $id)
    {
        $data = $this->repo->findOne($id);
        if($data)
        {
            ActiveLog($data, actionType()['sa'], 'task');
            $this->repo->changeStatus(new Request(['status_id' => statusType()['ns']]), $data->id);
            $users = $this->userService->findBy(new Request(), [], "", [], false, '',
                ['role' => [
                    'recursive' => [
                        'permission' => [
                            'type' => 'whereHas',
                            'where' => ['name' => 'task-approve']
                        ]
                    ]
                ]]);
            event(new notificationEvent($users, $data, 'update_time_Task'));
            return true;
        }
        return false;
    }

    /**
     * @param Request $request
     */
    public function inProgress(Request $request)
    {
        $data = $this->repo->findOne($request->task_id);
        if($data->status_id == statusType()['as'] && $data->user_id == user()->id)
        {
            ActiveLog($data, actionType()['sa'], 'task');
            $data = $this->repo->update($request->except('task_id'), $request->task_id);
            event(new notificationEvent($data->user, $data, 'inProgress'));
            return $data;
        }
        return false;
    }

    /**
     * change status to done by freelancer
     */
    public function doneFreelancer($id, $request)
    {
        $data = $this->repo->findOne($id);
        if($data->status_id == statusType()['is'] && $data->freelancer_id == user()->id)
        {
            ActiveLog($data, actionType()['sa'], 'task');
            event(new notificationEvent($data->user, $data, 'done_freelancer'));
            $newRequest = new Request($request->except(['done']));
            $newRequest->merge(['id' => $request->id]);
            $this->repo->comment($newRequest, commentType()['dc']);
            $this->repo->changeStatus(new Request(['status_id' => statusType()['dfs']]), $data->id);
            return new TaskResource($this->repo->save($request, $id));
        }
        return false;
    }

    /**
     * @param $id
     * change status to done by freelancer
     */
    public function doneClient($id)
    {
        $data = $this->repo->findOne($id);
        if($data->status_id == statusType()['dfs'] && $data->user_id == user()->id)
        {
            ActiveLog($data, actionType()['sa'], 'task');
            event(new notificationEvent($data->freelancer, $data, 'done_client'));
            return new TaskResource($this->repo->changeStatus(new Request(['status_id' => statusType()['ds']]),
                $data->id));
        }
        return false;
    }

    /**
     * @param $id
     * change status to done by freelancer
     */
    public function unApproveFreelancer(Request $request)
    {
        $data = $this->repo->findOne($request->id);
        if($data->status_id == statusType()['as'] && $data->freelancer_id == user()->id)
        {
            ActiveLog($data, actionType()['sa'], 'task');
            $request->merge(['status_id' => statusType()['ufs'], 'id' => $data->id]);
            $data = $this->repo->comment($request, commentType()['ac']);
            event(new notificationEvent($data->user, $data, 'unApprove_freelancer'));
            return new TaskResource($data);
        }
        return false;
    }

    /**
     * @param $id
     * change status to done by freelancer
     */
    public function unApproveClient(Request $request)
    {
        $data = $this->repo->findOne($request->id);
        if($data->status_id == statusType()['dfs'] && $data->user_id == user()->id)
        {
            ActiveLog($data, actionType()['sa'], 'task');
            $users = $this->userService->findBy(new Request(), ["orWhere" => ['id' => [$data->freelancer]]], "", [],
                false, '',
                ['role' => [
                    'recursive' => [
                        'permission' => [
                            'type' => 'whereHas',
                            'where' => ['name' => 'task-change-status']
                        ]
                    ],
                    'where' => ['is_web' => [0]]
                ]]);
            event(new notificationEvent($users, $data, 'unApprove_freelancer'));
            $request->merge(['status_id' => statusType()['ucs'], 'id' => $data->id]);
            $this->repo->comment($request, commentType()['ac']);
            return new TaskResource($data);
        }
        return false;
    }

    /**
     * @param Request $request
     * comment in over between client and user owner over
     */
    public function comment(Request $request)
    {
        $data = $this->repo->comment($request, commentType()['cc']);
        if($data)
        {
            ActiveLog($data, actionType()['ca'], 'comment');
            return true;
        }
        return false;
    }

    public function getCategoryList()
    {
        return $this->categoryService->list(new Request());
    }

    public function delete($id)
    {
        $data = $this->findBy(new Request(['id' => $id]), false, 0, 'first');
        if($data->offers->count() == 0)
        {
            return $this->repo->delete($id);
        }else
        {
            return false;
        }
    }
}
