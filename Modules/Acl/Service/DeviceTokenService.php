<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Acl\Repositories\DeviceTokenRepository;

class DeviceTokenService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(DeviceTokenRepository $repository)
    {
        $this->repo = $repository;
    }

    public function deleteToken(Request $request)
    {
        $request->merge(['user_id' =>auth()->user()->id]);
        $data = $this->repo->findBy($request,[],[],'first');
        $this->repo->remove($data->id);
        ActiveLog([], actionType()['da'], 'device_token');
        return true;
    }


}
