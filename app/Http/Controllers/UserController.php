<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    		$user->password = Hash::make($request->password);
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

                //Una vez creado el login, autenticamos al usuario. (Esto deberá cambiar si se debe activar por correo el registroa)
                
                $userdata = array(
                  'email' => $request->email ,
                  'password' => $request->password
                );
                
                if (Auth::attempt($userdata)) 
                {
                    return redirect('/');
                }
                else
                {
                    return redirect('/login');
                }
    		}
    		else
    		{
                //hay que hacer rollbacks si no se hizo correctamente todos los insert.
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
    public function edit($id,$type)
    {
        if(Auth::Check())
        {
            if(Auth::User()->id == $id)
            {
                switch ($type) 
                {
                    case 'personal':

                        $direction_type = DB::table('Direction_Types')->whereNotIn('name', ['Empresa'])->value('name');
                        $phone_type = DB::table('Phone_Types')->value('name');
                        $personal_data = Auth::User()->personal_profile()->select(array('first_name', 'last_name'))->get();
                        $cedula = Auth::User()->candidate_profile()->select('identification_number')->get();
                        $directions = Auth::User()->direction()->select(array('id', 'country','adress_line_1',
                            'adress_line_2','city','state','reference','postal_code','direction_type_id'))->get();
                        $phones = Auth::User()->phone()->select('phone_number','phone_type_id')->get();
                        dd($phones);
                        //dd($personal_data[0]->last_name);

                        return view('Users.edit', [
                               'user_direction_type' => $direction_type,
                               'user_phone_type' => $phone_type,
                               'type' => $type,
                               'id' => $id,
                               'personal_data' => $personal_data
                        ]);
                        break;
                    case 'profesional':
                        $direction_type = DB::table('Direction_Types')->whereNotIn('name', ['Empresa'])->value('name');
                        $phone_type = DB::table('Phone_Types')->value('name');
                        return view('Users.edit', [
                               'user_direction_type' => $direction_type,
                               'user_phone_type' => $phone_type,
                               'type' => $type,
                               'id' => $id
                        ]);
                        break;
                        break;
                    case 'moderador':
                        //Codigo de perfil moderador. TODO
                        break;
                    case 'admin':
                        //Codigo de perfil admin. TODO
                        break;
                    default:
                        return redirect('/');
                }
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }


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


    public function showLogin()
    {
        return view('Users.login');
    }

    public function Login(Request $request)
    {
        $remember = false;
        $validaData = $request->validate([
            'email' => 'required|e-mail',
            'password' => 'required|min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'
        ]);

        if ($request->remember_me == 'on')
        {
            $remember = true;
        }
        // create our user data for the authentication
        $userdata = array(
          'email' => $request->email ,
          'password' => $request->password
        );
        // attempt to do the login
        if (Auth::attempt($userdata, $remember)) 
        {
            return view('welcome', [
            'user_type' => Auth::User()->roles()->orderBy('role_name')->pluck('role_name')/*Auth::User()->roles()->get('role_name')->first()*/
            ]);
        }
        else
        {
            // validation not successful, send back to form
            return redirect('/login');
        }
        
    }

    public function Logout()
    {
        Auth::logout(); // logging out user
        return redirect('/'); // redirection to login screen
    }


    public function TestCandidate()
    {   

        return view('AuthTest.candidate');

    }

    public function TestAdmin()
    {   

        return view('AuthTest.admin');

    }
    
    public function TestModerator()
    {   

        return view('AuthTest.mod');

    }
}
