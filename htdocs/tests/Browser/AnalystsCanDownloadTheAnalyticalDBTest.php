<?php

namespace Tests\Browser;

use Facades\App\Analyst;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AnalystsCanDownloadTheAnalyticalDBTest extends DuskTestCase
{
    /** @test */
    public function it_can_login_as_an_analyst()
    {
        $user = Analyst::first();

        $this->browse(function (Browser $browser) use($user) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username', $user->username)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/reports')
                    ->assertSee('Hi, ' . $user->person->full_name )
                    ->assertSee('Reports');
        });
    }
}
