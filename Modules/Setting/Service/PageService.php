<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Http\Resources\Page\PageListResource;
use Modules\Setting\Repositories\PageRepository;

class PageService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(PageRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'page');
        return $this->repo->findBy($request,$pagination,$perPage);
    }

    public function store(Request $request)
    {
        $data=$this->repo->save($request);
        ActiveLog(null, actionType()['va'], 'page');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data, actionType()['va'], 'page');
        return $data;
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'page');
        return PageListResource::collection($this->repo->list($request,$pagination, $perPage));
    }

}
