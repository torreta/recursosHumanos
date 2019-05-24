 @extends('layouts.base')

@section('content')
    
    <div class="row">
        <div class="col">
            <h1>Registro de Usuario</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/expense_reports">Regresar</a>
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
            <form action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Nombre:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" value="{{old('first_name')}}">
                    <label for="title">Apellido:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido" value="{{old('last_name')}}">
                    <label for="title">Cédula de Identidad:</label>
                    <div class="row">
                        <div class="col-1">
                            <select class="form-control" id="user_identification_type" name="user_identification_type">
                                    @foreach ($user_identification_types as $user_identification_type)
                                        <option value="{{ $user_identification_type->name }}">{{ $user_identification_type->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-11">
                            <input type="text" class="form-control" id="identification_number" name="identification_number" placeholder="Cédula de Identidad" value="{{old('identification_number')}}">
                        </div>
                    </div>
                    <label for="title">Correo:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico" value="{{old('email')}}">
                    <label for="title">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" value="">
                    <label for="title">Repetir Contraseña:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Contraseña" value="">

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
@endsection

