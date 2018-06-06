<?php

namespace Tests\Browser;

use Facades\App\Analyst;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AnalystsCanDownloadTheAnalyticalDBTest extends DuskTestCase
{
    /** @test */
    public function it_can_login_as_an_analyst_and_view_the_report_page()
    {
        $user = Analyst::first();

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

        // And I try to access an analyst report page.

        // I shouldn't be allowed and should see a 404 screen.

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );

    }

    /** @test */
    public function it_can_download_a_zip_file_for_live_data_from_the_report_page()
    {
        // Given that I am an analyst

        // and I am logged in

        // and I click the button to download live data

        // I should receive a zip file containing a CSV.

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /** @test */
    public function it_can_download_a_historic_zip_file_from_the_report_page()
    {
        // Given that I am an analyst

        // and I am logged in

        // and I am on the analytic report page

        // When I select the year 2018 and the month of January

        // I should receive

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /** @test */
    public function the_system_can_generate_a_zip_file_and_store_it_for_download()
    {
        // Given that I am an analyst

        // and I am logged in

        // and

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
