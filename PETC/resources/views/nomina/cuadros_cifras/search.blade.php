{!! Form::open(['route' => ['cuadros_cifras.index'],'method' => 'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
	<div class="input-group">

				<div class="form-group">
								<label class="col-sm-3 control-label">Seleccione Ciclo Escolar : <strog class="theme_color"></strog></label>
								<div class="col-sm-6">
									<select name="ciclo_escolar2" id="ciclo_escolar2" onchange="enviar_ciclo7();cambia_ruta();" class="form-control select2"  >
										@foreach($ciclos as $ciclo)
										@if($ciclo->id == $ciclo_escolar2)
										<option value='{{$ciclo->id}}' selected>
											{{$ciclo->ciclo}}
										</option>
										@else
										<option value='{{$ciclo->id}}'>
											{{$ciclo->ciclo}}
										</option>
										@endif
										@endforeach
						 			</select>

								</div>
								<span class="input-group-btn">
				<button type="submit" id="buscar" class="btn btn-primary">Buscar</button>

			</span>
							</div>

	</div>
</div>
{!! Form::close() !!}
