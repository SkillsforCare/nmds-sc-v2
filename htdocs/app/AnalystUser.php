<?php

namespace App;

class AnalystUser
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
        return $this->user->role('analyst-user')->first();
    }
}
