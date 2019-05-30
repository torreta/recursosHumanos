 @extends('layouts.base')

@section('content')

        <div class="row">
            <div class="col-4"> 
                <div class="card" style="width: 18rem;">
                  <div class="card-header">
                    Modificar Perfil
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="/user/{{$id}}/edit/personal">Perfil Personal</a></li>
                    <li class="list-group-item"><a href="/user/{{$id}}/edit/profesional">Perfil Profesional</a></li>
                    <li class="list-group-item"><a href="/user/{{$id}}/edit/moderador">Perfil Moderador (solo si el usuario es mod[Role])</a></li>
                    <li class="list-group-item"><a href="/user/{{$id}}/edit/admin">Perfil Administrativo (solo si el usuario es admin[Role])</a></li>
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
                        <form action="/register/" method="POST">
                            @csrf
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Datos Personales</H2>
                                    <div class="form-group">

                                        <label for="title">Nombre:</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" value="{{old('first_name')}}">
                                        <label for="title">Apellido:</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido" value="{{old('last_name')}}">
                                        <label for="title">Cédula de Identidad:</label>
                                        <input type="text" class="form-control-plaintext" id="identification_number" name="identification_number" placeholder="Cédula de Identidad" value="{{old('identification_number')}}" readonly>
                                    </div>
                                </div>
                            </div><br>
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Dirección</H2>
                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner">
                                          <div class="clonable" data-ss="1">
                                            <h5 class="clonable-increment-html">Nueva Dirección</h5>
                                                <div class="form-row">
                                                   <div class="form-group col-md-6">
                                                      <label>Tipo de Dirección:</label>
                                                        <select class="form-control" id="user_direction_type" name="user_direction_type">

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label >Password</label>
                                                      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label >Dirección 1</label>
                                                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                                  </div>
                                                  <div class="form-group">
                                                    <label >Dirección 2</label>
                                                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                                  </div>
                                                  <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                      <label >Ciudad</label>
                                                      <input type="text" class="form-control" id="inputCity">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                      <label >Estado</label>
                                                      <select id="inputState" class="form-control">
                                                        <option selected>Choose...</option>
                                                        <option>...</option>
                                                      </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                      <label for="inputZip">Código Postal</label>
                                                      <input type="text" class="form-control" id="inputZip">
                                                    </div>
                                                </div>
                                          </div>
                                          <button class="clonable-button-add" type="button">Añadir Dirección</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Teléfono</H2>
                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner">
                                          <div class="clonable" data-ss="1">
                                            <h5 class="clonable-increment-html">Nuevo Teléfono</h5>
                                                <div class="form-row">
                                                   <div class="form-group col-md-6">
                                                      <label>Tipo de Teléfono:</label>
                                                        <select class="form-control" id="user_phone_type" name="user_direction_type">

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label >Número de Teléfono</label>
                                                      <input type="text" class="form-control" id="" placeholder="Teléfono">
                                                    </div>
                                                  </div>
                                          </div>
                                          <button class="clonable-button-add" type="button">Añadir Teléfono</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>

                        </form>
                        @endif


                        @if($type == 'profesional')
                        <form action="/register/" method="POST">
                            @csrf
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="card-title">Experiencias Laborales</H2>
                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner">
                                          <div class="clonable" data-ss="1">
                                            <h5 class="clonable-increment-html">Añadir Experiencia</h5>
                                                <div class="form-group">
                                                    <label for="title">Experiencia:</label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" value="{{old('first_name')}}">
                                                    <label for="title">Descripción:</label>
                                                    <textarea class="form-control" rows="4" cols="50" name="comment" id="last_name" name="last_name" placeholder="Descripción de la Experiencia" value="{{old('last_name')}}"></textarea>
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
                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner">
                                          <div class="clonable" data-ss="1">
                                            <h5 class="clonable-increment-html">Añadir Habilidad</h5>
                                                <div class="form-group">
                                                    <label for="title">Habilidad:</label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" value="{{old('first_name')}}">
                                                    <label for="title">Descripción:</label>
                                                    <textarea class="form-control" rows="4" cols="50" name="comment" id="last_name" name="last_name" placeholder="Descripción de la Habilidad" value="{{old('last_name')}}"></textarea>
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
                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner">
                                          <div class="clonable" data-ss="1">
                                            <h5 class="clonable-increment-html">Añadir Certificado</h5>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-9">
                                                            <label for="title">Titulo del Certificado:</label>
                                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" value="{{old('first_name')}}">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="title">Año de Adquisición:</label>
                                                            <input type="number" class="form-control" id="last_name" name="last_name" placeholder="Descripción del Certificado" value="{{old('last_name')}}">

                                                        </div>
                                                    </div>
                                                    <label for="title">Descripción:</label>
                                                    <textarea class="form-control" rows="4" cols="50" name="comment" id="last_name" name="last_name" placeholder="Descripción del Certificado" value="{{old('last_name')}}"></textarea>
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
                                    <div class="form-group">
                                        <div class="clonable-block" data-toggle="cloner">
                                          <div class="clonable" data-ss="1">
                                            <h5 class="clonable-increment-html">Añadir Referencia Personal</h5>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="title">Nombre:</label>
                                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" value="{{old('first_name')}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="title">Teléfono:</label>
                                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Descripción del Certificado" value="{{old('last_name')}}">

                                                        </div>
                                                    </div>
                                                    <label for="title">Tipo de Relación:</label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Descripción del Certificado" value="{{old('last_name')}}">
                                                </div>
                                          </div>
                                          <button class="clonable-button-add" type="button">Añadir Referencia</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>

                        </form>
                        @endif



                    </div>
                </div>
            </div>
        </div>





@endsection

