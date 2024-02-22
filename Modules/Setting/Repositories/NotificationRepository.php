<?php

namespace Modules\Setting\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\Setting\Entities\Notification;
use Carbon\Carbon;

class NotificationRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id', 'status', 'receiver_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Notification::class;
    }

    public function translationKey()
    {
        return $this->model->translationKey();
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip;
    }

    public function findBy(Request $request, $pagination = false, $perPage = 10, $limit = null, $get = '',
        $moreConditionForFirstLevel = [])
    {
        return $this->all($request->all(), ['*'], [], [], $moreConditionForFirstLevel, [], [], $get, null, $limit,
            $pagination, $perPage,);
    }

    public function findOne($id)
    {
        return $this->find($id);
    }

    public function save(Request $request)
    {
        return DB::transaction(function() use ($request)
        {
            $data = $this->create($request->all());
            $this->updateOrCreateLanguage($data, $request, $this->translationKey());
            return $data;
        });
    }

    public function list(Request $request, $pagination, $perPage, $orderBy = [])
    {
        return $this->all($request->all(), ['*'], [], [], [], [], $orderBy, '', null, null, $pagination, $perPage);
    }

    public function readNotification($id)
    {
        $notification = $this->findOne($id);
        if($notification && user()->id == $notification->receiver_id)
        {
            $notification->update(['read_at' => Carbon::now()]);
            return $notification;
        }
        return null;
    }
}
