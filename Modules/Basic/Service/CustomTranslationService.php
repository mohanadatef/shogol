<?php

namespace Modules\Basic\Service;

use Illuminate\Http\Request;
use Modules\Basic\Http\Resources\CustomTranslation\CustomTranslationListResource;
use Modules\Basic\Http\Resources\CustomTranslation\CustomTranslationResource;
use Modules\Basic\Repositories\CustomTranslationRepository;

class CustomTranslationService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(CustomTranslationRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10,$get='')
    {
        return $this->repo->findBy($request,$pagination,$perPage,$get);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data,actionType()['ca'],'custom_translation');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data=$this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'custom_translation');
        return new CustomTranslationResource($data);
    }

    public function list (Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'custom_translation');
        return CustomTranslationListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

}
