{!! Form::open(array('url'=>'/tabulador_pagos','method' => 'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<select name="searchText" id="searchText" value="2018-2019" class="form-control" required>
				@foreach($tabla_pagos as $tabla_pagos)
				<option value="{{$tabla_pagos->tabla_pagos}}">
					{{$tabla_pagos->tabla_pagos}}
				</option>
				@endforeach
			</select>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>

		</span>
	</div>
</div>
