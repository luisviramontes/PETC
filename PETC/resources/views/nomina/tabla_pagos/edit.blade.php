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
			<li><a style="color: #808080" href="{{url('tabla_pagos')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('tabla_pagos')}}">Tabla de Pagos</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Editar Pago: QNA {{$pago->qna}} Ciclo: {{$pago->ciclo}}</strong></h2> 
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
					<form action="{{url('/tabla_pagos', [$pago->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">

						<div class="form-group">
							<label class="col-sm-3 control-label">N° Quincena <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="qna" class="form-control select2" required>  
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
									<option value="14">
										14                 
									</option>       
									<option value="15">
										15                 
									</option>       
									<option value="16">
										16                 
									</option>       
									<option value="17">
										17                 
									</option>       
									<option value="18">
										18                 
									</option>       
									<option value="19">
										19                 
									</option>       
									<option value="20">
										20                 
									</option>       
									<option value="21">
										21                 
									</option>       
									<option value="22">
										22                 
									</option>       
									<option value="23">
										23                 
									</option>       
									<option value="24">
										24                 
									</option>                       
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->


						<div class="form-group">
							<label class="col-sm-3 control-label">Dias Hábiles: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="dias" type="number"   value="{{$pago->dias}}" class="form-control" required maxlength="3" min="1" max ="199" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Pago por Director: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pago_director" id="pago_director" type="number"   class="form-control" required value="{{$pago->pago_director}}"  maxlength="3" min="1" max ="999"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Pago por Docente: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pago_docente" id="pago_docente" type="number"   class="form-control" required value="{{$pago->pago_docente}}" maxlength="3" min="1" max ="999"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Pago por Intendete: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pago_intendente" id="pago_intendente"  type="number"   class="form-control" required value="{{$pago->pago_intendente}}" maxlength="3" min="1" max ="999"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo" class="form-control select2" required>
									@foreach($ciclos as $ciclo)

									@if($pago->id_ciclo == $ciclo->id)
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
								<button type="submit" onclick="return valida_montos();"  id="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/tabla_pagos')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@endsection
