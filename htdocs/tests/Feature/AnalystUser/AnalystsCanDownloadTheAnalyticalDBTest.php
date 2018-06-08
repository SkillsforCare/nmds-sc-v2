<?php

namespace Tests\Feature\AnalystUser;

use Facades\App\AnalystUser;
use Tests\TestCase;

class AnalystsCanDownloadTheAnalyticalDBTest extends TestCase
{
    /** @test */
    public function it_can_download_a_zip_file_for_live_data_from_the_report_page()
    {
        // As an analyst user.
        $user = AnalystUser::first();
        $this->actingAs($user);

        // I should be able to download my live analytical db report
        $response = $this->post('/reports/analytical-db-download');

        // and receive a zip file with my report contents.
        $file = 'analytical-db-download-' . str_slug(now()->toDateTimeString()) . '.csv';

        //dd($response->headers);


        $response->assertHeader(
            'content-disposition',
            'attachment; filename="'. $file . '"');
        $response->assertStatus(200);
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
