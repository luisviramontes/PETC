{!! Form::open(['route' => [$nomina_estatal->url(),$nomina_estatal->id] ,'method' => $nomina_estatal->method(),'class' => 'app-form', 'files' => 'true']) !!}

  <div>
    {!! Form::label('bco','Banco') !!}
    {!! Form::text('bco',$nomina_estatal->bco,['class' => 'form-control']) !!}
  </div>

  <div>
    {!! Form::label('num_cheque','Numero de cheque') !!}
    {!! Form::text('bco',$nomina_estatal->num_cheque,['class' => 'form-control']) !!}
  </div>



  <div class="">
    <input type="submit" name="" value="Guardar" class="btn btn-primary">
  </div>

  {!! Form::close() !!}
