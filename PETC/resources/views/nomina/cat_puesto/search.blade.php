{!! Form::open(['route' => ['cat_puesto.index'],'method' => 'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
	<div class="input-group">

			<div class="col-sm-16">
				<input name="searchText" id="searchText" type="text"   class="form-control" value="{{$searchText}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"/>
			</div>


		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>

		</span>
	</div>
</div>
{!! Form::close() !!}
