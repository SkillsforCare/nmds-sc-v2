<?php

namespace App\Exports;

use App\Establishment;
use App\Question;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnalyticalDBWorkerExport implements FromQuery, WithHeadings
{
    /**
     * @var Establishment
     */
    private $establishments;
    /**
     * @var Question
     */
    private $questions;

    public function __construct(Establishment $establishments, Question $questions)
    {
        $this->establishments = $establishments;
        $this->questions = $questions;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        $query = \DB::table('establishments')
            ->join('workers', 'establishments.id', '=', 'workers.establishment_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

        dd($query->get());

        return $this->establishments->whereNotNull('updated_at');
    }

    public function headings(): array
    {
        $establishment = $this->questions
            ->inCategory('establishment')
            ->where('field', 'ESTNAME')
            ->pluck('field')
            ->toArray();

        $worker = $this->questions->inCategory('worker')->pluck('field')->toArray();

        return array_merge($establishment, $worker);
    }


}