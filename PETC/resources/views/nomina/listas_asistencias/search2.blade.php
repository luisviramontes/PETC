{!! Form::open(['route' => ['consulta_listas.index'],'method' => 'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">

	<br>
	<div class="form-group">
		<label class="col-sm-3 control-label">CCT PETC<strog class="theme_color">*</strog></label>
		<div class="col-sm-8">
			<select name="cct2" id="cct2" class="form-control select2"   value="{{$cct2}}" required>				
				@foreach($cct as $ct)
				@if($ct->id == $cct2)
				<option value="{{$ct->id}}" selected>
					{{$ct->cct}}
					</option>
						@else
						<option value="{{$ct->id}}">
							{{$ct->cct}}
							</option>
							@endif
								@endforeach
							</select>				
						</div>
					</div><!--/form-group-->

					<br><br><br>


					<div class="form-group">
						<label class="col-sm-3 control-label">Seleccione Ciclo Escolar : <strog class="theme_color"></strog></label>
						<div class="col-sm-6">
							<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2" "  >
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


					<br><br>
					<span class="input-group-btn">
						<button type="submit3" id="buscar" class="btn btn-primary">Buscar</button>

					</span>
				</div>
			</div>
			{!! Form::close() !!}