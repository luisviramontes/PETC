{!! Form::open(['route' => ['consulta_pagos.index'],'method' => 'GET','autocomplete'=>'off','role'=>'search']) !!}
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

					<br><br>
					<div class="form-group">
						<label class="col-sm-3 control-label">Sostenimiento;<strog class="theme_color">*</strog></label>
						<div class="col-sm-8">
							<select name="sostenimiento" id="sostenimiento" class="form-control select" required>

								@if($sostenimiento == "FEDERAL")

								<option value="FEDERAL" selected>FEDERAL</option>

								<option value="ESTATAL" >ESTATAL </option>

								@else
								<option value="FEDERAL" >FEDERAL</option>

								<option value="ESTATAL" selected>ESTATAL </option>
								@endif
							</select>

						</div>
					</div>
					<br><br>

					<div class="form-group">
						<label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
						<div class="col-sm-8">
							<input name="rfc_input" id="rfc_input" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" type="text"   class="form-control" required value="{{$rfc_input}}"   oninput="validarInput(this);"  onchange="validarRFC();"  />
							<div class="text-danger" id='error_rfc' name="error_rfc" ></div>
						</div>
						<pre id="resultado"></pre>
					</div>
					<br><br>

					<div class="form-group">
						<label class="col-sm-3 control-label">Seleccione Ciclo Escolar : <strog class="theme_color"></strog></label>
						<div class="col-sm-6">
							<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2" "  >
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


					<br><br>
					<span class="input-group-btn">
						<button type="submit3" id="buscar" class="btn btn-primary">Buscar</button>

					</span>
				</div>
			</div>
			{!! Form::close() !!}