<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Acl\Service\RoleService;
use Modules\Acl\Service\UserService;
use Modules\Task\Service\AdService;
use Modules\Task\Service\TaskService;
use Modules\Basic\Service\BasicService;
use Modules\Basic\Service\LogService;
use Modules\CoreData\Service\CategoryService;
use Modules\CoreData\Service\TagService;
use Modules\Task\Service\OfferService;

class HomeService extends BasicService
{
    protected $taskService, $moreConditionForFirstLevel, $adService, $userService,$roleService,$logService,$offerService,$tagService,$categoryService;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(TaskService $taskService, AdService $adService, UserService $userService,RoleService $roleService,LogService $logService,OfferService $offerService,TagService $tagService,CategoryService $categoryService)
    {
        $this->taskService = $taskService;
        $this->adService = $adService;
        $this->roleService = $roleService;
        $this->userService = $userService;
        $this->logService  = $logService;
        $this->offerService = $offerService;
        $this->tagService = $tagService;
        $this->categoryService = $categoryService;
        $this->moreConditionForFirstLevel['day'] = ['whereBetween' => ['created_at' => [Carbon::today()->toDateTimeString(), Carbon::tomorrow()->toDateTimeString()]]];
  }

    public function getTaskCount()
    {
        $data=[];
        $data []= ['name' => 'day', 'count' => $this->taskService->findBy(new Request(),  false, 0, 'count', $this->moreConditionForFirstLevel['day'])];
        $data []= ['name' => 'total', 'count' => $this->taskService->findBy(new Request(), false, 0, 'count')];
       return $data;
    }

    public function getAdCount()
    {
        $data=[];
        $data[] = ['name' => 'day', 'count' => $this->adService->findBy(new Request(), false, 0, 'count', $this->moreConditionForFirstLevel['day'])];
        $data[] = ['name' => 'total', 'count' => $this->adService->findBy(new Request(), false, 0, 'count')];
     return $data;
    }
    public function getOfferCount()
    {
        $data=[];
        $data[] = ['name' => 'day', 'count' => $this->offerService->findBy(new Request(),  false, 0, 'count', $this->moreConditionForFirstLevel['day'])];
        $data[] = ['name' => 'total', 'count' => $this->offerService->findBy(new Request(),  false, 0, 'count')];
     return $data;
    }
    public function getTagCount()
    {
        $data=[];
        $data[] = ['name' => 'day', 'count' => $this->tagService->findBy(new Request(), false, 0, [],'count' ,$this->moreConditionForFirstLevel['day'])];
        $data[] = ['name' => 'total', 'count' => $this->tagService->findBy(new Request(),  false, 0,[], 'count')];
     return $data;
    }
    public function getCategoryCount()
    {
        $data=[];
        $data[] = ['name' => 'day', 'count' => $this->categoryService->findBy(new Request(), false, 0, [],'count', $this->moreConditionForFirstLevel['day'])];
        $data[]= ['name' => 'total', 'count' => $this->categoryService->findBy(new Request(),  false, 0, [],'count')];
     return $data;
    }

    public function getFreelancerCount()
    {
        $data=[];
            $recursiveRel = [
                'role' => [
                    'type' => 'whereHas',
                    'where' => ['is_web' => [1]],
                    'whereIn' => ['id' => [3,4]],
                ]
            ];
            $data[] = ['name' => 'day', 'count' => $this->userService->findBy(new Request(),  $this->moreConditionForFirstLevel['day'], 'count',[],false,0,$recursiveRel)];
            $data[] = ['name' => 'total', 'count' => $this->userService->findBy(new Request(), [], 'count',[],false,0,$recursiveRel)];

        return $data;
    }
    public function getClientCount()
    {
        $data=[];
            $recursiveRel = [
                'role' => [
                    'type' => 'whereHas',
                    'where' => ['is_web' => [1],'id' => [2]]
                ]
            ];

            $data[] = ['name' => 'day', 'count' => $this->userService->findBy(new Request(),  $this->moreConditionForFirstLevel['day'], 'count',[],false,0,$recursiveRel)];
            $data[] = ['name' => 'total', 'count' => $this->userService->findBy(new Request(), [], 'count',[],false,0,$recursiveRel)];
        return $data;
    }
    public function getVisitorCount()
    {
        $data=[];
        $data[] = ['name' => 'day', 'count' => $this->logService->findBy(new Request(['done_by'=>0]),false,'',[$this->moreConditionForFirstLevel['day']],'ip','count')];
        $data[] = ['name' => 'total', 'count' => $this->logService->findBy(new Request(['done_by'=>0]),false,'',[],'ip','count')];
        return $data;
    }
}
