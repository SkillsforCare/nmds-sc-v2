<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Question extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid_text,
            'number' => $this->number,
            'question' => $this->question,
            'help_text' => $this->help_text,
            'field' => $this->field,
            'field_type' => $this->field_type,
            'order' => $this->order,
            'selected' => false,
            'done' => false
        ];
    }
}
