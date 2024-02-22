<?php

namespace Modules\Task\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\Task\Entities\Ad;

class AdRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
       'id','status_id','name','user_id','price','currency_id','created_at', 'country_id', 'city_id', 'state_id','area_id', 'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ad::class;
    }

    public function translationKey()
    {
        return [];
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

    public function findBy(Request $request,$moreConditionForFirstLevel=[],$pagination = false , $perPage = 10,$get='',$orderBy=[],$latest='',$recursiveRel=[],$limit=null)
    {
        return $this->all($request->all(),['*'],[],$recursiveRel,$moreConditionForFirstLevel,[],$orderBy,$get,null,$limit,$pagination,$perPage,$latest);
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
            if (isset($request->document) && !empty($request->document)) {
                $this->media_upload($data, $request, createFileNameServer($this->model(), $data->id), pathType()['up'], mediaType()['dm']);
            }
            if (isset($request->category)) {
                $data->category()->sync((array)$request->category);
            }
            return $this->find($data->id);
        });
    }

    public function changeStatus(Request $request,$id)
    {
       return $this->save($request, $id);
    }

    public function comment(Request $request, $type = null)
    {
        if (!empty($type)) {
            $data = $this->changeStatus($request,$request->id);
            if($data)
            {
                return $data->comment()->create(['type' => $type, 'comment' => $request->comment ?? null, 'done_by' => user()->id ,'cancellation_id'=>$request->cancellation_id ?? 0]);
            }
        }
        return false;
    }

    public function findOne($id)
    {
        return $this->find($id);
    }

}
