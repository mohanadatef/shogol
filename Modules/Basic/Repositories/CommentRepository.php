<?php

namespace Modules\Basic\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Entities\Comment;
use Modules\Basic\Entities\CustomTranslation;

class CommentRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id','type','done_by','comment_id','cancellation_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Comment::class;
    }
    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip;
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
        return $this->model->translationKey();
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10,$get='')
    {
        return $this->all($request->all(), ['*'], [], [], [],[],[],$get,null,null,$pagination,$perPage);
    }

    public function findOne($id)
    {
        return $this->find($id);
    }

    public function save(Request $request, $id = null)
    {
        return DB::transaction(function () use ($request, $id) {
            if ($id) {
                $data = $this->findOne($id);
            } else {
                $data = $this->create($request->all());
            }
            return $this->findOne($id ?? $data->id);
        });
    }

    public function updateValue($id, $key)
    {
        return $this->change($this->find($id), $key);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function restore($id)
    {
        return $this->find($id, ['*'], [], true)->restore();
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        $request->merge(['status' => activeType()['as']]);
        return $this->all($request->all(), ['*'], [], [], [], [], ['column' => 'id', 'order' => 'asc'],'',null,null,$pagination,$perPage);
    }
}
