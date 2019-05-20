{!! Form::open(['route' => ['ciclo_escolar.index'],'method' => 'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
	<div class="input-group">
		<select name="searchText" id="searchText" value="2018-2019" class="form-control" required>
				@foreach($ciclos as $ciclos)
				<option value="{{$ciclos->ciclo}}">
					{{$ciclos->ciclo}}
				</option>
				@endforeach
			</select>

		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>

		</span>
	</div>
</div>
{!!form::close()!!}
