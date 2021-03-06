{!! Form::open(['route' => ['nomina_capturada.index'],'method' => 'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
	<div class="input-group">
		<div class="form-group">
			<div class="col-sm-10">
				<input name="searchText" type="text" id="searchText" class="form-control" value="{{$searchText}}" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
			</div>
		</div>
		<span class="input-group-btn">
			<button type="submit" id="buscar" class="btn btn-primary">Buscar</button>

		</span>
	</div>
</div>

<div class="form-group">
				<label class="col-sm-3 control-label">Seleccione Ciclo Escolar : <strog class="theme_color"></strog></label>
				<div class="col-sm-6">
					<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2" onchange="cambia_ruta();enviar_ciclo10();" >
						@foreach($ciclos as $ciclo)
						@if($ciclo->id == $ciclo_escolar)
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
			</div>	
{!! Form::close() !!}
