<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssociatedTo extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }

    protected $table = 'Associated_To';
}
