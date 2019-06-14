 @extends('layouts.base')

@section('content')
    
    <div class="row">
        <div class="col">
            <h1>Ingresar de Usuario</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/">Regresar</a>
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
            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Correo" value="{{old('email')}}">
                    <label for="title">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" value="">
                    <label >Remember me <input type="checkbox" id="remember_me" name="remember_me"></label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

        </div>
    </div>
@endsection

