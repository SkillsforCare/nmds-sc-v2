<?php

namespace Tests\Feature\AnalystUser;

use App\AnalyticalDB;
use Facades\App\AnalystUser;
use Tests\TestCase;

class AnalystsCanDownloadTheAnalyticalDBTest extends TestCase
{
    /** @test */
    public function it_can_download_a_zip_file_for_live_worker_historic_data_from_the_report_page()
    {
        // As an analyst user.
        $user = AnalystUser::first();
        $this->actingAs($user);

        // I should be able to download my live analytical db report
        $response = $this->post('/reports/analytical-db-download');

        // and receive a zip file with my report contents.

        $file = 'AGGWP_ANALYSIS_M' . now()->format('Ym')  . '.zip';

        $response->assertHeader(
            'content-disposition',
            'attachment; filename="'. $file . '"');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_download_a_worker_historic_zip_file_from_the_report_page()
    {
        // Given that I am an analyst
        $user = AnalystUser::first();

        // and I am logged in
        $this->actingAs($user);

        // When I select a random download

        $report = AnalyticalDB::inRandomOrder()->first();

        $response = $this->post('/reports/analytical-db-download', [
            'year' => $report->year,
            'month' => $report->month
        ]);

        $now = now();
        $now->year = $report->year;
        $now->month = $report->month;

        $file = 'AGGWP_ANALYSIS_M' . $now->format('Ym')  . '.zip';

        // I should receive a zip file download containing the CSV report.
        $response->assertHeader(
            'content-disposition',
            'attachment; filename="'. $file . '"');
        $response->assertStatus(200);
    }

    /** @test */
    public function the_system_can_generate_a_worker_historic_zip_file_and_store_it_for_download()
    {
        // Given that I am the system

        // I should be able to run a task. On the last day of the month
        $this->artisan('analytical-db:worker-generate', [ 'date' => now()->addYear()->toDateTimeString() ]);

        // and check it has saved.
        $analyticalDB = AnalyticalDB::latest('created_at')->first();
        $file = $analyticalDB->getFirstMedia('analytical-db-worker');

        // and that it produces a zip CSV file for the data in the db.
        $this->assertFileExists($file->getPath());

        // Delete the file.
        $analyticalDB->delete();
    }
}
