<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Repositories\ReviewRepository;
use Modules\Acl\Service\UserService;

class ReviewService extends BasicService
{
    protected $repository, $userService;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(ReviewRepository $repository, UserService $userService)
    {
        $this->repo = $repository;
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'Review');
        $countTotal = $this->totalCount($request->user_id);
        $countClientTotal = $this->ClientTotalCount($request->user_id);
        if(isset($request->review))
        {
            $rate = $countTotal ? $this->repo->sumReview($request->user_id,'review') / $countTotal : 0;
            $this->userService->update(new Request([
                'id' => $request->user_id,
                'rate' => $rate ,
            ]));
        }
        if(isset($request->provided))
        {
            $rate_provided = $countTotal ? $this->repo->sumReview($request->user_id,'provided') / $countTotal : 0;
            $this->userService->update(new Request([
                'id' => $request->user_id,
                'rate_provided' => $rate_provided,
            ]));
        }
        if(isset($request->quality))
        {
            $rate_quality = $countTotal ? $this->repo->sumReview($request->user_id,'quality') / $countTotal : 0;
            $this->userService->update(new Request([
                'id' => $request->user_id,
                'rate_quality' => $rate_quality,
            ]));
        }
        if(isset($request->client_rate))
        {
            $client_rate = $countTotal ? $this->repo->sumReview($request->user_id,'client_rate') / $countClientTotal : 0;
            $this->userService->update(new Request([
                'id' => $request->user_id,
                'client_rate' => $client_rate,
            ]));
        }
        $this->userService->update(new Request([
            'id' => $request->user_id,
            'rate_count' => $countTotal,
            'rate_client_count' => $countClientTotal,
        ]));
        return $data;
    }

    public function findBy(Request $request, $get = '', $pagination = false, $perPage = 10)
    {
        return $this->repo->findBy($request, [], $get, $pagination, $perPage);
    }

    public function totalCount($id)
    {
        return $this->repo->findBy(new Request(['user_id' => $id]), ['where'=>['review'=>['!=',0]]], 'count');
    }
    public function clientTotalCount($id)
    {
        return $this->repo->findBy(new Request(['user_id' => $id]), ['where'=>['client_rate'=>['!=',0]]], 'count');
    }
}
