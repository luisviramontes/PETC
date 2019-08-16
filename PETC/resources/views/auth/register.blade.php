@extends('app')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'auth/register', 'class' => 'form']) !!}

                    <div class="form-group">
                        <label>Nombre Completo</label>
                        {!! Form::input('text', 'name', '', ['class'=> 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        {!! Form::email('email', '', ['class'=> 'form-control']) !!}
                    </div>

                    <div class="form-group">
                    <label >Empleado PETC: <strog class="theme_color"></strog></label>
                            <select name="id_usuario" id="id_usuario"  class="form-control select2" >
                                @foreach($usuarios as $usuarios)
                                <option value='{{$usuarios->id}}'>
                                    {{$usuarios->nombre}}
                                </option>
                                @endforeach
                            </select>                        
                    </div>

                    <div class="form-group">
                    <label >Tipo de Usuario: <strog class="theme_color"></strog></label>
                            <select name="tipo_usuario" id="tipo_usuario"  class="form-control select2" >
                                <option value='1'>
                                    Alimentación
                                </option>
                                <option value='2'>
                                    Nomina
                                </option>
                                <option value='3'>
                                    Financieros
                                </option>
                                <option value='4'>
                                    Academico
                                </option>
                                  <option value='6'>
                                    Administrativo
                                </option>
                                
                            </select>                        
                    </div>

                    <div class="form-group">
                        <label>Contraseña</label>
                        {!! Form::password('password', ['class'=> 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label>Contraseña Confirmación</label>
                        {!! Form::password('password_confirmation', ['class'=> 'form-control']) !!}
                    </div>

                    <div> 
                        {!! Form::submit('send',['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection