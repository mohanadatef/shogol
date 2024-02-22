<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Acl\Http\Resources\User\UserListResource;
use Modules\Acl\Repositories\FavouriteRepository;
use Modules\Basic\Service\BasicService;
use Modules\Task\Http\Resources\Ad\AdListResource;
use Modules\Task\Http\Resources\Task\TaskListResource;
use Modules\Task\Service\AdService;
use Modules\Task\Service\TaskService;

class FavouriteService extends BasicService
{
    protected $adService, $taskService, $userService, $repository;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(AdService $adService, TaskService $taskService, UserService $userService, FavouriteRepository $repository)
    {
        $this->adService = $adService;
        $this->taskService = $taskService;
        $this->userService = $userService;
        $this->repo = $repository;
    }

    public function store(Request $request)
    {
        $checkModel = $this->{$request->model . 'Service'} ?? null;
        if ($checkModel) {
            $data = $this->{$request->model . 'Service'}->show($request->id);
            if ($data->favourite()->where('user_id', user()->id)->count()) {
                $data->favourite()->delete();
                ActiveLog($data, actionType()['da'], $request->model);
                return 0;
            } else {
                $data->favourite()->create(['user_id' => user()->id]);
                ActiveLog($data, actionType()['ca'], $request->model);
                return 1;
            }

        }
        return 2;
    }

    public function list(Request $request, $pagination = false, $perPage = 10)
    {
        $request->merge(['user_id' => user()->id]);
        $data = $this->repo->findBy($request, ['where' => ['category_type' => [$request->model]]], $pagination, $perPage, ['category_id', 'category_id'])->toArray();
        if (!empty($data)) {
            if ($request->model == 'ad') {
                return AdListResource::collection($this->adService->findBy(new Request(['id' => $data])));
            } elseif ($request->model == 'task') {
                return TaskListResource::collection($this->taskService->findBy(new Request(['id' => $data])));
            } elseif ($request->model == 'user') {
                return UserListResource::collection($this->userService->findBy(new Request(['id' => $data])));
            }
        }
        return [];
    }

}
