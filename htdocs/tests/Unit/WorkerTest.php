<?php

namespace Tests\Unit;

use App\Worker;
use Tests\TestCase;

class WorkerTest extends TestCase
{
    /** @test */
    public function it_can_save_meta_with_a_split_date_type()
    {
        $worker = Worker::first();

        // Given that I have an array containing a date with day, month and year
        $date = [
            "TESTFIELD" => [
                "day" => "10",
                "month" => "10",
                "year" => "1980",
            ]
        ];

        // and I try to save it to the json meta fields.
        $worker->saveMetaData('TESTFIELD', $date['TESTFIELD'], '');

        $worker->fresh();

        //dd($worker->meta_data('TESTFIELD'));

        // It should store a datetime string, along with the UK text representation.
        $this->assertEquals('1980-10-10', $worker->meta_data('TESTFIELD')['answer']);
        $this->assertEquals('10/10/1980', $worker->meta_data('TESTFIELD')['text']);
    }

    /** @test */
    public function it_can_get_meta_with_a_split_date_type()
    {
        // Given that I have a date saved as a date time string and UK text representation.

        // and I try to retrieve it from the json meta field.

        // I should have an array containing the day, month and year.
    }
}
