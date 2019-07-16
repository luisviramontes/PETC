@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Detalle de Nomina</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/almacenes/agroquimicos')}}">Inicio</a></li>
      <li class="active">Nomina Registrada</a></li>
    </ol>
  </div>
</div>
<div class="container clear_both padding_fix">
  <div class="row">
    <div class="col-md-12">
      <div class="block-web">
        <div class="header">
          <div class="row" style="margin-top: 15px; margin-bottom: 12px;">
            <div class="col-sm-7">
              <div class="actions"> </div>
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Nomina Registrada Correctamente</strong></h4>
            </div>
            <div class="btn-group pull-right">
              <b>
                <div class="btn-group" style="margin-right: 10px;">
                  <a class="btn btn-sm btn-danger tooltips" href="{{url('/almacenes/agroquimicos')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>
                </div> 
              </b>
            </div>

          </div>
        </div>
        <div class="porlets-content container clear_both padding_fix">

          @foreach($material as $mat)
          <div class="col-lg-6">
            <section class="panel green_border horizontal_border_2">
              <div class="block-web">
                <div class="header">

                  <h3>Producto: {{$mat->nombre}}</h3>
                </div>
                <div class="porlets-content" style="display: block;">
                 <p align="justify"><strong>Codigo de Barras:</strong> {{$mat->codigo}}</p>
                 @if (($mat->codigo)!="")
                 <td><?php echo DNS1D::getBarcodeHTML("$mat->codigo", "C128");?>
                  <div style="text-align:center;">              
                  </div>
                </td>
                @else
                <td>Codigo de Barras No Generado </td>
                @endif
                <p align="justify"><strong>Descripcion:</strong> {{$mat->descripcion}}</p>
                <p align="justify"><strong>Cantidad en Almacén:</strong> <ul>
                  @if($mat->unidad_medida== "KILOGRAMOS" || $mat->unidad_medida== "LITROS" || $mat->unidad_medida== "METROS" )
                  <li>

                    {{$metodo->calcularCantidadAlmacen($mat->idAgroquimico)}} 
                    {{$mat->nombreUnidadMedida}}  DE  {{$mat-> cantidadUnidadMedida}} {{$mat->unidad_medida}} 

                  </li>
                  <li>

                    {{$metodo->calcularCantidadUnidadCentral($mat->idAgroquimico)}}  {{$mat->unidad_medida}} 
                  </li>
                  <li>
                    {{$metodo->  calcularCantidadUnidadInferior($mat->idAgroquimico)}}      {{$metodo->labelUnidadMedidaMinima($mat->idAgroquimico)}}  
                  </li>
                  @else
                  <li>
                    {{$metodo->calcularCantidadAlmacen($mat->idAgroquimico)}}  {{$mat->nombreUnidadMedida}}  DE  {{$mat-> cantidadUnidadMedida}} {{$mat->unidad_medida}} 
                  </li>
                  <li>
                    {{$metodo->  calcularCantidadUnidadInferior($mat->idAgroquimico)}}      {{$metodo->labelUnidadMedidaMinima($mat->idAgroquimico)}}  

                  </li>
                  @endif
                </ul>
              </p>
              <p align="justify"><strong>Stock Minimo:</strong>   
                {{$metodo->convertidorStockUnidadesMinimas_UnidadCentral($mat->unidad_medida,$mat->stock_minimo)}} 
                {{$mat->unidad_medida}}  
              </p>
              <p align="justify"><strong>Creado el:</strong> {{$mat->created_at}}</p>
             
              <td>
                @if (($mat->imagen)!="")
                <img src="{{asset('imagenes/almacenagroquimicos/'.$mat->imagen)}}" alt="{{$mat->nombre}}" height="100px" width="100px" class="img-thumbnail">
                @else
                No Hay Imagen Disponible
                @endif
              </td> 
            </div>
          </div>
        </section>
        @if (($mat->codigo)!="")
        <a class="btn btn-sm btn btn-info" href="{{URL::action('AlmacenAgroquimicosController@invoice',$mat->idAgroquimico)}}" target="_blank" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Entrada"> <i class="fa fa-print"></i>Imprimir Codigo de Barras</a>
        @endif
      </div>
      @endforeach




    </div><!--/porlets-content-->
  </div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>



@endsection