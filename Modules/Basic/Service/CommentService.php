<?php

namespace Modules\Basic\Service;

use Illuminate\Http\Request;
use Modules\Basic\Http\Resources\Comment\commentListResource;
use Modules\Basic\Repositories\CommentRepository;

class CommentService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(CommentRepository $repository)
    {
        $this->repo = $repository;
    }

    public function list (Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'Comment');
        return commentListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

}
