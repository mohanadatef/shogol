<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Repositories\ContactUsRepository;

class ContactUsService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(ContactUsRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request, $pagination = false, $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'contact_us');
        return $this->repo->findBy($request,  $pagination, $perPage);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'contact_us');
        return $data;
    }
}
