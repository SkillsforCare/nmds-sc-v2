<?php

namespace Tests\Feature\EditUser;

use App\Worker;
use Facades\App\EditUser;
use Tests\TestCase;

class EditUsersCanEditWorkersTest extends TestCase
{
    /** @test */
    public function it_can_view_a_worker()
    {
        $user = EditUser::first();

        // As an edit user
        $this->actingAs($user);

        // When I try to access a worker in my organisation
        $worker = Worker::where('establishment_id', $user->person->establishment->id)->first();

        $response = $this->get('/records/workers/' . $worker->id);

        // I can view their worker page.
        $meta = $worker->meta;
        $response->assertSee($meta['UNIQUEWORKERID']['answer']);
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_start_the_worker_wizard() {

        $this->withoutExceptionHandling();

        $user = EditUser::first();

        // As an edit user
        $this->actingAs($user);

        // I can visit the worker wizard.
        $response = $this->get('/records/workers/create');

        $response->assertSee('Add worker');
        $response->assertStatus(200);

        // I can also submit my worker to start the wizard.
        $response = $this->followingRedirects()->post("/records/workers", [
            "UNIQUEWORKERID" => "John Smith",
            "MAINJOBROLE" => collect(config('lookups.mainjobrole'))->random()['value']
        ]);

        $response->assertSeeText('Adding worker: John Smith');
        $response->assertStatus(200);

    }

    /** @test */
    public function it_can_finish_the_worker_wizard() {

        $this->withoutExceptionHandling();

        $user = EditUser::first();
        $worker = Worker::where('establishment_id', $user->person->establishment->id)
            ->whereNull('finished_adding_at')
            ->first();

        // As an edit user
        $this->actingAs($user);

        // I can visit a user that needs to finish the wizard
        $response = $this->get("/records/workers/$worker->id/edit/personal-information");

        $meta = $worker->meta;
        $response->assertSeeText("Adding worker: " . $meta['UNIQUEWORKERID']['answer']);
        $response->assertStatus(200);

        // I can also finish the wizard for my worker.
        $response = $this->followingRedirects()->put("/finish_worker_record/$worker->id/update");
        $response->assertSeeText("Worker record saved!");
    }


    /** @test */
    public function it_cannot_access_a_worker_belonging_to_another_establishment()
    {
        $user = EditUser::first();

        // As an edit user
        $this->actingAs($user);

        // When I try to access a worker in another organisation
        $workerFromAnotherOrg = Worker::where('establishment_id', '!=', $user->person->establishment->id)->first();

        $response = $this->get('/records/workers/' . $workerFromAnotherOrg->id);

        // I shouldn't be allowed and I should see a 404 page.
        $response->assertStatus(403);
    }

    /** @test */
    public function it_cannot_bulk_update_questions_for_a_worker_from_another_establishment()
    {

        $user = EditUser::first();

        // As an edit user
        $this->actingAs($user);

        // When a try to bulk update answers for a worker in another organisation.
        $id = Worker::where('establishment_id', '!=', $user->person->establishment->id)->first()->id;

        $response = $this->put("/question_answers_bulk/$id/update", [
            "UNIQUEWORKERID" => "John Smith"
        ]);

        // I shouldn't be allowed and I should see a 404 page.
        $response->assertStatus(403);

    }

    /** @test */
    public function it_cannot_finish_a_worker_record_from_another_establishment()
    {

        $user = EditUser::first();
        $worker = Worker::where('establishment_id', '!=' ,$user->person->establishment->id)
            ->whereNull('finished_adding_at')
            ->first();

        // As an edit user
        $this->actingAs($user);

        // When a try to finish a record for a worker in another organisation.
        $response = $this->followingRedirects()->put("/finish_worker_record/$worker->id/update");

        // I shouldn't be allowed and I should see a 404 page.
        $response->assertStatus(403);
    }
}
