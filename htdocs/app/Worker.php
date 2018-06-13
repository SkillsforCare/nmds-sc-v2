<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $casts = [
        'meta' => 'array',
    ];

    protected $fillable = [
        'establishment_id',
        'finished_adding_at'
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function answers()
    {
        return $this->hasMany(WorkerQuestionAnswer::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAttentionRequiredAttribute()
    {
        if(empty($this->finished_adding_at)) {
            return [
                'message' => 'Continue with this worker record',
                'url' => route('records.workers.edit', ['worker' => $this, 'group' => QuestionGroup::default()->first()->slug])
            ];
        }

        return null;
    }

    public function getAGEAttribute()
    {
        $dob = $this->meta_data('DOB')['answer'];

        //dd($dob);

        if(!empty($dob))
            return Carbon::parse(build_date($dob))->diffInYears(now());

        return $dob;
    }

    public function getESTNAMEAttribute()
    {
        return $this->establishment->name;
    }


    public function meta_data($field)
    {
        $data = isset($this->meta[$field]) ? $this->meta[$field] : null;

        $question = Question::inCategory('worker')->where('field', $field)->first();

        if($question->field_type == 'date') {

            if(!empty($data['answer'])) {
                $date = Carbon::parse($data['answer']);
                $data['answer'] = [
                    "day" => $date->day,
                    "month" => $date->format('m'),
                    "year" => $date->year,
                ];
                $data['text'] = friendly_date([
                    "day" => $date->day,
                    "month" => $date->format('m'),
                    "year" => $date->year,
                ]);
            }
        }

        return $data;
    }

    public function saveMetaData($field, $answer)
    {
        if(isset($answer)) {

            $meta = $this->meta;

            $question = Question::inCategory('worker')->where('field', $field)->first();

            $text = $question->text_value($answer);

            // Process array types.
            if (is_array($answer)) {

                if (array_has($answer, ["year", "month", "day"])) {
                    $datetime = build_date($answer);
                    $text = friendly_date($answer);

                    $answer = $datetime;
                }
            }

            $meta[$field] = [
                'answer' => $answer,
                'text' => $text
            ];

            $this->meta = $meta;

            $this->save();
        }
    }

    public function scopeInEstablishment($query, $establishment = null) {

        if(empty($establishment))
            $establishment = auth()->user()->person->establishment;

        return $query->whereHas('establishment', function ($query) use ($establishment) {
            $query->where('id', $establishment->id);
        });
    }
}
