<?php

namespace Tests\Browser\AnalystUser;

use Facades\App\EditUser;
use Facades\App\AnalystUser;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AnalystsCanDownloadTheAnalyticalDBTest extends DuskTestCase
{
    /** @test */
    public function it_can_login_as_an_analyst_and_view_the_report_page()
    {
        $user = AnalystUser::first();

        $this->browse(function (Browser $browser) use($user) {
            $browser->maximize();
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username', $user->username)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/reports')
                    ->assertSee('Hi, ' . $user->person->full_name )
                    ->assertSee('Reports')
                    ->clickLink('Analytical DB Download')
                    ->assertPathIs('/reports/analytical-db-download')
                    ->assertSee('Analytical DB Download');
        });
    }

    /** @test */
    public function it_denies_a_edit_user_access_to_the_report_pages()
    {
        // Given that I am an edit user
        $user = EditUser::first();

        // And I try to access an analyst report page.

        // I shouldn't be allowed and should see a 404 screen.
        $this->browse(function (Browser $browser) use($user) {
            $browser->maximize();
            $browser
                ->loginAs($user)
                ->visit('/reports')
                ->assertSee('Sorry, the page you are looking for could not be found');
        });
    }



}
