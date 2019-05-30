<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }

    public function direction_type()
    {
        return $this->belongsTo('App\DirectionType');
    }
}
