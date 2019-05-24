<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentificationType extends Model
{
    public function candidate_profile()
    {
        return $this->hasMany('App\CandidateProfile');
    }
}
