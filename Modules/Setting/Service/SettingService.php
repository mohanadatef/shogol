<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Acl\Service\UserService;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Service\CategoryService;
use Modules\Setting\Http\Resources\Setting\SettingListResource;
use Modules\Setting\Repositories\SettingRepository;
use Modules\Task\Service\AdService;
use Modules\Task\Service\TaskService;

class SettingService extends BasicService
{
    protected $repo,$taskService,$userService,$adService,$categoryService;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(SettingRepository $repository,TaskService $taskService,UserService $userService,
        AdService $adService,CategoryService $categoryService)
    {
        $this->repo = $repository;
        $this->taskService = $taskService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->adService = $adService;
    }

    public function findBy(Request $request,$get='',$pluck=[])
    {
        return $this->repo->findBy($request,$get,$pluck);
    }

    public function update(Request $request)
    {
        ActiveLog(null, actionType()['ua'], 'setting');
        return $this->repo->save($request);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'setting');
        return SettingListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

    public function taskCount()
    {
       return $this->taskService->findBy(new Request(),get:'count');
    }
    public function userCount()
    {
        $recursiveRel = [
            'role' => [
                'type' => 'whereHas',
                'where' => ['is_web' => [1]],
                'whereIn' => ['id' => [3,4]],
            ]
        ];
       return $this->userService->findBy(new Request(), [], 'count',[],false,0,$recursiveRel);
    }
    public function adCount()
    {
        return $this->adService->findBy(new Request(),get:'count');
    }

    public function categoryCount()
    {
        return $this->categoryService->findBy(new Request(),get:'count');
    }

    public function categoryList(Request $request)
    {
        $request->merge(['status'=>activeType()['as']]);
        return $this->categoryService->findBy($request);
    }
}
