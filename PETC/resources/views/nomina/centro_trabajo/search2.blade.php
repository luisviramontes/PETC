{!! Form::open(['route' => ['ubica_escuela.index'],'method' => 'GET','autocomplete'=>'off','role'=>'search']) !!}
<br><br>
<div class="form-group">
	<label class="col-sm-3 control-label">Seleccione Municipio: <strog class="theme_color"></strog></label>
	<div class="col-sm-6">
		<select name="municipio" id="municipio"  onchange="traer_localidad();" class="form-control select2">
			@foreach($municipios as $municipios)
			@IF($municipios->id ==$municipio)
			<option value='{{$municipios->id}}' selected>
				{{$municipios->municipio}}
			</option>
			@ELSE
			<option value='{{$municipios->id}}' >
				{{$municipios->municipio}}
			</option>
			@ENDIF
			@endforeach
		</select>

	</div>
</div>
<br><br>

<div class="form-group">
	<label class="col-sm-3 control-label">Seleccione Localidad: <strog class="theme_color"></strog></label>
	<div class="col-sm-6">
		<select name="localidad" id="localidad" class="form-control select2">
			<option value='SELECCIONE' >Seleccione Localidad</option>
		</select>

	</div>
</div>

<span class="input-group-btn">
	<button type="submit" class="btn btn-primary">Buscar</button>

</span>

{!! Form::close() !!}