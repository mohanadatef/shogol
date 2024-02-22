<?php

namespace Modules\Basic\Service;

use Illuminate\Http\Request;
use Modules\Basic\Repositories\LogRepository;

class LogService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     * @return void
     */

    public function __construct(LogRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10,$moreConditionForFirstLevel=[],$distinct=null,$get='',$groupBy=null,$limit=null,$latest='')
    {
        ActiveLog(null,actionType()['va'],'log');
        return $this->repo->findBy($request,$pagination,$perPage,$moreConditionForFirstLevel,$distinct,$get, $groupBy,$limit,$latest);
    }

    public function store(Request $request)
    {
        return $this->repo->save($request);
    }

    public function update(Request $request,$id)
    {
        return $this->repo->save($request,$id);
    }

}
