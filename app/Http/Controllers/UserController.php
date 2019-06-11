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
use App\State;
use App\Phone;
use App\PhoneType;
use App\Direction;
use App\DirectionType;
use App\WorkExperience;
use App\Skill;
use App\PersonalReference;
use App\Certificate;

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

                        $direction_type = DB::table('Direction_Types')->whereNotIn('name', ['Empresa'])->get();
                        $phone_type = DB::table('Phone_Types')->get();
                        $personal_data = Auth::User()->personal_profile()->select(array('first_name', 'last_name'))->get();
                        $id_number = Auth::User()->candidate_profile()->select('identification_number')->get();
                        $directions = Auth::User()->direction()->select(array('id', 'country','adress_line_1',
                            'adress_line_2','city','state','reference','postal_code','direction_type_id'))->get();
                        $phones = Auth::User()->phone()->select('id','phone_number','phone_type_id')->get();
                        $states = DB::table('States')->get();

                        //dd($personal_data[0]->last_name);
                           // dd($direction_type);
                        return view('Users.edit', [
                               'personal_data' => $personal_data,
                               'identification_number' => $id_number,
                               'directions' => $directions,
                               'phones' => $phones,
                               'user_direction_types' => $direction_type,
                               'user_phone_types' => $phone_type,
                               'type' => $type,
                               'id' => $id,
                               'states' => $states
                               
                        ]);
                        break;
                    case 'profesional':
                        $work_experiences = Auth::User()->candidate_profile()->where('user_id',Auth::User()->id)->first()->curriculum()->first()->work_experience()->get();
                        $certificates = Auth::User()->candidate_profile()->where('user_id',Auth::User()->id)->first()->curriculum()->first()->certificate()->get();
                        $references = Auth::User()->candidate_profile()->where('user_id',Auth::User()->id)->first()->curriculum()->first()->reference()->get();
                        $skills = Auth::User()->candidate_profile()->where('user_id',Auth::User()->id)->first()->curriculum()->first()->skill()->get();
                        return view('Users.edit', [
                               'experiences' => $work_experiences,
                               'certificates' => $certificates,
                               'references' => $references,
                               'skills' => $skills,
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
        /*NOTA: save no hace nada si no hay cambios*/
        $source = $request->session()->get('_previous');
        $source_split = explode('/',$source["url"]);
        $edit_type = end($source_split);
        if ($edit_type == 'personal')
        {
            //Actualizamos el cliente. 
            $personal_data = new PersonalProfile();
            $personal_data = PersonalProfile::where('user_id',Auth::User()->id)->first();
            $personal_data->first_name=$request->first_name;
            $personal_data->last_name=$request->last_name;
            $personal_data->save();

            //Actualizamos/Insertamos los teléfonos
            for ($i = 0; $i < count($request->id_phone); $i++)
            {
                if ($request->id_phone[$i] == 0)
                {
                    if ($request->phone[$i] != null)
                    {
                        $phone = new Phone();  
                        $phone->user_id = Auth::User()->id;
                        $phone->phone_number = $request->phone[$i];
                        $p_type_id = PhoneType::where('name',$request->user_phone_type[$i])->first('id')->id;
                        $phone->phone_type_id = $p_type_id;
                        $phone->save();
                    }
                }
                else
                {
                    if ($request->phone[$i] != null)
                    {
                        $phone = Phone::where('id',$request->id_phone[$i])->first();
                        $phone->phone_number = $request->phone[$i];
                        $p_type_id = PhoneType::where('name',$request->user_phone_type[$i])->first('id')->id;
                        $phone->phone_type_id = $p_type_id;
                        $phone->save();
                    }
                }
            }

            //Actualizamos/insertamos las direcciones
            for ($i = 0; $i < count($request->id_direction); $i++)
            {
                if ($request->id_direction[$i] == 0)
                {
                    if ($request->country[$i] != null && $request->line1[$i] != null && $request->line2[$i] != null
                    && $request->city[$i] != null && $request->state[$i] != null && $request->reference[$i] != null) 
                    {
                        $direction = new Direction();  
                        $direction->user_id = Auth::User()->id;
                        $direction->country = $request->country[$i];
                        $direction->adress_line_1 = $request->line1[$i];
                        $direction->adress_line_2 = $request->line2[$i];
                        $direction->city = $request->city[$i];
                        $direction->state = $request->state[$i];
                        $direction->reference = $request->reference[$i];
                        $direction->postal_code = $request->postal[$i];
                        $d_type_id = DirectionType::where('name',$request->user_direction_type[$i])->first('id')->id;
                        $direction->direction_type_id = $d_type_id;
                        $direction->save();
                    }
                } 
                else
                {
                    if ($request->country[$i] != null && $request->line1[$i] != null && $request->line2[$i] != null
                    && $request->city[$i] != null && $request->state[$i] != null && $request->reference[$i] != null) 
                    {
                        $direction = Direction::where('id',$request->id_direction[$i])->first();
                        $direction->country = $request->country[$i];
                        $direction->adress_line_1 = $request->line1[$i];
                        $direction->adress_line_2 = $request->line2[$i];
                        $direction->city = $request->city[$i];
                        $direction->state = $request->state[$i];
                        $direction->reference = $request->reference[$i];
                        $direction->postal_code = $request->postal[$i];
                        $d_type_id = DirectionType::where('name',$request->user_direction_type[$i])->first('id')->id;
                        $direction->direction_type_id = $d_type_id;
                        $direction->save();                    
                    }
                }           
            }
        }

        if ($edit_type == 'profesional')
        {
            $curriculum_id = Auth::User()->candidate_profile()->where('user_id',Auth::User()->id)->first()->curriculum()->first()->id;
            //Actualizamos/Insertamos las experiencias personales
            for ($i = 0; $i < count($request->id_experience); $i++)
            {
                if ($request->id_experience[$i] == 0)
                {
                    if ($request->name_experience[$i] != null)//REVISAR tag:campos_no_nulls
                    {
                        $experience = new WorkExperience();  
                        $experience->curriculum_id = $curriculum_id;
                        $experience->name = $request->name_experience[$i];
                        $experience->description = $request->description_experience[$i];
                        $experience->time = $request->experience_time[$i];
                        $experience->save();
                    }
                }
                else
                {
                    if ($request->name_experience[$i] != null)//REVISAR tag:campos_no_nulls
                    {
                        $experience = WorkExperience::where('id',$request->id_experience[$i])->first();
                        $experience->name = $request->name_experience[$i];
                        $experience->description = $request->description_experience[$i];
                        $experience->time = $request->experience_time[$i];
                        $experience->save();
                    }
                }
            }  

            //Actualizamos/Insertamos las habilidades profesionales
            for ($i = 0; $i < count($request->id_skill); $i++)
            {
                if ($request->id_skill[$i] == 0)
                {
                    if ($request->name_skill[$i] != null)//REVISAR tag:campos_no_nulls
                    {
                        $skill = new Skill();  
                        $skill->curriculum_id = $curriculum_id;
                        $skill->name = $request->name_skill[$i];
                        $skill->description = $request->description_skill[$i];
                        $skill->save();
                    }
                }
                else
                {
                    if ($request->name_skill[$i] != null)//REVISAR tag:campos_no_nulls
                    {
                        $skill = Skill::where('id',$request->id_skill[$i])->first();
                        $skill->name = $request->name_skill[$i];
                        $skill->description = $request->description_skill[$i];
                        $skill->save();
                    }
                }
            }   

            //Actualizamos/Insertamos los certificados
            for ($i = 0; $i < count($request->id_certificate); $i++)
            {
                if ($request->id_certificate[$i] == 0)
                {
                    if ($request->name_certificate[$i] != null)//REVISAR tag:campos_no_nulls
                    {
                        $certificate = new Certificate();  
                        $certificate->curriculum_id = $curriculum_id;
                        $certificate->name = $request->name_certificate[$i];
                        $certificate->description = $request->description_certificate[$i];
                        $certificate->certificate_year = $request->year[$i];
                        $certificate->save();
                    }
                }
                else
                {
                    if ($request->name_certificate[$i] != null)//REVISAR tag:campos_no_nulls
                    {
                        $certificate = Certificate::where('id',$request->id_certificate[$i])->first();
                        $certificate->name = $request->name_certificate[$i];
                        $certificate->description = $request->description_certificate[$i];
                        $certificate->certificate_year = $request->year[$i];
                        $certificate->save();
                    }
                }
            }  

            //Actualizamos/Insertamos las referencias personales
            for ($i = 0; $i < count($request->id_reference); $i++)
            {
                if ($request->id_reference[$i] == 0)
                {
                    if ($request->name_reference[$i] != null)//REVISAR tag:campos_no_nulls
                    {
                        $reference = new PersonalReference();  
                        $reference->curriculum_id = $curriculum_id;
                        $reference->name = $request->name_reference[$i];
                        $reference->relation = $request->relation[$i];
                        $reference->phone_number = $request->phone_reference[$i];
                        $reference->save();
                    }
                }
                else
                {
                    if ($request->name_certificate[$i] != null)//REVISAR tag:campos_no_nulls
                    {
                        $certificate = PersonalReference::where('id',$request->id_reference[$i])->first();
                        $reference->name = $request->name_reference[$i];
                        $reference->relation = $request->relation[$i];
                        $reference->phone_number = $request->phone_reference[$i];
                        $reference->save();
                    }
                }
            } 

        }
        //¿Volver a editar o inicio? En fin lo mandare al inicio mientras
        return redirect('/');
        //dd($request);

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
