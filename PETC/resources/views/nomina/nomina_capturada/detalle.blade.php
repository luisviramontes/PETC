@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Detalle de la Importacion</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/nomina_capturada')}}">Inicio</a></li>
      <li class="active">Importación Exitosa Qna {{$qna}}</a></li>
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
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Importación Exitosa Qna {{$qna}}</strong></h4> <img src="{{asset('img/correcto.png')}}" alt="correcto" height="100px" width="100px" class="img-thumbnail">
            </div>
            <div class="btn-group pull-right">
              <b>               
                <div class="btn-group" style="margin-right: 10px;">
                <a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.descargar_reporte_qna.excel2',$qna)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
                    <a class="btn btn-primary btn-sm" href="{{URL::action('NominaCapturadaController@invoice2',$qna)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" target="_blank" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>
                  <a class="btn btn-sm btn-danger tooltips" href="{{url('nomina_capturada')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>
                </div> 
              </b>
            </div>

          </div>
        </div>
        <div class="porlets-content container clear_both padding_fix">


        <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Registros Insertados Correctamente  <u> <b>{{$total_reg}} </b> </u> </strong></h4>

          <div class="porlets-content">
            <div class="table-responsive">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                  <tr>
                    <th>Total Registros </th>
                    <th>Directores </th>
                    <th>Docentes</th>
                    <th>Intendentes </th>               
                  </tr>
                </thead>
                <tbody>           
                
                  <tr class="gradeA">
                   <td style="background-color: #DBFFC2;" >{{$total_reg}}</td>  
                    <td style="background-color: #DBFFC2;" >{{$total_dire}}</td>              
                    <td style="background-color: #DBFFC2;" >{{$total_doce}}</td>      
                    <td style="background-color: #DBFFC2;" >{{$total_inte}}</td>      
                       
                  </td>
                </tr>                               


              </tbody>

            </table>

          </div><!--/porlets-content-->
        </div><!--/block-web-->
<br>
 <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Percepciónes </b> </u> </strong></h4>

        <div class="porlets-content">
            <div class="table-responsive">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                  <tr>
                    <th>Total Percepciónes </th>
                    <th>Directores </th>
                    <th>Docentes</th>
                    <th>Intendentes </th>               
                  </tr>
                </thead>
                <tbody>           
                
                  <tr class="gradeA">
                   <td style="background-color: #DBFFC2;" >$<?php echo  number_format($total_perce,2) ?></td>  
                    <td style="background-color: #DBFFC2;" >$<?php echo  number_format($total_perce_dire,2) ?></td>              
                    <td style="background-color: #DBFFC2;" >$<?php echo  number_format($total_perce_doce,2) ?></td>      
                    <td style="background-color: #DBFFC2;" >$<?php echo  number_format($total_perce_inte,2) ?></td>      
                       
                  </td>
                </tr>                               


              </tbody>

            </table>

          </div><!--/porlets-content-->
        </div><!--/block-web-->
<br>
         <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Deducciónes </b> </u> </strong></h4>

        <div class="porlets-content">
            <div class="table-responsive">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                  <tr>
                    <th>Total Deducciónes </th>
                    <th>Directores </th>
                    <th>Docentes</th>
                    <th>Intendentes </th>               
                  </tr>
                </thead>
                <tbody>           
                
                  <tr class="gradeA">
                   <td style="background-color: #DBFFC2;" >$<?php echo  number_format($total_dedu,2) ?></td>  
                    <td style="background-color: #DBFFC2;" >$<?php echo  number_format($total_dedu_dire,2) ?></td>              
                    <td style="background-color: #DBFFC2;" >$<?php echo  number_format($total_dedu_doce,2) ?></td>      
                    <td style="background-color: #DBFFC2;" >$<?php echo  number_format($total_dedu_inte,2) ?></td>      
                       
                  </td>
                </tr>                               


              </tbody>

            </table>

          </div><!--/porlets-content-->
        </div><!--/block-web-->
<br>
                 <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Liquido </b> </u> </strong></h4>

        <div class="porlets-content">
            <div class="table-responsive">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                  <tr>
                    <th>Total Liquido </th>
                    <th>Directores </th>
                    <th>Docentes</th>
                    <th>Intendentes </th>               
                  </tr>
                </thead>
                <tbody>           
                
                  <tr class="gradeA">
                   <td style="background-color: #DBFFC2;" > $<?php echo  number_format($total_liqui ,2) ?> </td>  
                    <td style="background-color: #DBFFC2;" > $<?php echo  number_format($total_liqui_dire,2) ?></td>              
                    <td style="background-color: #DBFFC2;" > $<?php echo  number_format($total_liqui_doce,2) ?> </td>      
                    <td style="background-color: #DBFFC2;" > $<?php echo  number_format($total_liqui_inte,2) ?> </td>      
                       
                  </td>
                </tr>                               


              </tbody>

            </table>

          </div><!--/porlets-content-->
        </div><!--/block-web-->
<br>

          <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Registros Rechazados <u> <b> <?php echo count($improcedentes) ?> </b> </u> </strong></h4>

          <div class="porlets-content">
            <div class="table-responsive">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                  <tr>
                    <th>Región </th>
                    <th>Nombre Empleado </th>
                    <th>R.F.C</th>
                    <th>Observación </th>               
                  </tr>
                </thead>
                <tbody>           
                  @foreach ($improcedentes as $improcedentes)
                  <tr class="gradeA">
                    <td style="background-color: #FFE4E1;" >{{$improcedentes['region']}}</td>              
                    <td style="background-color: #FFE4E1;" >{{$improcedentes['nom_emp']}}</td>
                    <td style="background-color: #FFE4E1;" >{{$improcedentes['rfc']}}</td>
                    <td style="background-color: #FFE4E1;" >{{$improcedentes['motivo']}}</td>
                  </td>
                </tr>
                @endforeach                  



              </tbody>

            </table>

          </div><!--/porlets-content-->
        </div><!--/block-web-->
      </div><!--/col-md-12-->
    </div><!--/row-->
  </div>



  @endsection