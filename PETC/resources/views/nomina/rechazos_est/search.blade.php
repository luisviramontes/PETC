{!! Form::open(['route' => ['rechazos_est.index'],'method' => 'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
	<div class="input-group">
		<div class="form-group">
			<div class="col-sm-10">
				<input name="searchText" type="text" id="searchText" class="form-control" value="" />
			</div>
		</div>
		<span class="input-group-btn">
			<button type="submit" id="buscar" class="btn btn-primary">Buscar</button>

		</span>
	</div>
</div>
{!! Form::close() !!}