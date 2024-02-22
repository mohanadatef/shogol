<?php

namespace Modules\CoreData\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\CoreData\Entities\Language;

class LanguageRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code','id','status'
    ];
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Language::class;
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

    public function findBy(Request $request,$pagination = false , $perPage = 10,$get = '',$recursiveRel =[])
    {
        return $this->all($request->all(),['*'],[], $recursiveRel,[],[],[],$get,null,null,$pagination,$perPage);
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
            return $data;
        });
    }

    public function updateValue($id,$key)
    {
        return  $this->change($this->find($id),$key);
    }

    public function delete($id)
    {
      return  $this->find($id)->delete();
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        return $this->all($request->all(),['*'],[], [],[],[],['column'=>'order','order'=>'asc'],'',null,null,$pagination,$perPage);
    }
}
