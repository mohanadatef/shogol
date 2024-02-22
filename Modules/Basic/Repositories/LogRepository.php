<?php

namespace Modules\Basic\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Entities\Log;

class LogRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id','done_by','action','device','affected_type','search'
    ];
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Log::class;
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
    public function translationKey()
    {
        return [];
    }
    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip;
    }

    public function findBy(Request $request, $pagination = false , $perPage = 10 ,$moreConditionForFirstLevel=[],$distinct = null,$get = '',$groupBy=null,$limit=null,$latest='')
    {
        return $this->all($request->all(), ['*'], [], [], $moreConditionForFirstLevel, [],[],$get,null,$limit,$pagination,$perPage,$latest,$distinct,$groupBy);
    }

    public function save(Request $request, $id = null)
    {
        return DB::transaction(function () use ($request, $id) {
            if ($id) {
                $data = $this->update($request->all(), $id);
            } else {
                $data = $this->create($request->all());
            }
            return $this->findOne($id ?? $data->id);
        });
    }

    public function findOne($id)
    {
        return $this->find($id);
    }
}
