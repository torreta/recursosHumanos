<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    public function user()
    {
        return $this->belongsToMany('App\User','Associated_To','user_id','enterprise_id');
    }

    public function direction()
    {
        return $this->hasMany('App\Direction');
    }

    public function phone()
    {
        return $this->hasMany('App\Phone');
    }

    protected $table = 'Enterprises';
}
