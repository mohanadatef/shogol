<?php

namespace Modules\Acl\Observers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Acl\Events\verifiedEmailEvent;
use Modules\Acl\Service\UserService;

class UserObserver
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->service->completeProfileCount($user);
        ActiveLog($user, actionType()['ca'], 'user');
        if ($user->role->is_verified) {
            try{
                event(new verifiedEmailEvent($user, $this->service->verify($user)));
            }catch(\Exception $e)
            {
                ErrorLog('user_email', $e->getMessage());
            }
        } else {
            $this->service->verify(new Request(['id' => $user->id]));
        }
        if (!$user->role->is_approve) {
            $this->service->update( new Request(['id'=>$user->id,'approve' => approveStatusType()['aa'], 'approved_at' => Carbon::now()]));
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->service->completeProfileCount($user);
        ActiveLog($user, actionType()['ua'], 'user');
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
