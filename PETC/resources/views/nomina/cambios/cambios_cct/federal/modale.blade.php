<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete2-{{$datos->id}}">
	<div class="modal-dialog">
		<div class="modal-content panel default blue_border horizontal_border_1">
			<div class="modal-body">
				<div class="row">
					<div class="block-web">
						<div class="header">
						<h3 class="content-header theme_color">&nbsp;Activar Registro : {{$datos->nombre}}</h3>
						</div>
						<div class="porlets-content" style="margin-bottom: -50px;">

							<h4>¿Esta segúro que desea Marcar como Resuelto este registro ?</h4>
						</div><!--/porlets-content-->
					</div><!--/block-web-->
				</div>
			</section>
		</div> 
		<div class="modal-footer" style="margin-top: -10px;">
			<div class="row col-md-5 col-md-offset-7" style="margin-top: -5px;">
				<form  action="{{url('/activarcambiocct_fed', [$datos->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
					{{csrf_field()}}

					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Activar</button>
				</form>
			</div>
		</div>
	</div><!--/modal-content-->
</div><!--/modal-dialog-->
</div><!--/modal-fade-->
