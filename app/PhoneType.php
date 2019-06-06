<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneType extends Model
{
    public function phone()
    {
        return $this->hasMany('App\Phone');
    }

    protected $table = 'Phone_Types';
}
