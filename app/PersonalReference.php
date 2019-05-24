<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalReference extends Model
{
    public function curriculum()
    {
        return $this->belongsTo('App\Curriculum');
    }
}
