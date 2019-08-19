@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Editar Directorio Regional</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('directorio_regional')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('directorio_regional')}}">Editar Directorio Regional</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Editar Directorio</strong></h2>
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
					<form action="{{url('/directorio_regional', [$directorio->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">

						<div class="form-group">
							<label class="col-sm-3 control-label">Región <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="region" id="region" class="form-control select"   >
									@foreach($region as $region)
									@if($region->id == $directorio->id_region)
									<option value="{{$region->id}}" selected>
										{{$region->region}} {{$region->sostenimiento}}
										@else
										<option value="{{$region->id}}">
											{{$region->region}} {{$region->sostenimiento}}
										</option>
										@endif
										@endforeach
									</select>
									<div class="help-block with-errors"></div>
		<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('cct')}}</div>
	--></div>
</div>





<div class="form-group">
	<label class="col-sm-3 control-label">Nombre Enlace: <strog class="theme_color">*</strog></label>
	<div class="col-sm-6">
		<input name="nombre_enlace" type="text" id="nombre_enlace"  onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" onkeypress="return soloLetras(event)"  class="form-control" required value="{{$directorio->nombre_enlace}}" />
	</div>
</div>


<div class="form-group">
	<label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
	<div class="col-sm-6">
		<input name="telefono" type="number"  id="telefono" placeholder="xxx-xxx-xx-xx" onkeypress="return maxlengthtelefonos();soloNumeros()"  class="form-control" required value="{{$directorio->telefono}}" />
		<div class="help-block with-errors"></div>
		<div class="text-danger" id='error_telefono'>{{$errors->formulario->first('telefono')}}</div>
	</div>
</div>



<div class="form-group">
	<label class="col-sm-3 control-label">Ext1 Enlace: <strog class="theme_color">*</strog></label>
	<div class="col-sm-6">
		<input name="ext1_enlace" type="text" id="ext1_enlace" placeholder="xxxx" min="3" maxlength="4" onkeypress="return soloNumeros(event)" onchange="extencionmin();" class="form-control" required value="{{$directorio->ext1_enlace}}" />
		<div class="help-block with-errors"></div>
		<div class="text-danger" id='error_ext1_enlace'>{{$errors->formulario->first('ext1_enlace')}}</div>
	</div>
</div>



<div class="form-group">
	<label class="col-sm-3 control-label">Ext2 Enlace: <strog class="theme_color">*</strog></label>
	<div class="col-sm-6">
		<input name="ext2_enlace" type="text" id="ext2_enlace" placeholder="xxxx" maxlength="4" onkeypress="return soloNumeros(event)" onchange="extencion2min();"  class="form-control" required value="{{$directorio->ext2_enlace}}" />
		<div class="help-block with-errors"></div>
		<div class="text-danger" id='error_ext2_enlace'>{{$errors->formulario->first('ext2_enlace')}}</div>
	</div>
</div>


<div class="form-group">
	<label class="col-sm-3 control-label">Correo Enlace: <strog class="theme_color">*</strog></label>
	<div class="col-sm-6">
		<input name="correo_enlace" type="email" id="correo_enlace" placeholder="usuario@correo.com" class="form-control" required value="{{$directorio->correo_enlace}}" />

	</div>
</div>


<div class="form-group">
	<label class="col-sm-3 control-label">Director Regional: <strog class="theme_color">*</strog></label>
	<div class="col-sm-6">
		<input name="director_regional" type="text" id="director_regional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" onkeypress="return soloLetras(event)"   class="form-control" required value="{{$directorio->director_regional}}" />
	</div>

</div>


<div class="form-group">
	<label class="col-sm-3 control-label">Telefono Director: <strog class="theme_color">*</strog></label>
	<div class="col-sm-6">
		<input name="telefono_director" id="telefono_director" placeholder="xxx-xxx-xx-xx" type="number" maxlength="10" onkeypress="return maxlengthtelefonosdir();soloNumeros()"  class="form-control" required value="{{$directorio->telefono_director}}" />
		<div class="help-block with-errors"></div>
		<div class="text-danger" id='error_telefono_director'>{{$errors->formulario->first('telefono_director')}}</div>

	</div>
</div>



		<div class="form-group">
			<label class="col-sm-3 control-label">Financiero Regional: <strog class="theme_color">*</strog></label>
			<div class="col-sm-6">
				<input name="financiero_regional" type="text" id="financiero_regional" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" onkeypress="return soloLetras(event)"   class="form-control" required value="{{$directorio->financiero_regional}}" />
			</div>
		</div>



			<div class="form-group">
				<label class="col-sm-3 control-label">Telefono Regional: <strog class="theme_color">*</strog></label>
				<div class="col-sm-6">
					<input name="telefono_director" id="telefono_director" placeholder="xxx-xxx-xx-xx" type="number" maxlength="10" onkeypress="return maxlengthtelefonosdir();soloNumeros()"  class="form-control" required value="{{$directorio->telefono_regional}}" />
					<div class="help-block with-errors"></div>
					<div class="text-danger" id='error_telefono_regional'>{{$errors->formulario->first('telefono_regional')}}</div>
				</div>
			</div>



				<div class="form-group">
					<label class="col-sm-3 control-label">Extencion Regional 1: <strog class="theme_color">*</strog></label>
					<div class="col-sm-6">
						<input name="ext_reg_1" type="text" id="ext_reg_1" maxlength="4" placeholder="xxxx" onkeypress="return soloNumeros(event)"  onchange="extencionregmin()"  class="form-control" required value="{{$directorio->ext_reg_1}}" />
						<div class="help-block with-errors"></div>
						<div class="text-danger" id='error_ext_reg_1'>{{$errors->formulario->first('ext_reg_1')}}</div>
					</div>
				</div>


					<div class="form-group">
						<label class="col-sm-3 control-label">Extencion Regional 2: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<input name="ext_reg_2" type="text" id="ext_reg_2" maxlength="4" placeholder="xxxx" onkeypress="return soloNumeros(event)" onchange="extencionreg2min()"  class="form-control"   class="form-control" required value="{{$directorio->ext_reg_2}}" />
							<div class="help-block with-errors"></div>
							<div class="text-danger" id='error_ext_reg_2'>{{$errors->formulario->first('ext_reg_2')}}</div>
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
								<button type="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/directorio_regional')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@endsection
