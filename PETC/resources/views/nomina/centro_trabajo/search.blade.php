{!! Form::open(array('url'=>'/centro_trabajo','method' => 'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input  type="text" name="searchText" id="searchText" value="" class="form-control" >
			</select>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>

		</span>
	</div>
</div>

<div class="form-group">
						<label class="col-sm-3 control-label">Seleccione Ciclo Escolar : <strog class="theme_color"></strog></label>
						<div class="col-sm-6">
							<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2" onchange="enviar_ciclo_centro_trabajo()" >
								@foreach($ciclos as $ciclo)
								@if($ciclo->ciclo == $ciclo_escolar)
								<option value='{{$ciclo->ciclo}}' selected>
									{{$ciclo->ciclo}}
								</option>
								@else
								<option value='{{$ciclo->ciclo}}'>
									{{$ciclo->ciclo}}
								</option>
								@endif
								@endforeach
							</select>

						</div>
</div>

{!! Form::close() !!}
