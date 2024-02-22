<?php

namespace Modules\Acl\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\Acl\Entities\DeviceToken;

class DeviceTokenRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['device_token','user_id'];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DeviceToken::class;
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

    public function findBy(Request $request, $moreConditionForFirstLevel = [], $withRelations = [], $get = '', $column = ['*'],$pagination = false , $perPage = 10,$pluck = [])
    {
        return $this->all($request->all(), $column, $withRelations, [], $moreConditionForFirstLevel,$pluck, [], $get,null,null,$pagination,$perPage);
    }

}
