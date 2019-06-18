<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectionType extends Model
{
    public function direction()
    {
        return $this->hasMany('App\Direction');
    }

    protected $table = 'Direction_Types';
}
