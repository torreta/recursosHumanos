<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalProfile extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
