@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Editar Nominas Capturada</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('nomina_capturada')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('nomina_capturada')}}">Editar Nomina Capturada</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Editar Nomina</strong></h2>
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
          <form action="{{url('/nomina_capturada', [$nomina_capturada->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">


						<div class="form-group">
							<label class="col-sm-3 control-label">Quincena <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="qna" id="qna" class="form-control select2" value="{{Input::old('qna')}}"  onchange="" required>
									@foreach($quincena as $quincena)
									<option value="{{$quincena->qna}}">
										{{$quincena->qna}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
							<div class="text-danger" id='error_qna'>{{$errors->formulario->first('qna')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
              <label class="col-sm-3 control-label">Sostenimiento <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <select name="sostenimiento" id="sostenimiento" class="form-control" value="{{Input::old('sostenimiento')}}"  onchange=""required>
                  <option value="FEDERAL">
                    FEDERAL
                  </option>
                  <option value="ESTATAL">
                    ESTATAL
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
						</div> -->

            <div class="form-group">
							<label class="col-sm-3 control-label">Tipo <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="tipo" id="tipo" class="form-control" onchange="" value="{{Input::old('tipo')}}" required>
									<option value="ORDINARIO">
										ORDINARIO
									</option>
									<option value="EXTRAORDINARIO">
										EXTRAORDINARIO
									</option>


								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->



												<div class="form-group">
												  <label class="col-sm-3 control-label">Subir Nomina: <strog class="theme_color">*</strog></label>
												  <div class="col-sm-6">

															<input type="file" id="file" name="file" onchange="valida_nomina();" <br> </br>
														<div class="text-danger" id='error_file'>{{$errors->formulario->first('file')}}</div>

													</div>
												  </div>





																			<div class="form-group">
																				<div class="col-sm-offset-7 col-sm-5">

																					<button type="submit" id="submit8" disabled="true" onclick="activar_button" class="btn btn-primary">Guardar</button>
																					<a href="{{url('/nomina_capturada')}" class="btn btn-default"> Cancelar</a>
																				</div>
																			</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@endsection
