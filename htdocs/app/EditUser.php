<?php

namespace App;

class EditUser
{
    /**
     * @var User
     */
    private $user;

    /**
     * Analyst constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function first()
    {
        return $this->user->role('edit-user')->first();
    }
}
