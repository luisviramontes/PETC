{!! Form::open(['route' => ['listas_asistencias.index'],'method' => 'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
	<div class="input-group">

			<div class="col-sm-16">
				<input name="searchText" id="searchText" type="text" value="{{$searchText}}"  class="form-control" required  onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"/>
			</div>


		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>

		</span>
	</div>
</div>

<div class="form-group">
						<label class="col-sm-3 control-label">Seleccione Ciclo Escolar : <strog class="theme_color"></strog></label>
						<div class="col-sm-6">
							<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2" onchange="enviar_ciclo_listas();cambia_ruta_lista()" >
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
