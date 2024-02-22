<?php

namespace Modules\Setting\Repositories;

use Illuminate\Http\Request;
use Modules\Basic\Repositories\BasicRepository;
use Modules\Setting\Entities\Report;
use Illuminate\Support\Facades\DB;

class ReportRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['user_id','solved'];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Report::class;
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

    public function translationKey()
    {
        return [];
    }

    public function findBy(Request $request, $moreConditionForFirstLevel = [],$pagination = false , $perPage = 10,$pluck=[])
    {
        return $this->all($request->all(), ['*'], [], [], $moreConditionForFirstLevel, $pluck, [], '',null,null,$pagination,$perPage);
    }

    public function save(Request $request, $id = null)
    {
        return DB::transaction(function () use ($request, $id) {
            if ($id) {
              $data = $this->update($request->all(),$id);
             }
            return $data;
        });
    }


}
