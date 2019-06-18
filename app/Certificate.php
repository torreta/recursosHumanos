<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function curriculum()
    {
        return $this->belongsTo('App\Curriculum');
    }

    protected $table = 'Certificates';
}
