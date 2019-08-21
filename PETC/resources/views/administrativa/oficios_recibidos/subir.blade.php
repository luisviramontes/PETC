<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete3-{{$oficios->id}}">
	<div class="modal-dialog">
		<div class="modal-content panel default blue_border horizontal_border_1">
			<div class="modal-body">
				<div class="row">
					<div class="block-web">
						<div class="header">
							<h3 class="content-header theme_color">&nbsp;Subir Copia de Oficio</h3>
						</div>
						<div class="porlets-content" style="margin-bottom: -50px;">
							<form  action="{{url('/subir_imagen_oficior', [$oficios->id])}}" method="POST" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
								{{csrf_field()}}

								<input type="hidden" value="{{$oficios->id}}">



								<h4>Subir Copia de Oficio</h4>
								<br> <br>





								<div class="form-group">
									<label class="col-sm-3 control-label">Archivo: <strog class="theme_color"></strog></label>
									<div class="col-sm-6">
										<input name="archivo{{$oficios->id}}" id="archivo{{$oficios->id}}" type="file"  accept=".pdf,.jpg, .jpeg, .png" />
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
					<button type="submit" class="btn btn-primary">Subir</button>
				</form>

			</div>
		</div>
	</div><!--/modal-content-->
</div><!--/modal-dialog-->
</div><!--/modal-fade-->


