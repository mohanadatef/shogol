<?php

namespace Modules\Setting\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\Setting\Entities\Setting;

class SettingRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
       'id','key','value'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }
    public function translationKey()
    {
        return $this->model->translationKey();
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
    public function findBy(Request $request,$get='',$pluck=[])
    {
        return $this->all($request->all(),['*'],[], [],[],$pluck,[],$get);
    }

    public function save(Request $request)
    {
        return DB::transaction(function () use ($request) {
            foreach ($request->all() as $key => $value) {
                $data = $this->findBy(new Request(['key' => $key]), 'first');
                if ($data) {
                    if($data->key == 'logos') {
                        $this->checkMediaDelete($data,new Request(['logo' => $value]),mediaType()['lm']);
                        $this->media_upload($data, new Request(['logo' => $value]), createFileNameServer($this->model(), $data->id), pathType()['ip'], mediaType()['lm']);
                    }elseif($data->key == 'home_section_1_image' && isset($request->home_section_1_image) && !empty($request->home_section_1_image)) {
                        $this->checkMediaDelete($data,new Request(['image' => $value]),mediaType()['im']);
                        $this->media_upload($data, new Request(['image' => $value]), createFileNameServer($this->model(), $data->id), pathType()['ip'], mediaType()['im']);
                    }elseif($data->key == 'home_section_5_image' && isset($request->home_section_5_image) && !empty($request->home_section_5_image)) {
                        $this->checkMediaDelete($data,new Request(['image' => $value]),mediaType()['im']);
                        $this->media_upload($data, new Request(['image' => $value]), createFileNameServer($this->model(), $data->id), pathType()['ip'], mediaType()['im']);
                    }elseif($data->key == 'home_section_3_image' && isset($request->home_section_3_image) && !empty($request->home_section_3_image)) {
                      foreach($value as $v)
                      {
                        $this->media_upload($data, new Request(['image' => $v]), createFileNameServer($this->model(), $data->id), pathType()['ip'], mediaType()['im']);
                     }
                }elseif($data->key == 'home_category' && isset($request->home_category) && !empty($request->home_category)) {
                        $data->update(['value' => implode(",", $request->home_category)]);
                    }else{
                        $data->update(['value' => $value]);
                    }
                    if(str_contains($data->key, 'home') && in_array($data->key,$this->translationKey()))
                    {
                        $r=new Request([$data->key=>$request->{$data->key}]);
                        $this->updateOrCreateLanguage($data,$r,$this->translationKey());
                    }
                }
            }
            return $data;
        });
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        return $this->all($request->all(),['*'],[], [],[],[],[],'',null,null,$pagination,$perPage);
    }
}
