<?php

namespace Modules\CoreData\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\CoreData\Entities\City;

class CityRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id','country_id','status'
    ];
    /**
     * Configure the Model
     **/
    public function model()
    {
        return City::class;
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
    public function findBy(Request $request,$pagination = false , $perPage = 10,$withRelations=[] ,$get = '',$recursiveRel =[],$pluck=[])
    {
        return $this->all($request->all(),['*'],$withRelations,[], $recursiveRel,$pluck,[],$get,null,null,$pagination,$perPage);
    }

    public function findOne($id)
    {
        return $this->find($id,['*'],['translation.language']);
    }

    public function save(Request $request,$id=null)
    {
        return DB::transaction(function () use ($request,$id) {
            if($id)
            {
                $data = $this->update($request->all(),$id);
            }else{
                $data = $this->create($request->all());
            }
            $this->updateOrCreateLanguage($data,$request,$this->translationKey());
            return $data;
        });
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        $request->merge(['status' => activeType()['as']]);
      return $this->all($request->all(),['*'],[],[],[],[],['column'=>'order','order'=>'asc'],'',null,null,$pagination,$perPage);
    }
}
