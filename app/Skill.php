<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function curriculum()
    {
        return $this->belongsTo('App\Curriculum');
    }
}
