<?php

namespace App\Policies;

use App\User;
use App\Worker;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the worker.
     *
     * @param  \App\User  $user
     * @param  \App\Worker  $worker
     * @return mixed
     */
    public function view(User $user, Worker $worker)
    {
        return $this->userHasRoleIsSameEstablishmentAsWorker($user, $worker);
    }

    /**
     * Determine whether the user can create workers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole(['edit-user']);
    }

    /**
     * Determine whether the user can update the worker.
     *
     * @param  \App\User  $user
     * @param  \App\Worker  $worker
     * @return mixed
     */
    public function update(User $user, Worker $worker)
    {


        return $this->userHasRoleIsSameEstablishmentAsWorker($user, $worker);
    }

    /**
     * Determine whether the user can delete the worker.
     *
     * @param  \App\User  $user
     * @param  \App\Worker  $worker
     * @return mixed
     */
    public function delete(User $user, Worker $worker)
    {
        return $this->userHasRoleIsSameEstablishmentAsWorker($user, $worker);
    }

    private function userHasRoleIsSameEstablishmentAsWorker($user, $worker)
    {
        return $user->hasRole(['edit-user']) and $user->person->establishment_id === $worker->establishment_id;
    }
}
