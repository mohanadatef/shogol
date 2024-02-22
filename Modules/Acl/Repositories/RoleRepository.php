<?php

namespace Modules\Acl\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Acl\Entities\Role;
use Modules\Basic\Repositories\BasicRepository;

class RoleRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id','is_approve', 'is_report', 'is_verified', 'is_web'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
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
        return $this->model->translationKey();
    }

    public function findBy(Request $request,$get = '',$pagination = false , $perPage = 10)
    {
        return $this->all($request->all(), ['*'], [], [], [], [], [], $get,null,null,$pagination,$perPage);
    }

    public function findOne($id)
    {
        return $this->find($id);
    }

    public function save(Request $request,$id=null)
    {
        return DB::transaction(function () use ($request,$id) {
            if($id)
            {
                $data=$this->update($request->all(),$id);
            }else{
                $data = $this->create($request->all());
            }
            $this->updateOrCreateLanguage($data,$request,$this->translationKey());
            $data->permission()->sync((array)$request->permission);
            return $data;
        });
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        return $this->all($request->all(),['*'],[], [],[],[],[],'',null,null,$pagination,$perPage);
    }

}
