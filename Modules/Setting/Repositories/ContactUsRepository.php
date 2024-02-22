<?php

namespace Modules\Setting\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\Setting\Entities\ContactUs;

class ContactUsRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name','id','status','email','mobile','subject'
    ];
    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactUs::class;
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
        return $this->all($request->all(),['*'],[], [],[],[],[],'',null,null,$pagination,$perPage);
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

}
