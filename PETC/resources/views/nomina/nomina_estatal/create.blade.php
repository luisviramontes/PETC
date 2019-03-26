@extends('layouts.principal')

@section('contenido')

<div class="container">
   <div class="">
     <header>
       <h4>Altas</h4>
     </header>
     <div class="">
       @include('nomina.nomina_estatal.formulario')
     </div>
   </div>
</div>

@endsection
