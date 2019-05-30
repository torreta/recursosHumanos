<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }

    public function phone_type()
    {
        return $this->belongsTo('App\PhoneType');
    }
}
