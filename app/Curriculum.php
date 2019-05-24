<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'Curriculums';

    public function work_experience()
    {
        return $this->hasMany('App\WorkExperience');
    }

    public function skill()
    {
        return $this->hasMany('App\Skill');
    }

    public function reference()
    {
        return $this->hasMany('App\PersonalReference');
    }

    public function cerfiticate()
    {
        return $this->hasMany('App\Certificate');
    }

    public function candidate_profile()
    {
        return $this->belongsTo('App\CandidateProfile');
    }
}
