@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Cuentas </h1>
		<h2 class="">Cuentas</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Cuentas</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Cuentas</strong></h2>
							<br>
							<!--	@include('nomina.bancos.search')
							-->
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>


									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('cuentas.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Cuenta"> <i class="fa fa-plus"></i> Registrar </a>
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.cuentas.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
										<a class="btn btn-primary btn-sm" href="{{URL::action('CuentasController@invoice','2018-2019')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>



									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info">
						<thead>
							<tr>
								<th>Nombre de la Cuenta</th>
								<th>Cuenta</th>
								<th>Clave Inter.</th>
								<th>Secretaria</th>
								<th>Banco</th>
								<th>Fecha de Registro</th>
								<th>Estado</th>
								<th>Capturo</th>
              	<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
						@foreach($cuentas  as $cuenta)
						@if ($cuenta->estado == "ACTIVO")
							<tr class="gradeX">
								<td style="background-color:#DBFFC2;">{{$cuenta->nombre}} </td>
								<td style="background-color:#DBFFC2;">{{$cuenta->num_cuenta}} </td>
								<td style="background-color:#DBFFC2;">{{$cuenta->clave_in}} </td>
								<td style="background-color:#DBFFC2;">{{$cuenta->secretaria}} </td>
								<td style="background-color:#DBFFC2;">{{$cuenta->nombre_banco}} </td>
								<td style="background-color:#DBFFC2;">{{$cuenta->created_at}}</td>
								<td style="background-color:#DBFFC2;">{{$cuenta->estado}}</td>
								<td style="background-color:#DBFFC2;">{{$cuenta->captura}}</td>



								<td style="background-color:#DBFFC2;">
									<center>
										<a href="{{URL::action('CuentasController@edit',$cuenta->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>

								<td style="background-color:#DBFFC2;">
									<center>
										<a class="btn btn-danger btn-sm" id="delete" data-target="#modal-delete-{{$cuenta->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
							@else
							<tr class="gradeX">

								<td style="background-color:#FFE4E1;">{{$cuenta->nombre}} </td>
								<td style="background-color:#FFE4E1;">{{$cuenta->num_cuenta}} </td>
								<td style="background-color:#FFE4E1;">{{$cuenta->clave_in}} </td>
								<td style="background-color:#FFE4E1;">{{$cuenta->secretaria}} </td>
								<td style="background-color:#FFE4E1;">{{$cuenta->nombre_banco}} </td>
								<td style="background-color:#FFE4E1;">{{$cuenta->created_at}}</td>
								<td style="background-color:#FFE4E1;">{{$cuenta->estado}}</td>
								<td style="background-color:#FFE4E1;">{{$cuenta->captura}}</td>



								<td style="background-color:#FFE4E1;">
									<center>
										<a href="{{URL::action('CuentasController@edit',$cuenta->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>

								<td style="background-color:#FFE4E1;">
									<center>
										<a class="btn btn-danger btn-sm" id="delete" data-target="#modal-delete-{{$cuenta->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
							@endif
							@include('nomina.cuentas.modal')
					@endforeach
						</tbody>
						<!--<tfoot>
							<tr>
                <th></th>
								<th>Quincena </th>
								<th>Dias Trabajados</th>
								<th>Pago por Director </th>
								<th>Pago por Docente </th>
								<th>Pago por Intendente </th>
								<th>Ciclo </th>>
								<th>Capturo </th>
								<th>Modificado</th>


								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</tfoot> -->
					</table>

				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
<script type="text/javascript">

</script>
@endsection
