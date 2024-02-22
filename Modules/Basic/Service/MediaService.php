<?php

namespace Modules\Basic\Service;

use Illuminate\Http\Request;
use Modules\Basic\Repositories\MediaRepository;

class MediaService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(MediaRepository $repository)
    {
        $this->repo = $repository;
    }

    public function remove(Request $request)
    {
        if(isset($request->id) && !empty($request->id))
        {
            ActiveLog(null,actionType()['da'],'media');
            return $this->repo->delete($request->id);
        }
        return false;
    }

}
