<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    public function curriculum()
    {
        return $this->belongsTo('App\Curriculum');
    }

    protected $table = 'Work_Experiences';
}
