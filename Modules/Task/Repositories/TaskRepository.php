<?php

namespace Modules\Task\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\Task\Entities\Task;

/**
 * @extends BasicRepository
 * Repository task about function call database
 */
class TaskRepository extends BasicRepository
{
    /**
     * @var array
     * this column can user search by it in any request
     */
    protected $fieldSearchable = [
        'id', 'status_id', 'name', 'country_id', 'city_id', 'state_id', 'type_work', 'user_id', 'price',
        'currency_id', 'freelancer_id', 'time', 'type','created_at','description'
    ];

    /**
     * Configure the Model
     * @uses task
     **/
    public function model()
    {
        return Task::class;
    }

    /**
     * Configure the translation Key
     * @uses task
     **/
    public function translationKey()
    {
        return [];
    }

    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip;
    }

    /**
     * Return searchable fields
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @param Request $request
     * @param $trash
     * search in task | get all data in task
     */
    public function findBy(Request $request,$pagination = false , $perPage = 10,$get='',$moreConditionForFirstLevel=[],$recursiveRel=[],$orderBy=[],$limit=null,$column = ['*'])
    {
        return $this->all($request->all(), $column,[],$recursiveRel,$moreConditionForFirstLevel,[],$orderBy,$get,null,$limit,$pagination,$perPage);
    }

    /**
     * @param Request $request
     * @param $id
     * create or update task in database
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
            if (isset($request->document) && !empty($request->document)) {
                $this->media_upload($data, $request, createFileNameServer($this->model(), $data->id), pathType()['up'], mediaType()['dm']);
            }
            if (isset($request->category) && !empty($request->category)) {
                $data->category()->sync((array)$request->category);
            }
            if (isset($request->done) && !empty($request->done)) {
                $this->media_upload($data, $request, createFileNameServer($this->model(), $data->id), pathType()['up'], mediaType()['dcm']);
            }
            return $this->find($data->id);
        });
    }

    /**
     * @param Request $request
     * @param int $id
     * @return object
     * change status for task
     */
    public function changeStatus(Request $request, int $id): object
    {
        return $this->save($request, $id);
    }

    /**
     * @param Request $request
     * @param $type
     * @return false|object
     * add commit for task
     */
    public function comment(Request $request, $type = null)
    {
        if (!empty($type)) {
            $data = $this->changeStatus($request,$request->id);
            if($data)
            {
                return $data->comment()->create(['type' => $type, 'comment' => $request->comment ?? null, 'done_by' => user()->id ,'cancellation_id'=>$request->cancellation_id ?? 0]);
            }
        }
        return false;
    }

    /**
     * @param int $id
     * get one row in task
     */
    public function findOne(int $id)
    {
        return $this->find($id, ['*']);
    }
}
