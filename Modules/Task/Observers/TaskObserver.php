<?php

namespace Modules\Task\Observers;

use App\Providers\notificationEvent;
use Illuminate\Http\Request;
use Modules\Acl\Service\UserService;
use Modules\Task\Entities\Task;
use Modules\Task\Service\TaskService;

class TaskObserver
{
    protected $service,$userService;
    public function __construct(TaskService $service,UserService $userService)
    {
        $this->service = $service;
        $this->userService = $userService;
    }
    /**
     * Handle the Task "created" event.
     *
     * @param    $data
     * @return void
     */
    public function created(Task $data)
    {
        ActiveLog($data, actionType()['ca'], 'task');
        if (getValueSetting('is_send_notification')) {
            $users = $this->userService->findBy(new Request(), [], "", [], false, 10,
                ['role' => ['type' => 'whereHas',
                    'where' => ['is_web' => [0]],
                    'recursive' => [
                        'permission' => [
                            'type' => 'whereHas',
                            'where' => ['name' => 'task-approve']
                        ]
                    ]
                ]]);
            event(new notificationEvent($users, $data, 'create_Task'));
        }
    }

    /**
     * Handle the Task "updated" event.
     *
     * @param    $data
     * @return void
     */
    public function updated(Task $data)
    {
        $users = $this->userService->findBy(new Request(), [], "", [], false, '',
            ['role' => ['type' => 'whereHas',
                'where' => ['is_web' => [0]]
            ]]);
        event(new notificationEvent($users, $data, 'update_Task'));
        ActiveLog($data, actionType()['ua'], 'task');
    }

    /**
     * Handle the Task "deleted" event.
     *
     * @param    $data
     * @return void
     */
    public function deleted(Task $data)
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     *
     * @param    $data
     * @return void
     */
    public function restored(Task $data)
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     *
     * @param    $data
     * @return void
     */
    public function forceDeleted(Task $data)
    {
        //
    }
}
