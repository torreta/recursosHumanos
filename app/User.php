<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function personal_profile()
    {
        return $this->hasOne('App\PersonalProfile');
    }

    public function user_status()
    {
        return $this->hasOne('App\UserStatus');
    }

    /*public function user_role()
    {
        return $this->hasMany('App\UserRole');
    }*/

    public function roles()
    {
        return $this->belongsToMany('App\Role','User_Roles','user_id','role_id');
    }

    public function candidate_profile()
    {
        return $this->hasOne('App\CandidateProfile');
    }

    public function enterprise()
    {
        return $this->belongsToMany('App\Enterprise','Associated_To','user_id','enterprise_id');
    }

    public function direction()
    {
        return $this->hasMany('App\Direction');
    }

    public function phone()
    {
        return $this->hasMany('App\Phone');
    }
    protected $table = 'Users';






    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   /* protected $fillable = [
        'name', 'email', 'password',
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   /* protected $hidden = [
        'password', 'remember_token',
    ];*/

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
  /*  protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
}
