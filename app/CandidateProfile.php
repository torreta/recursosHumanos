<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function identification_type()
    {
        return $this->belongsTo('App\IdentificationType');
    }

    public function curriculum()
    {
        return $this->hasOne('App\Curriculum');
    }

    protected $table = 'Candidate_Profiles';
}
