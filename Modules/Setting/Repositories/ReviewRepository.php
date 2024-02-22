<?php

namespace Modules\Setting\Repositories;

use Illuminate\Http\Request;
use Modules\Basic\Repositories\BasicRepository;
use Illuminate\Support\Facades\DB;
use Modules\Setting\Entities\Review;
use App\Models\User;

class ReviewRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['user_id','review_by'];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Review::class;
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

    public function findBy(Request $request, $moreConditionForFirstLevel = [],$get ='',$pagination = false , $perPage = 10,$pluck=[])
    {
        return $this->all($request->all(), ['*'], [], [], $moreConditionForFirstLevel, $pluck, [],$get,null,null,$pagination,$perPage);
    }
    public function findOne($id)
    {
        return $this->find($id,['user_id'],['user']);
    }

    public function save(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $request->merge(['review_by'=>user()->id]);
            $data = $this->create($request->all());
            return $data;
        });
    }
    public function sumReview($id,$type)
    {
       return $this->model->whereHas('user',function($q)use($id){
                 $q->where('id',$id);
                })->sum($type);
    }
}
