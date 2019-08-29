<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete2-{{$pagos->id}}">
	<div class="modal-dialog">
		<div class="modal-content panel default blue_border horizontal_border_1">
			<div class="modal-body">
				<div class="row">
					<div class="block-web">
						<div class="header">
						<h3 class="content-header theme_color">&nbsp;Activar Registro : {{$pagos->nom_emp}}</h3>
						</div>
						<div class="porlets-content" style="margin-bottom: -50px;">

							<h4>¿Esta segúro que desea Marcar como Resuelto este registro ?</h4>
							<h3>Se Marcará Como que este Registro Le Corresponde Su Pago Correctamente </h3>
						</div><!--/porlets-content-->
					</div><!--/block-web-->
				</div>
			</section>
		</div> 
		<div class="modal-footer" style="margin-top: -10px;">
			<div class="row col-md-5 col-md-offset-7" style="margin-top: -5px;">
				<form  action="{{url('/activarpagos_improcedentes', [$pagos->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
					{{csrf_field()}}

					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Activar</button>
				</form>
			</div>
		</div>
	</div><!--/modal-content-->
</div><!--/modal-dialog-->
</div><!--/modal-fade-->