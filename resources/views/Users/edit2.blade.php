 @extends('layouts.base')


@section('content')
<!--
TODO:
EL CAMPO TEXT AREA SE CLONA JUNTO A SU CONTENIDO

-->

        <div class="row">
            <div class="col-4"> 
                <div class="card" style="width: 18rem;">
                  <div class="card-header">
                    Modificar Perfil
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="/user/{{$id}}/edit/personal">Perfil Personal</a></li>
                    <li class="list-group-item"><a href="/user/{{$id}}/edit/profesional">Perfil Profesional</a></li>
                    @if((Auth::User()->roles()->find('3') != NULL))
                    <li class="list-group-item"><a href="/user/{{$id}}/edit/moderador">Perfil Moderador</a></li>
                    @endif
                    @if((Auth::User()->roles()->find('2') != NULL))
                    <li class="list-group-item"><a href="/user/{{$id}}/edit/admin">Perfil Administrativo</a></li>
                    @endif
                  </ul>
                </div>
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col">
                        <h1>Editar Perfil</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div> 
                        @endif
                        @if($type == 'personal')
                        <form id="Datos_Personales">
                            @csrf
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Datos Personales</h2>
                                    <div class="alert alert-success alert-personal" style="display:none"></div>
                                    <div class="alert alert-danger alert-personal" style="display:none"></div>
                                    <div class="form-group">

                                        <label for="title">Nombre:</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" value="{{$personal_data[0]->first_name}}">
                                        <label for="title">Apellido:</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido" value="{{$personal_data[0]->last_name}}">
                                        <label for="title">Cédula de Identidad:</label>
                                        <input type="text" class="form-control-plaintext" id="identification_number" name="identification_number" placeholder="Cédula de Identidad" value="{{$identification_number[0]->identification_number}}" readonly>
                                    </div>
                                </div>
                            <button class="btn btn-primary" id="ajaxSubmit" onclick="Edit_Profile('personal',{{Auth::User()->id}},'0'); return false;">Submit</button>
                            </div><br>
                        </form>
                        <form id="Direcciones">
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Dirección</h2>
                                    <div class="alert alert-success alert-direction" style="display:none"></div>
                                    <div class="alert alert-danger alert-direction" style="display:none"></div>
                                    <h5 class="clonable-increment-html">Direcciones registradas</h5>
                                    @foreach ($directions as $direction)
                                    <a href="" onclick="hide({{$direction->id}},'direction'); return false;">{{$direction->adress_line_1}}</a>
                                    <div class="form-group" id="details_direction_{{$direction->id}}" style="display:none">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="id_direction" name="id_direction[]" value="{{$direction->id}}" hidden>
                                                <label>Tipo de Dirección</label>
                                                <select class="form-control" id="user_direction_type" name="user_direction_type[]">
                                                @foreach ($user_direction_types as $user_direction_type)
                                                    @if($direction->direction_type_id == $user_direction_type->id)
                                                    <option value="{{ $user_direction_type->name }}" selected>{{ $user_direction_type->name}}</option>
                                                    @else
                                                    <option value="{{ $user_direction_type->name }}">{{ $user_direction_type->name}}</option>   
                                                    @endif
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label >País</label>
                                                <input type="text" class="form-control" id="country" name="country[]" value="{{$direction->country}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >Dirección 1</label>
                                            <input type="text" class="form-control" id="line1" name="line1[]" value="{{$direction->adress_line_1}}">
                                        </div>
                                        <div class="form-group">
                                            <label >Dirección 2</label>
                                            <input type="text" class="form-control" id="line2" name="line2[]" value="{{$direction->adress_line_2}}">
                                        </div>
                                        <div class="form-group">
                                            <label >Punto de Referencia</label>
                                            <input type="text" class="form-control" id="reference" name="reference[]" value="{{$direction->reference}}">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label >Ciudad</label>
                                                <input type="text" class="form-control" id="city" name="city[]" value="{{$direction->city}}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label >Estado</label>
                                                <select class="form-control" id="state" name="state[]">
                                                @foreach ($states as $state)
                                                    @if($direction->state == $state->name)
                                                    <option value="{{ $state->name }}" selected>{{ $state->name}}</option>
                                                    @else
                                                    <option value="{{ $state->name }}">{{ $state->name}}</option>   
                                                    @endif
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="postal">Código Postal</label>
                                                <input type="text" class="form-control" id="postal" name="postal[]" value="{{$direction->postal_code}}">
                                            </div>
                                        <button class="btn btn-primary" onclick="Edit_Profile('direction',{{Auth::User()->id}},{{$direction->id}}); return false;">Editar Dirección</button>
                                        </div>
                                    </div>
                                    <br>

                                    @endforeach




                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner" >
                                          <div class="clonable" data-ss="1" id="delete">
                                            <div class='row'>
                                                <div class='col-11'>
                                                    <h5 class="clonable-increment-html">Nueva Dirección</h5>
                                                </div>
                                                <div class='col-1'>
                                                    <button type="button" class="btn btn-danger clonable-button-close" style="display: none;">X</button>
                                                </div>
                                            </div>
                                                <div class="form-row">
                                                   <div class="form-group col-md-6">
                                                      <input type="text" class="form-control" id="id_direction" name="id_direction[]"  hidden>
                                                      <label>Tipo de Dirección</label>
                                                        <select class="form-control" id="user_direction_type" name="user_direction_type[]">
                                                            @foreach ($user_direction_types as $user_direction_type)
                                                                <option value="{{ $user_direction_type->name }}">{{ $user_direction_type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label >País</label>
                                                      <input type="text" class="form-control" id="country" name="country[]" placeholder="País">
                                                    </div>
                                                  </div>

                                                  <div class="form-group">
                                                    <label >Dirección 1</label>
                                                    <input type="text" class="form-control" id="line1" name="line1[]" placeholder="Avenida, calle, etc.">
                                                  </div>
                                                  <div class="form-group">
                                                    <label >Dirección 2</label>
                                                    <input type="text" class="form-control" id="line2" name="line2[]" placeholder="Apartamento, casa, oficina, piso, etc.">
                                                  </div>
                                                  <div class="form-group">
                                                    <label >Punto de Referencia</label>
                                                    <input type="text" class="form-control" id="reference" name="reference[]" placeholder="Punto de referencia">
                                                  </div>
                                                  <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                      <label >Ciudad</label>
                                                      <input type="text" class="form-control" id="city" name="city[]" placeholder="Ciudad">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                      <label >Estado</label>
                                                      <select class="form-control" id="state" name="state[]">
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->name }}">{{ $state->name}}</option>
                                                            @endforeach
                                                      </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                      <label for="postal">Código Postal</label>
                                                      <input type="text" class="form-control" id="postal" name="postal[]" placeholder="Código Postal">
                                                    </div>
                                                </div>
                                          </div>
                                          <button class="btn btn-primary" onclick="Edit_Profile('direction',{{Auth::User()->id}},'0'); return false;">Agregar Dirección</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                        </form>
                        <form action="/user/{{$id}}/edit" method="POST">
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Teléfono</H2>
                                    <div class="alert alert-success alert-phone" style="display:none"></div>
                                    <div class="alert alert-danger alert-phone" style="display:none"></div>
                                    <h5 class="clonable-increment-html">Teléfonos registrados</h5>

                                    @foreach ($phones as $phone)
                                    <a href="" onclick="hide({{$phone->id}},'phone'); return false;">{{$phone->phone_number}}</a>
                                    <div class="form-group" id="details_phone_{{$phone->id}}" style="display:none">
                                            <div class="form-row">
                                                <input type="text" class="form-control" id="id_phone_{{$phone->id}}" name="id_phone[]" value="{{$phone->id}}" hidden>
                                                <div class="form-group col-md-6">
                                                    <label>Tipo de Teléfono:</label>
                                                    <select class="form-control" id="user_phone_type_{{$phone->id}}" name="user_phone_type[]">
                                                            @foreach ($user_phone_types as $user_phone_type)
                                                            @if($phone->phone_type_id == $user_phone_type->id)
                                                                <option value="{{ $user_phone_type->name }}" selected>{{ $user_phone_type->name}}</option>
                                                            @else
                                                                <option value="{{ $user_phone_type->name }}">{{ $user_phone_type->name}}</option>   
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                      <label >Número de Teléfono</label>
                                                      <input type="text" class="form-control" id="phone_{{$phone->id}}" name="phone[]" value="{{$phone->phone_number}}">
                                                </div>
                                            <button class="btn btn-primary" onclick="Edit_Profile('phone',{{Auth::User()->id}},'{{$phone->id}}'); return false;">Editar Teléfono</button>
                                            </div>   
                                    </div>
                                    <br>

                                    @endforeach

                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner" >
                                          <div class="clonable" data-ss="1">
                                            <div class='row'>
                                                <div class='col-11'>
                                                    <h5 class="clonable-increment-html">Nuevo Teléfono</h5>
                                                </div>
                                                <div class='col-1'>
                                                    <button type="button" class="btn btn-danger clonable-button-close" style="display: none;">X</button>
                                                </div>
                                            </div>
                                                <div class="form-row">
                                                    <input type="text" class="form-control" id="id_phone_0" name="id_phone[]" value="0" hidden>
                                                   <div class="form-group col-md-6">
                                                      <label>Tipo de Teléfono:</label>
                                                        <select class="form-control" id="user_phone_type_0" name="user_phone_type[]">
                                                            @foreach ($user_phone_types as $user_phone_type)
                                                                <option value="{{ $user_phone_type->name }}">{{ $user_phone_type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label >Número de Teléfono</label>
                                                      <input type="text" class="form-control" id="phone_0" name="phone[]" placeholder="Teléfono">
                                                    </div>
                                                  </div>
                                          </div>
                                          <button class="btn btn-primary" onclick="Edit_Profile('phone',{{Auth::User()->id}},'0'); return false;">Agregar Teléfono</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        @endif


                        @if($type == 'profesional')
                        <form action="/user/{{$id}}/edit" method="POST">
                            @csrf
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Experiencias Laborales</H2>

                                    <h5 class="clonable-increment-html">Experiencias Laborales registradas</h5>

                                    @foreach ($experiences as $experience)
                                    <a href="" onclick="hide({{$experience->id}},'experience'); return false;">{{$experience->name}}</a>
                                        <div class="form-group" id="details_experience_{{$experience->id}}" style="display:none">
                                            <div class="form-row">
                                                <input type="text" class="form-control" id="id_experience" name="id_experience[]" value="{{$experience->id}}" hidden>
                                                <div class="form-group col-md-9">
                                                    <label for="title">Experiencia:</label>
                                                    <input type="text" class="form-control" id="name_experience" name="name_experience[]" placeholder="Nombre de la Experiencia Profesional" value="{{$experience->name}}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="title">Tiempo de experiencia:</label>
                                                    <input type="text" class="form-control" id="experience_time" name="experience_time[]" placeholder="Tiempo de experiencia" value="{{$experience->time}}">
                                                </div>
                                            </div>
                                            <label for="title">Descripción:</label>
                                            <textarea class="form-control" rows="4" cols="50" id="description_experience" name="description_experience[]" placeholder="Descripción de la experiencia profesional""> {{$experience->description}}</textarea>
                                        </div>                               
                                    <br>

                                    @endforeach


                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner">
                                          <div class="clonable" data-ss="1" >
                                            <div class='row'>
                                                <div class='col-11'>
                                                    <h5 class="clonable-increment-html">Añadir Experiencia</h5>
                                                </div>
                                                <div class='col-1'>
                                                    <button type="button" class="btn btn-danger clonable-button-close" style="display: none;">X</button>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                    <input type="text" class="form-control" id="id_experience" name="id_experience[]"  hidden>
                                                        <div class="form-group col-md-9">
                                                            <label for="title">Experiencia:</label>
                                                            <input type="text" class="form-control" id="name_experience" name="name_experience[]" placeholder="Nombre de la Experiencia Profesional" value="{{old('name_experience[]')}}">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="title">Tiempo:</label>
                                                            <input type="text" class="form-control" id="experience_time" name="experience_time[]" placeholder="Tiempo de experiencia" value="{{old('experience_time[]')}}">

                                                        </div>
                                                    </div>
                                                    <label for="title">Descripción:</label>
                                                    <textarea class="form-control" rows="4" cols="50" id="description_experience" name="description_experience[]" placeholder="Descripción de la experiencia profesional">{{old('description_experience[]')}}</textarea>
                                                </div>
                                          </div>
                                          <button class="clonable-button-add" type="button">Añadir Experiencia</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Habilidades</H2>


                                    <h5 class="clonable-increment-html">Habilidades registradas</h5>

                                    @foreach ($skills as $skill)
                                    <a href="" onclick="hide({{$skill->id}},'skill'); return false;">{{$skill->name}}</a>
                                    <div class="form-group" id="details_skill_{{$skill->id}}" style="display:none">
                                        <input type="text" class="form-control" id="id_skill" name="id_skill[]" value="{{$skill->id}}" hidden>
                                        <label for="title">Habilidad:</label>
                                        <input type="text" class="form-control" id="name_skill" name="name_skill[]" placeholder="Nombre de la Habilidad" value="{{$skill->name}}">
                                        <label for="title">Descripción:</label>
                                        <textarea class="form-control" rows="4" cols="50" id="description_skill" name="description_skill[]" placeholder="Descripción de la Experiencia">{{$skill->description}}</textarea>
                                    </div>                                    
                                    <br>

                                    @endforeach

                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner" >
                                          <div class="clonable" data-ss="1">
                                            <div class='row'>
                                                <div class='col-11'>
                                                    <h5 class="clonable-increment-html">Añadir Habilidad</h5>
                                                </div>
                                                <div class='col-1'>
                                                    <button type="button" class="btn btn-danger clonable-button-close" style="display: none;">X</button>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="id_skill" name="id_skill[]"  hidden>
                                                    <label for="title">Habilidad:</label>
                                                    <input type="text" class="form-control" id="name_skill" name="name_skill[]" placeholder="Nombre de la Habilidad" value="{{old('name_skill[]')}}">
                                                    <label for="title">Descripción:</label>
                                                    <textarea class="form-control" rows="4" cols="50" id="description_skill" name="description_skill[]" placeholder="Descripción de la Habilidad" >{{old('description_skill[]')}}</textarea>
                                                </div>
                                          </div>
                                          <button class="clonable-button-add" type="button">Añadir Habilidad</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Certificados</H2>


                                    <h5 class="clonable-increment-html">Certificados registrados</h5>

                                    @foreach ($certificates as $certificate)
                                    <a href="" onclick="hide({{$certificate->id}},'certificate'); return false;">{{$certificate->name}}</a>
                                    <div class="form-group" id="details_certificate_{{$certificate->id}}" style="display:none">
                                        <input type="text" class="form-control" id="id_certificate" name="id_certificate[]" value="{{$certificate->id}}" hidden>
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="title">Titulo del Certificado:</label>
                                                <input type="text" class="form-control" id="name_certificate" name="name_certificate[]" placeholder="Nombre del Título" value="{{$certificate->name}}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="title">Año de Adquisición:</label>
                                                <input type="number" class="form-control" id="year" name="year[]" placeholder="Año Adquirido"" value="{{$certificate->certificate_year}}">
                                            </div>
                                        </div>
                                            <label for="title">Descripción:</label>
                                            <textarea class="form-control" rows="4" cols="50" id="description_certificate" name="description_certificate[]" placeholder="Descripción del Certificado" >{{$certificate->description}}</textarea>
                                        </div>                                 
                                    <br>

                                    @endforeach

                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner" >
                                          <div class="clonable" data-ss="1">
                                            <div class='row'>
                                                <div class='col-11'>
                                                    <h5 class="clonable-increment-html">Añadir Certificato</h5>
                                                </div>
                                                <div class='col-1'>
                                                    <button type="button" class="btn btn-danger clonable-button-close" style="display: none;">X</button>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="id_certificate" name="id_certificate[]" hidden>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-9">
                                                            <label for="title">Titulo del Certificado:</label>
                                                            <input type="text" class="form-control" id="name_certificate" name="name_certificate[]" placeholder="Nombre del Título" value="{{old('name_certificate[]')}}">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="title">Año de Adquisición:</label>
                                                            <input type="number" class="form-control" id="year" name="year[]" placeholder="Año Adquirido" value="{{old('year[]')}}">

                                                        </div>
                                                    </div>
                                                    <label for="title">Descripción:</label>
                                                    <textarea class="form-control" rows="4" cols="50" id="description_certificate" name="description_certificate[]" placeholder="Descripción del Certificado">{{old('description_certificate[]')}}</textarea>
                                                </div>
                                          </div>
                                          <button class="clonable-button-add" type="button">Añadir Certificado</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Referencias Personales</H2>


                                    <h5 class="clonable-increment-html">Referencias registradas</h5>

                                    @foreach ($references as $reference)
                                    <a href="" onclick="hide({{$reference->id}},'reference'); return false;">{{$reference->name}}</a>
                                    <div class="form-group" id="details_reference_{{$reference->id}}" style="display:none">
                                        <input type="text" class="form-control" id="id_reference" name="id_reference[]" value="{{$reference->id}}" hidden>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="title">Nombre:</label>
                                                <input type="text" class="form-control" id="name_reference" name="name_reference[]" placeholder="Nombre" value="{{$reference->name}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="title">Teléfono:</label>
                                                <input type="text" class="form-control" id="phone_reference" name="phone_reference[]" placeholder="Teléfono de Contacto" value="{{$reference->phone_number}}">
                                            </div>
                                        </div>
                                        <label for="title">Tipo de Relación:</label>
                                        <input type="text" class="form-control" id="relation" name="relation[]" placeholder="Tipo de relación con el contacto" value="{{$reference->relation}}">
                                    </div>                              
                                    <br>

                                    @endforeach


                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner">
                                          <div class="clonable" data-ss="1">
                                            <div class='row'>
                                                <div class='col-11'>
                                                    <h5 class="clonable-increment-html">Añadir Referencia</h5>
                                                </div>
                                                <div class='col-1'>
                                                    <button type="button" class="btn btn-danger clonable-button-close" style="display: none;">X</button>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="id_reference" name="id_reference[]" hidden>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="title">Nombre:</label>
                                                            <input type="text" class="form-control" id="name_reference" name="name_reference[]" placeholder="Nombre" value="{{old('name_reference[]')}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="title">Teléfono:</label>
                                                            <input type="text" class="form-control" id="phone_reference" name="phone_reference[]" placeholder="Teléfono de Contacto" value="{{old('phone_reference[]')}}">

                                                        </div>
                                                    </div>
                                                    <label for="title">Tipo de Relación:</label>
                                                    <input type="text" class="form-control" id="relation" name="relation[]" placeholder="Tipo de relación con el contacto" value="{{old('relation[]')}}">
                                                </div>
                                          </div>
                                          <button class="clonable-button-add" type="button">Añadir Referencia</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        @endif



                    </div>
                </div>
            </div>
        </div>



<script>

        function Edit_Profile(section,id,item_id) {


            switch (section) 
            {
                case 'personal':
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{ url('/user/"+ id +"/edit') }}",
                        method: 'post',
                        data: {
                            first_name: jQuery('#first_name').val(),
                            last_name: jQuery('#last_name').val(),
                            ci: jQuery('#identification_number').val(),
                            type_edit: section
                        },
                        success: function(result){
                            if(result.estado == 'success')
                            {
                                jQuery('.alert-success.alert-'+section).show();
                                jQuery('.alert-success.alert-'+section).html(result.message);
                            }
                            else
                            {
                                jQuery('.alert-danger.alert-'+section).show();
                                jQuery('.alert-danger.alert-'+section).html(result.message);
                            }
                        }});
                    break;
                case 'direction':
                    break;
                case 'phone':
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{ url('/user/"+ id +"/edit') }}",
                        method: 'post',
                        data: {
                            id_phone: jQuery('#id_phone_'+item_id).val(),
                            user_phone_type: jQuery('#user_phone_type_'+item_id).val(),
                            phone: jQuery('#phone_'+item_id).val(),
                            type_edit: section
                        },
                        success: function(result){
                            if(result.estado == 'success')
                            {
                                jQuery('.alert-success.alert-'+section).show();
                                jQuery('.alert-success.alert-'+section).html(result.message);
                            }
                            else
                            {
                                jQuery('.alert-danger.alert-'+section).show();
                                jQuery('.alert-danger.alert-'+section).html(result.message);
                            }
                        }});                    
                    break;
                default: break;
            }
                
        }

</script>

<script type="text/javascript">
        function hide(id,tag)
        {  
            if (document.getElementById('details_'+tag+'_'+id).style.display == "none")
            {
                document.getElementById('details_'+tag+'_'+id).style.display = "block";
            }
            else
            {
                document.getElementById('details_'+tag+'_'+id).style.display = "none";
            }
        }
</script>



@endsection


