<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-2">
	<div class="modal-dialog">
		<div class="modal-content panel default blue_border horizontal_border_1">
			<div class="modal-body">
				<div class="row">
					<div class="block-web">
						<div class="header">
							<h3 class="content-header theme_color">&nbsp;Generar Oficio de Reclamos </h3>
						</div>
						<div class="porlets-content" style="margin-bottom: -50px;">
							<form action="{{route('reclamos.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
								{{csrf_field()}}

								<h4>¿Esta segúro que desea Inactivar este Registro del Personal de ETC?</h4>
								<br> <br>
								<div class="form-group">
									<label class="col-sm-3 control-label">N° Oficio: <strog class="theme_color">*</strog></label>
									<div class="col-sm-6">
										<input name="oficio" type="text" id="oficio"  value="SA/DFE/DHA/ETC.-/2019" class="form-control" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
									</div>
								</div>
								<br> <br>

								<div class="form-group">
									<label class="col-sm-3 control-label">Motivo: <strog class="theme_color">*</strog></label>
									<div class="col-sm-6">
										<textarea  name="motivo" type="text" id="motivo" class="form-control" required vonKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" rows="10" cols="30"> debido a una diferencia de pago en varias quincenas, ya que por distintas situaciones no se encontraron activos en el sistema de nómina de la Secretaria de Educación (SIPETC)</textarea>
									</div>
								</div>

								
								
								<br> <br>

								<div class="form-group">
									<label class="col-sm-3 control-label">Observaciones: <strog class="theme_color">*</strog></label>
									<div class="col-sm-6">
										<input name="observaciones" type="text" id="observaciones"   class="form-control" required value="{{Input::old('observaciones')}}" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
									</div>
								</div>

								<br> <br>
									<div class="form-group">
						<label class="col-sm-3 control-label">Genero Oficio: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select name="genero" id="genero"  class="form-control select" ">
								@foreach($genero as $genero) 
								<option value='{{$genero->abrebiatura}}_{{$genero->id}}'>
									{{$genero->nombre}}
								</option>
								@endforeach
							</select>

						</div>
					</div>

					<br> <br>
					<div class="form-group">
						<label class="col-sm-3 control-label">Se Solicita Pago para Qna: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select name="pagos" id="pagos"  class="form-control select" ">
								@foreach($pagos as $pagos) 
								<option value='{{$pagos->qna}}'>
									{{$pagos->qna}}
								</option>
								@endforeach
							</select>

						</div>
					</div>







							</div><!--/porlets-content-->
						</div><!--/block-web-->
					</div>
				</section> 
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
			<div class="modal-footer" style="margin-top: -10px;">
				<div class="row col-md-5 col-md-offset-7" style="margin-top: -5px;">     

					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit"  id="submit8"  onclick="return guardar_reclamo();" class="btn btn-primary">Guardar</button>
				</form>
			</div>
		</div>
	</div><!--/modal-content-->
</div><!--/modal-dialog-->
</div><!--/modal-fade-->


