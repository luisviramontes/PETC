@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Directorio Regional</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('directorio_regional')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('directorio_regional')}}">Directorio Regional</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Directorio</strong></h2>
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
					<form action="{{route('directorio_regional.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}

						<div class="form-group">
							<label class="col-sm-3 control-label">Region <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="region" class="form-control" required>
									<option value="1">
										1
									</option>
									<option value="2">
										2
									</option>
									<option value="3">
										3
									</option>
									<option value="4">
										4
									</option>
									<option value="5">
										5
									</option>
									<option value="6">
										6
									</option>
									<option value="7">
										7
									</option>
									<option value="8">
										8
									</option>
									<option value="9">
										9
									</option>
									<option value="10">
										10
									</option>
									<option value="11">
										11
									</option>
									<option value="12">
										12
									</option>
									<option value="13">
										13
									</option>

								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->


            <div class="form-group">
							<label class="col-sm-3 control-label">Sostenimiento <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="sostenimiento" class="form-control" required>
									<option value="estatal">
										Estatal
									</option>
									<option value="federal">
										Federal
									</option>
                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div><!--/form-group-->


						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre Enlace: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="nombre_enlace" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="" onchange="mayus(this)" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="telefono" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Ext1 Enlace: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="ext1_enlace" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="" />
							</div>
						</div>

            <div class="form-group">
							<label class="col-sm-3 control-label">Ext2 Enlace: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="ext2_enlace" type="number"  onkeypress="soloNumeros(event)"  class="form-control" required value="" />
							</div>
						</div>

            <div class="form-group">
							<label class="col-sm-3 control-label">Correo Enlace: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="correo_enlace" type="email" placeholder="usuario@correo.com"  class="form-control" required value="" />
							</div>
						</div>

            <div class="form-group">
							<label class="col-sm-3 control-label">Director Regional: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="director_regional" type="text" onchange="mayus(this)" onkeypress="return soloLetras(event)"  class="form-control" required value="" />
							</div>
						</div>

            <div class="form-group">
							<label class="col-sm-3 control-label">Telefono Director: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="telefono_director" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="" />
							</div>
						</div>

            <div class="form-group">
							<label class="col-sm-3 control-label">Financiero Regional: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="financiero_regional" type="text" onchange="mayus(this)" onkeypress="return soloLetras(event)"  class="form-control" required value="" />
							</div>
						</div>

            <div class="form-group">
							<label class="col-sm-3 control-label">Telefono Regional: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="telefono_regional" type="number" onkeypress="soloNumeros(event)"  class="form-control" required value="" />
							</div>
						</div>

            <div class="form-group">
							<label class="col-sm-3 control-label">Extencion Regional 1: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="ext_reg_1" type="number" onkeypress="soloNumeros(event)"  class="form-control" required value="" />
							</div>
						</div>

            <div class="form-group">
							<label class="col-sm-3 control-label">Extencion Regional 2: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="ext_reg_2" type="number" onkeypress="soloNumeros(event)"  class="form-control" required value="" />
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
