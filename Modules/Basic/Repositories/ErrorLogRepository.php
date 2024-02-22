<?php

namespace Modules\Basic\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Entities\ErrorLog;

class ErrorLogRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id','type'
    ];
    /**
     * Configure the Model
     **/
    public function model()
    {
        return ErrorLog::class;
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

    public function findBy(Request $request,$pagination = false , $perPage = 10)
    {
        return $this->all($request->all(), ['*'], [], [], [],[],[],'',null,null,$pagination,$perPage);
    }

    public function save(Request $request)
    {
        return DB::transaction(function () use ($request) {
            return $this->create($request->all());
        });
    }
}
