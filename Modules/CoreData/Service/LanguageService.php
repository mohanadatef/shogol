<?php

namespace Modules\CoreData\Service;

use App\Providers\LanguageTranslationEvent;
use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Language\LanguageListResource;
use Modules\CoreData\Http\Resources\Language\LanguageResource;
use Modules\CoreData\Repositories\LanguageRepository;

class LanguageService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(LanguageRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10,$get = '',$recursiveRel =[])
    {
        return $this->repo->findBy($request,$pagination,$perPage,$get, $recursiveRel);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        event(new LanguageTranslationEvent($data->id));
        ActiveLog($data,actionType()['ca'],'language');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'language');
        return new LanguageResource($data);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'language');
        return LanguageListResource::collection($this->repo->list($request,$pagination,$perPage));
    }
    public function delete($id)
    {
        $recursiveRel = [
        'translation'=> [
            'type' => 'WhereDoesntHave ',
        ],
        'users'=> [
            'type' => 'orWhereDoesntHave ',
        ],
    ];
        $data = $this->findBy(new Request(),false,0,[],'count',$recursiveRel);
        if($data == 0){
            $this->repo->delete($id);
        return true;
        }else{
            return false;
        }
    }

}
