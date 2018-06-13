<?php

namespace Tests\Unit;

use App\Question;
use App\Worker;
use Tests\TestCase;

class WorkerTest extends TestCase
{
    /** @test */
    public function it_can_save_meta_with_a_split_date_type()
    {
        $worker = Worker::first();

        $field = Question::inCategory('worker')->where('field_type', 'date')->first()->field;


        // Given that I have an array containing a date with day, month and year
        $date = [
            $field => [
                "day" => "10",
                "month" => "10",
                "year" => "1980",
            ]
        ];

        // and I try to save it to the json meta fields.
        $worker->saveMetaData($field, $date[$field]);

        $worker->fresh();

        // It should store a datetime string, along with the UK text representation.

        $meta = $worker->meta;

        $this->assertEquals('1980-10-10', data_get($meta, "$field.answer"));
        $this->assertEquals('10/10/1980', data_get($meta, "$field.text"));
    }

    /** @test */
    public function it_can_get_meta_with_a_split_date_type()
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

        $worker->saveMetaData('TESTFIELD', $date['TESTFIELD']);

        $worker->fresh();

        // and I try to retrieve it from the json meta field.
        $field = $worker->meta_data('TESTFIELD');

        // the answer should have an array containing the day, month and year.
        $this->assertEquals([
                "day" => "10",
                "month" => "10",
                "year" => "1980",
        ], $field['answer']);
    }
}
