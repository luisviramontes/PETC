@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Lista de Asistencia</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('listas_asistencias')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('listas_asistencias')}}">Listas de Asistencias</a></li>
		</ol>
	</div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-md-12">
			<div class="block-web">
				<div class="header">
					<div class="row" style="margin-top: 15px; margin-bottom: 12px;">
						<div class="col-sm-8">
							<div class="actions"> </div>
							<h2 class="content-header" style="margin-top: -5px;"><strong>Recepción de Listas de Asistencia</strong></h2>
						</div>
						<div class="col-md-4">
							<div class="btn-group pull-right">
								<div class="actions">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="porlets-content">
					<form action="{{url('listas_codigo')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}


						<div class="form-group">
							<label class="col-sm-3 control-label">Buscar CCT: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
								<input name="buscar" id="buscar"  onkeypress="return teclas(event);"  type="text"  maxlength="35"  class="form-control"  placeholder="Ingrese el Codigo de Barras"  class="form-control"  />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">CCT: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="cct" id="cct" disabled type="text"   class="form-control"  value="{{Input::old('escuelas')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Escuela: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="nombre_escuela" id="nombre_escuela" disabled type="text"   class="form-control"   />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="ciclo" id="ciclo" disabled type="text"   class="form-control"  value="{{Input::old('escuelas')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Mes: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="mes" id="mes" disabled type="text"   class="form-control"  value="{{Input::old('escuelas')}}" />
							</div>
						</div>




						<div class="form-group"  class="table-responsive">
							<table id="detalles" name="detalles[]" value="" class="table table-responsive-xl table-bordered">
								<thead style="background-color:#A9D0F5">
									<th>Eliminar</th>
									<th>N°</th>
									<th>CCT</th>
									<th>Nombre Escuela</th>
									<th>Mes</th>
									<th>Ciclo Escolar</th>
									<th>Estado</th>

								</thead>
								<tfoot>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
								</tfoot>
							</table>


						</div>

						<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
							<div class="form-group"> 
								<label for="total">Total de Elementos </label>
								<input name="total" id="total" type="number"  class="form-control"  readonly/>
							</div>    
						</div>  


						<div class="form-group">
							<div class="col-sm-6">
								<input  id="codigo2" value="" name="codigo2[]" type="hidden"  maxlength="50"  class="form-control" />
							</div>
						</div>



					<!--	<div class="form-group">
							<label class="col-sm-3 control-label">Correo enlace <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo" class="form-control" required>

								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>--><!--/form-group-->





						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
								<button type="submit"  id="submit8"  onclick="return save();" class="btn btn-primary">Guardar</button>
								<a href="{{url('/recepcion_listas')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
<script type="text/javascript">
	window.onload=function(){ 
		document.getElementById('buscar').focus();
		//busca_personal();
		//claves();
	}

	function save() {
		if (document.getElementById('total').value > 0){
			var z = 1
			var arreglo = [];
			var table = document.getElementById('detalles');
			for (var r = 1, n = table.rows.length-1; r < n; r++) {
				for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
					var j = table.rows[r].cells[1].innerHTML;
					arreglo.push(table.rows[r].cells[1].innerHTML);
				}
			}
			document.getElementById("codigo2").value=arreglo;
			var menos =document.getElementById("detalles").rows
			var r = menos.length;
			document.getElementById("total").value= r - 2;
		}else{

			swal("Alerta!", "No hay Elementos Agregados a la Tabla, Para Poder Guardar!", "error");
			return false;

		}
	}

</script>

@endsection
