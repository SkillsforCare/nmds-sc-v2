<?php

namespace Tests\Feature;

use Tests\TestCase;

class AnalystsCanDownloadTheAnalyticalDBTest extends TestCase
{
    /** @test */
    public function it_can_login_an_analyst()
    {
        $this->withoutExceptionHandling();


        // As an analyst user.
        $analystUser = Analyst::first()->user;


        // I can login to the system
        $this->


        // And access my reports page.


        $response = $this
            ->followingRedirects()
            ->get('/');

        $response->assertStatus(200);
    }
}
