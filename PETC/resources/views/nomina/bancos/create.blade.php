@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Capturar Banco</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('bancos')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('bancos')}}">Capturar Banco</a></li>
		</ol>
	</div>
</div>
<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-md-12">
			<div class="block-web">
				<div class="header">
					<div class="row" style="margin-top: 15px; margin-bottom: 12px;">
						<div class="col-sm-8">
							<div class="actions"> </div>
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Banco</strong></h2>


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
					<form action="{{route('bancos.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}


						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre del Banco: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="nombre_banco" id="nombre_banco" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" type="text" maxlength=""  class="form-control valid" required value="{{Input::old('nombre_banco')}}" />
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_nombre_banco'>{{$errors->formulario->first('nombre_banco')}}</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Operación: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="operacion" id="operacion" type="num" maxlength="2" onkeypress="soloNumeros(event)"  class="form-control valid" required value="{{Input::old('operacion')}}" />
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_operacion'>{{$errors->formulario->first('operacion')}}</div>
							</div>
						</div>




            <div class="form-group">
              <label class="col-sm-3 control-label">Descripcion: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <select name="descripcion" id="descripcion" class="form-control" value="{{Input::old('descripcion')}}"  onchange=""required>
                  <option value="DEPOSITO">
                    DEPOSITO
                  </option>
                  <option value="CHEQUE">
                    CHEQUE
                  </option>


                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div><!--/form-group-->



					<!--	<div class="form-group">
							<label class="col-sm-3 control-label">Estado <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="estado" class="form-control" value="{{Input::old('estado')}}" required>
									<option value="ACTIVO">
										ACTIVO
									</option>
									<option value="INACTIVO">
										INACTIVO
									</option>


								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					-->


						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">

								<button type="submit" id="submit"   onclick="" class="btn btn-primary">Guardar</button>
								<a href="{{url('/bancos')}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->

<script type="text/javascript">

</script>

@endsection
