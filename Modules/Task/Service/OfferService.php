<?php

namespace Modules\Task\Service;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Entities\Cancellation;
use Modules\Setting\Service\CancellationService;
use Modules\Task\Http\Resources\Offer\OfferListResource;
use Modules\Task\Repositories\OfferRepository;
use App\Providers\notificationEvent;

/**
 * @extends BasicService
 * service Offer about function api
 */
class OfferService extends BasicService
{
    protected $repo, $taskService,$cancellationService;

    /**
     * @param OfferRepository $repository
     */
    public function __construct(OfferRepository $repository, TaskService $taskService,CancellationService $cancellationService)
    {
        $this->repo = $repository;
        $this->taskService = $taskService;
        $this->cancellationService = $cancellationService;
    }


    public function findBy(Request $request,  $pagination = false, $perPage = 10, $get = '', $moreConditionForFirstLevel = [],$latest='')
    {
        return $this->repo->findBy($request,$pagination,$perPage,$moreConditionForFirstLevel,$get,$latest);
    }
    /**
     * @param Request $request
     * @TODO currency manual not automatic
     * @result create new offer status 1 new
     * @required user login
     * task @must by in status in progress 4 for create offer
     */
    public function store(Request $request)
    {
        $task = $this->taskService->show($request->task_id);
        if ($task->status_id == statusType()['as'] && $task->offerActive()->where('user_id', user()->id)->count() == 0 && $task->offer_status) {
            if (permissionShow('offer-create')) {
                $request->merge(['user_id' => user()->id, 'status_id' => statusType()['ns'], 'currency_id' => 1]);
                $data=$this->repo->save($request);
                ActiveLog($data,actionType()['ca'],'offer');
                event(new notificationEvent($task->user,$data,'offer_create'));
                return  ['data' => new OfferListResource($data), 'result' => true];
            }
            return  ['message' => getCustomTranslation('only_freelancer'), 'result' => false];
        }
        return  ['result' => false, 'message' => getCustomTranslation('many_offer')];
    }

    /**
     * @param Request $request
     * @param $id
     * @result update task in database
     * @required user login
     * @required user owner this task
     */
    public function update(Request $request, $id)
    {
        if (permissionShow('offer-edit')) {
            $data = $this->repo->findOne($id);
            if ($data) {
                if (in_array($data->status_id, [statusType()['ns'], statusType()['es']]) && user()->id == $data->user_id && $data->task->status_id == statusType()['as']) {
                    $request->merge(['status_id' => statusType()['ns'], 'change' => 0]);
                    $data=$this->repo->save($request, $id);
                    ActiveLog($data,actionType()['ua'],'offer');
                    event(new notificationEvent($data->task->user,$data,'offer_update'));
                    return new OfferListResource($data);
                }
                return getCustomTranslation('cant_edit');
            }
            return false;
        }
        return getCustomTranslation('only_freelancer');
    }

    /**
     * @param Request $request
     * @result get all offer in task
     */
    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        if (isset($request->task_id)) {
            $request->merge(['status_id' => [statusType()['is'], statusType()['ns'], statusType()['es']]]);
            ActiveLog(null,actionType()['va'],'offer');
            return OfferListResource::collection($this->repo->findBy($request,$pagination,$perPage,[],'','',['column'=>'created_at','order'=>'desc']));
        }
        return [];
    }

    /**
     * @param Request $request
     * @result get all offer for user
     */
    public function myList(Request $request,$pagination = false , $perPage = 10)
    {
        $request->merge(['user_id' => user()->id]);
        ActiveLog(null,actionType()['va'],'offer');
        return OfferListResource::collection($this->repo->findBy($request,$pagination,$perPage,[],'','',['column'=>'created_at','order'=>'desc']));
    }

    /**
     * @param Request $request
     * client reject show this task
     * change status for offer and add comment reject
     */
    public function unApprove(Request $request)
    {
        $data = $this->repo->findOne($request->id);
        if ( $data->task->user_id == user()->id && $data->status_id != statusType()['cs']) {
            $request->merge(['status_id' => statusType()['us']]);
            $data = $this->repo->comment($request, commentType()['rac']);
            if ($data) {
                ActiveLog($data,actionType()['aa'],'offer');
                event(new notificationEvent($data->user,$data,'offer_unApprove'));
                return true;
            }
        }
        return false;
    }

    /**
     * @param int $id
     * client approve offer
     * change status for task to in process 4
     * change status for offer to in process 4
     * change other offer to cansel
     */
    public function approve($id)
    {
        $offer = $this->repo->findOne($id);
        if ($offer->task->user_id == user()->id && $offer->status_id != statusType()['cs']) {
            $data = $this->repo->changeStatus(new Request(['status_id' => statusType()['is']]), $id);
            $task = $this->taskService->inProgress(new Request(['status_id' => statusType()['is'], 'task_id' => $offer->task_id, 'freelancer_id' => $offer->user_id, 'price' => $offer->price, 'time' => $offer->time]));
            event(new notificationEvent($offer->user,$offer,'offer_approve'));
            $offers = $this->repo->findBy(new Request(['task_id'=>$offer->task_id]),false,10,['where'=>['id'=>['!=',$id]]]);
            foreach ($offers as $offer)
            {
                $this->repo->changeStatus(new Request(['status_id' => statusType()['cs']]), $offer->id);
                event(new notificationEvent($offer->user,$data,'offer_unapprove'));
            }
            ActiveLog($data,actionType()['sa'],'offer');
            if ($data && $task) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Request $request
     */
    public function cansel(Request $request)
    {
        $data = $this->repo->findOne($request->id);
        if ($data) {
            if (in_array($data->status_id, [statusType()['ns'], statusType()['ts']]) && user()->id == $data->user_id) {
                $request->merge(['status_id' => statusType()['cs']]);
                if($request->cancellation_id==0)
                {
                    $cancellation = $this->cancellationService->findBy(new Request(['name'=>$request->cancellation_name]));
                    if(count($cancellation))
                    {
                        $cancellation_id = $cancellation->first()->id;
                    }else{
                        //todo
                        $data = Cancellation::create(['order'=>Cancellation::count()+1]);
                        foreach (language() as $lang) {
                            $data->translation()->create(['key' => 'name', 'value' => $request->cancellation_name, 'language_id' => $lang->id]);
                        }
                        $cancellation_id = $data->id;
                    }
                    $request->merge(['cancellation_id'=>$cancellation_id]);
                }
                $data = $this->repo->comment($request, commentType()['ac']);
                if ($data) {
                    ActiveLog($data,actionType()['sa'],'offer');
                    return true;
                }
                return false;
            }
            return getCustomTranslation('cant_edit');
        }
        return false;
    }

    /**
     * @return void
     * @required setting value not 0
     * @note this function work in cron job
     * change status task
     */
    public function timeOut()
    {
        if (getValueSetting('time_out_offer') != 0) {
            $datas = $this->repo->findBy(new Request(['status_id' => statusType()['as']]));
            foreach ($datas as $data) {
                event(new notificationEvent($data->user,$data,'offer_timeout'));
                ActiveLog($data,actionType()['sa'],'offer');
                if ($data->approve_at->diffInHours(Carbon::now()) >= getValueSetting('time_out_offer')) {
                    $this->repo->changeStatus(new Request(['status_id' => statusType()['ts']]), $data->id);
                }
            }
        }
    }

    /**
     * @param int $id
     * change status offer to new
     */
    public function updateTime($id)
    {
        $data = $this->repo->findOne($id);
        if ($data && $data->status_id == statusType()['ts']) {
            $this->repo->changeStatus(new Request(['status_id' => statusType()['ns']]), $data->id);
            ActiveLog($data,actionType()['sa'],'offer');
            return true;
        }
        return false;
    }

    /**
     * @param Request $request
     * comment in offer between client and user owner offer
     */
    public function comment(Request $request)
    {
        $data = $this->repo->comment($request, commentType()['cc']);
        if ($data) {
            ActiveLog($data,actionType()['ca'],'comment');
            return true;
        }
        return false;
    }

    /**
     * @param int $id
     * change status offer to edit price or time
     */
    public function edit($id)
    {
        $data = $this->repo->findOne($id);
        if (in_array($data->status_id, [statusType()['ns']]) && user()->id == $data->task->user_id && $data->change == 1) {
            $this->repo->changeStatus(new Request(['status_id' => statusType()['es']]), $data->id);
            $this->repo->save(new Request(['change'=>2]), $id);
            event(new notificationEvent($data->user,$data,'offer_edit'));
            ActiveLog($data,actionType()['sa'],'offer');
            return true;
        }
        return false;
    }
}
