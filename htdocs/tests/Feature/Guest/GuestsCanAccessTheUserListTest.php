<?php

namespace Tests\Feature\Guest;

use App\AnalyticalDB;
use App\User;
use Facades\App\AnalystUser;
use Tests\TestCase;

class GuestsCanAccessTheUserListTest extends TestCase
{
    /** @test */
    public function it_can_access_the_user_list()
    {
        $this->withoutExceptionHandling();

        // As a guest user

        // I should be able to visit the user list
        $response = $this->get('/users');

        // and see a list of users registered on the system.
        $users = User::with('person', 'roles')->orderBy('username')->get();

        $users->each(function($user) use ($response) {

            $response->assertSeeText($user->person->full_name);

        });

        $response->assertStatus(200);
    }


}
