<?php

namespace App;

class Person extends BaseModel
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
