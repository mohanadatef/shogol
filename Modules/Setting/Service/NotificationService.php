<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Http\Resources\notification\NotificationListResource;
use Modules\Setting\Repositories\NotificationRepository;
use Illuminate\Support\Facades\Notification;
use Modules\Setting\Notifications\pushNotification;
use Modules\Acl\Service\UserService;
use Modules\Setting\Notifications\SystemNotification;


class NotificationService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(NotificationRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10,$limit=null ,$get='',$moreConditionForFirstLevel=[])
    {
        return $this->repo->findBy($request,$pagination,$perPage,$limit,$get,$moreConditionForFirstLevel);
    }

    public function store(Request $request)
    {
        return $this->repo->save($request);
    }

    public function push(Request $request)
    {
        $users = app()->make(UserService::class)->findby($request);
        $this->sendNotification($users,[],'push',$request);
        ActiveLog([], actionType()['ca'], 'Notification');
        return true;
    }

    public function readNotification($id)
    {
        $data=$this->repo->readNotification($id);
        ActiveLog($data, actionType()['read'], 'Notification');
        return $data;
    }
    public function sendNotification($users,$data,$key,$request=null)
    {
                if($key == 'approved_user'){
                    Notification::send($users, new SystemNotification($key,$data,'user'));
                }elseif($key == 'timeout_Ads'|| $key == 'cancel_Ads'){
                    Notification::send($users, new SystemNotification($key,$data,'ad'));
                }elseif(str_contains(strtolower($key),'task')||in_array($key,[ 'done_freelancer','done_client','unApprove_freelancer','opened_Task'])){
                    Notification::send($users, new SystemNotification($key,$data,'task'));
                }elseif(str_contains(strtolower($key) ,'offer')){
                    $data = $data->task;
                    Notification::send($users, new SystemNotification($key,$data,'offer'));
                }elseif($key == 'push'){
                    Notification::send($users, new pushNotification($key,$data,$request));
                }
    }

    public function list(Request $request,$pagination,$perPage)
    {
        $data=$this->repo->list($request,$pagination,$perPage,['column'=>'id','order'=>'desc']);
        ActiveLog(null, actionType()['va'], 'notification');
        return NotificationListResource::collection($data);
    }
}
