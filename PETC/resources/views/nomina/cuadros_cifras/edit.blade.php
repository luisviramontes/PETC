@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Editar Tabla de Pagos</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('cuadros_cifras')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('cuadros_cifras')}}">Tabla de Pagos</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Editar Pago: QNA {{$cuadro->qna}} Ciclo: {{$cuadro->ciclo}}</strong></h2> 
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
					<form action="{{url('/cuadros_cifras', [$cuadro->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">

						<div class="form-group">
							<label class="col-sm-3 control-label">N° Quincena <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="qna" type="qna"   disabled="true" value="{{$cuadro->qna}}" class="form-control" required maxlength="3" min="1" max ="199" />						

								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->


						<div class="form-group">
							<label class="col-sm-3 control-label">Categoria: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="dias" type="text"  disabled="true" value="{{$cuadro->categoria}}" class="form-control" required  />
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-3 control-label">Total de Registros <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="total" type="total"    value="{{$cuadro->total_reclamos}}" class="form-control" required maxlength="4" min="1" max ="9999" />						

								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Total de Percepciones <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="percepc" id="percepc" type="text"   value="{{$cuadro->total_percepciones}}"   class="form-control" required  />						

								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Total de Deducciónes <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="deducciones"  id="deducciones" type="text"   value="{{$cuadro->total_deducciones}}"  class="form-control" required  />						

								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Total de Liquido <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="liquido"  id="liquido" type="text"   value="{{$cuadro->total_liquido}}"  class="form-control" required  />						

								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->

					

						<div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo" class="form-control select2" disabled="true" required>
									@foreach($ciclos as $ciclo)

									@if($cuadro->id_ciclo == $ciclo->id)
									<option value="{{$ciclo->id}}" selected>{{$ciclo->ciclo}}</option>
									@else
									<option value="{{$ciclo->id}}">
										{{$ciclo->ciclo}} 
									</option>
									@endif             
									@endforeach              
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->





							<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
								<button onclick="return valida_cuadrocifras();"  id="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/cuadros_cifras')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">


$("#liquido").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});


$("#deducciones").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});

$("#percepc").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});

</script>
@endsection
