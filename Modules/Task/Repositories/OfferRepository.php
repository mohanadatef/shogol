<?php

namespace Modules\Task\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\Task\Entities\Offer;

/**
 * @extends BasicRepository
 * Repository offer about function call database
 */
class OfferRepository extends BasicRepository
{
    /**
     * @var array
     * this column can user search by it in any request
     */
    protected $fieldSearchable = [
        'id', 'status_id', 'user_id', 'price', 'currency_id', 'time', 'change', 'task_id'
    ];

    /**
     * Configure the Model
     * @uses Offer
     **/
    public function model()
    {
        return Offer::class;
    }

    /**
     * Configure the translation Key
     * @uses Offer
     **/
    public function translationKey()
    {
        return [];
    }

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }
    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip;
    }

    /**
     * @param Request $request
     * @param $trash
     * search in Offer | get all data in Offer
     */
    public function findBy(Request $request,$pagination = false , $perPage = 10,$moreConditionForFirstLevel=[],$get = '',$latest = '',$orderBy=[])
    {
        return $this->all($request->all(), ['*'],[],[],$moreConditionForFirstLevel,[],$orderBy,$get,null,null,$pagination,$perPage,$latest);
    }

    /**
     * @param Request $request
     * @param $id
     * create or update Offer in database
     * @uses transaction for all step
     */
    public function save(Request $request, $id = null)
    {
        return DB::transaction(function () use ($request, $id) {
            if ($id) {
                $data = $this->update($request->all(), $id);
            } else {
                $data = $this->create($request->all());
            }
            return $this->find($data->id);
        });
    }

    /**
     * @param Request $request
     * @param int $id
     * change status for Offer
     */
    public function changeStatus(Request $request, int $id)
    {
        return $this->save($request, $id);
    }

    /**
     * @param Request $request
     * @param $type
     * @return false|object
     * add commit for Offer
     */
    public function comment(Request $request, $type = null)
    {
        if (!empty($type)) {
            if (isset($request->status_id)) {
                $this->changeStatus($request, $request->id);
            }
            $data = $this->findOne($request->id);
            if ($data) {
                $data->comment()->create(['type' => $type, 'comment' => $request->comment ?? null, 'done_by' => user()->id ?? user()->id,'cancellation_id'=>$request->cancellation_id ?? 0]);
                return $data;
            }
        }
        return false;
    }

    /**
     * @param int $id
     * get one row in Offer
     */
    public function findOne(int $id)
    {
        return $this->find($id, ['*']);
    }
}
