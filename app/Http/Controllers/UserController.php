<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\PersonalProfile;
use App\CandidateProfile;
use App\IdentificationType;
use App\Curriculum;

class UserController extends Controller
{
      public function index()
    {
        return redirect('/register/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
    	$identification_type = IdentificationType::orderBy('id')->get();

    	return view('Users.create', [
    		'user_identification_types' => $identification_type
    	]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validaData = $request->validate([
            'email' => 'required|e-mail|unique:Users,email',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
            'identification_number' => 'required|integer|unique:Candidate_Profiles,identification_number',
            'first_name' => 'required|min:3|regex:/^[a-zA-Z]*$/',
            'last_name' => 'required|min:3|regex:/^[a-zA-Z]*$/'
        ]);

    	$check_user = DB::table('Users')->where('email', $request->email)->value('email');
    	$check_identification = DB::table('Candidate_Profiles')->where('identification_number', $request->identification_number)->value('identification_number');
    	if ($check_user == null && $check_identification == null)
    	{
    		$user = new User();
    		$user->email = $request->email;
    		$user->password = $request->password;
    		$user->user_status_id = "1";
    		$saved = $user->save();


    		if($saved)
    		{
    			//Aplicamos su ROL
    			$user_role = new UserRole();
    			$user_role->user_id = $user->id;
    			$user_role->role_id = "1"; //No siempre deberia ser el rol por defecto (?)
    			$user_role->save();

    			//Creamos sus perfiles
    			$personal_profile = new PersonalProfile();
    			$personal_profile->first_name = $request->first_name;
    			$personal_profile->last_name = $request->last_name;
    			$personal_profile->user_id =$user->id;
    			$personal_profile->save();

    			$candidate_profile = new CandidateProfile();
    			$identification_type = DB::table('Identification_Types')->where('name', $request->get('user_identification_type'))->value('id');
    			$candidate_profile->identification_type_id = $identification_type;
    			$candidate_profile->identification_number = $request->identification_number;
    			$candidate_profile->user_id = $user->id;
    			$candidate_profile->save();

    			//Perfil Moderador y Administrativo aun no ha sido creado

    			//Creamos el currículum
    			$curriculum = new Curriculum();
    			$curriculum->candidate_profile_id = $candidate_profile->id;
    			$curriculum->save();
    		}
    		else
    		{

    		}
    	}
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
