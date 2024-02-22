<?php

namespace Modules\Acl\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Acl\Entities\ForgetPassword;
use Modules\Basic\Repositories\BasicRepository;

class ForgetPasswordRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id', 'code', 'user_id',  'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ForgetPassword::class;
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

    public function findBy(Request $request, $trash = false, $moreConditionForFirstLevel = [], $withRelations = [],$get='',$column = ['*'])
    {
        return $this->all($request->all(), $column, $withRelations, [], $moreConditionForFirstLevel, $trash,[],[],$get);
    }

    public function save(Request $request, $id = null)
    {
        return DB::transaction(function () use ($request, $id) {
            if ($id) {
                $data = $this->update($request->all(), $id);
            } else {
                $data = $this->create($request->all());
            }
            return $data;
        });
    }

}
