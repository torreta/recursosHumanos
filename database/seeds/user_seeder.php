<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRole;
use App\PersonalProfile;
use App\CandidateProfile;
use App\IdentificationType;
use App\Curriculum;
use Illuminate\Support\Facades\Hash;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//------Candidato
        $user = new User();
    	$user->email = 'kevin@email.com';
    	$user->password = Hash::make('Pruebas123');
    	$user->user_status_id = "1";
    	$saved = $user->save();
    	$user_role = new UserRole();
    	$user_role->user_id = $user->id;
    	$user_role->role_id = "1";
    	$user_role->save();
		$personal_profile = new PersonalProfile();
		$personal_profile->first_name = 'Kevin';
		$personal_profile->last_name = 'Miranda';
    	$personal_profile->user_id =$user->id;
    	$personal_profile->save();
    	$candidate_profile = new CandidateProfile();
    	$identification_type = DB::table('Identification_Types')->where('name', 'V')->value('id');
    	$candidate_profile->identification_type_id = $identification_type;
    	$candidate_profile->identification_number = '26150260';
    	$candidate_profile->user_id = $user->id;
    	$candidate_profile->save();
    	$curriculum = new Curriculum();
    	$curriculum->candidate_profile_id = $candidate_profile->id;
    	$curriculum->save();

    	//-------Moderador
        $user = new User();
    	$user->email = 'luis@email.com';
    	$user->password = Hash::make('Pruebas123');
    	$user->user_status_id = "1";
    	$saved = $user->save();
    	$user_role = new UserRole();
    	$user_role->user_id = $user->id;
    	$user_role->role_id = "3";
    	$user_role->save();
		$personal_profile = new PersonalProfile();
		$personal_profile->first_name = 'Luis';
		$personal_profile->last_name = 'Campos';
    	$personal_profile->user_id =$user->id;
    	$personal_profile->save();
    	$candidate_profile = new CandidateProfile();
    	$identification_type = DB::table('Identification_Types')->where('name', 'V')->value('id');
    	$candidate_profile->identification_type_id = $identification_type;
    	$candidate_profile->identification_number = '12345678';
    	$candidate_profile->user_id = $user->id;
    	$candidate_profile->save();
    	$curriculum = new Curriculum();
    	$curriculum->candidate_profile_id = $candidate_profile->id;
    	$curriculum->save();

    	//-------Administrador
        $user = new User();
    	$user->email = 'admin@email.com';
    	$user->password = Hash::make('Pruebas123');
    	$user->user_status_id = "1";
    	$saved = $user->save();
    	$user_role = new UserRole();
    	$user_role->user_id = $user->id;
    	$user_role->role_id = "2";
    	$user_role->save();
		$personal_profile = new PersonalProfile();
		$personal_profile->first_name = 'El Admin';
		$personal_profile->last_name = 'Muy admin';
    	$personal_profile->user_id =$user->id;
    	$personal_profile->save();
    	$candidate_profile = new CandidateProfile();
    	$identification_type = DB::table('Identification_Types')->where('name', 'V')->value('id');
    	$candidate_profile->identification_type_id = $identification_type;
    	$candidate_profile->identification_number = '99999999';
    	$candidate_profile->user_id = $user->id;
    	$candidate_profile->save();
    	$curriculum = new Curriculum();
    	$curriculum->candidate_profile_id = $candidate_profile->id;
    	$curriculum->save();

    }
}
