<?php

namespace Modules\Acl\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Basic\Repositories\BasicRepository;

class UserRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id', 'approve', 'status', 'gender_id', 'nationality_id', 'nationality_number', 'tax_number','rate','available',
        'category_id', 'mobile', 'username', 'email', 'job_name_id', 'email_verified_at', 'fullname', 'created_at', 'approved_at', 'role_id', 'lang'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
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

    public function findBy(Request $request, $moreConditionForFirstLevel = [], $withRelations = [], $get = '',$column = ['*'],$pagination = false , $perPage = 10,$recursiveRel=[],$limit=null,$orderBy = [])
    {
        return $this->all($request->all(), $column, $withRelations, $recursiveRel, $moreConditionForFirstLevel,
             [], $orderBy, $get,null,$limit,$pagination,$perPage);
    }

    public function findOne($id)
    {
        return $this->find($id, ['*']);
    }

    public function save(Request $request, $id = null)
    {
        return DB::transaction(function () use ($request, $id) {
            if (isset($request->password)) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            if ($id) {
                $data=$this->findOne($id);
                $request->merge(['mobile'=>$data->mobile,'username'=>$data->username,'email'=>$request->email ?? $data->email]);
                $data = $this->update($request->all(), $id);
            } else {
                if (isset($request->role_id) && $request->role_id == 1) {
                    $request->merge(['approve' => approveStatusType()['aa'], 'approved_at' => Carbon::now(), 'email_verified_at' => Carbon::now()]);
                }
                $data = $this->create($request->all());
                Auth::loginUsingId($data->id);
                $token = user()->createToken('Shogol Personal Access Client')->accessToken;
                $data->update(['token' => $token]);
            }
            if (isset($request->category)) {
                $data->category()->sync((array)$request->category);
            }
            if (isset($request->skill) && !empty($request->skill)) {
                $data->skills()->delete();
                foreach ($request->skill as $skill) {
                    $data->skills()->create($skill);
                }
            }
            if (isset($request->document) && !empty($request->document)) {
                $this->media_upload($data, $request, createFileNameServer($this->model(), $data->id), pathType()['up'], mediaType()['dm']);
            }
            if (isset($request->avatar) && !empty($request->avatar)) {
                $this->checkMediaDelete($data, $request, mediaType()['am']);
                $this->media_upload($data, $request, createFileNameServer($this->model(), $data->id), pathType()['ip'], mediaType()['am']);
            }
            if (isset($request->cover) && !empty($request->cover)) {
                $this->checkMediaDelete($data, $request, mediaType()['cm']);
                $this->media_upload($data, $request, createFileNameServer($this->model(), $data->id), pathType()['ip'], mediaType()['cm']);
            }
            if (isset($request->social) && !empty($request->social)) {
                $data->user_social()->delete();
                foreach ($request->social as $social) {
                    $data->user_social()->create($social);
                }
            }
            return isset($id) ? $this->findOne($id) : $this->findOne($data->id);
        });
    }

    public function comment(Request $request, $type = null)
    {
        if (!empty($type)) {
            $data = $this->findOne($request->id);
            $this->save(new Request(['approve' => approveStatusType()['ra']]), $data->id);
            return $data->comment()->create(['type' => $type, 'comment' => $request->comment, 'done_by' => user()->id]);
        }
        return false;
    }

}
