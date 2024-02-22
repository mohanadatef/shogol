<?php

namespace Modules\CoreData\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\CoreData\Entities\Nationality;

class NationalityRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id','status','code'
    ];
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Nationality::class;
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
    public function findBy(Request $request,$pagination = false , $perPage = 10,$get = '',$recursiveRel =[])
    {
        return $this->all($request->all(),['*'],[],$recursiveRel,[],[],[],$get,null,null,$pagination,$perPage);
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
                $data=$this->update($request->all(),$id);
                $this->checkMediaDelete($data,$request,mediaType()['lm']);
            }else{
                $data = $this->create($request->all());
            }
            $this->media_upload($data,$request,createFileNameServer($this->model(),$data->id),pathType()['ip'], mediaType()['lm']);
            $this->updateOrCreateLanguage($data,$request,$this->translationKey());
            return $data;
        });
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        $request->merge(['status' => activeType()['as']]);
        return $this->all($request->all(),['*'],[], [],[],[],['column'=>'order','order'=>'asc'],'',null,null,$pagination,$perPage);
    }
}
