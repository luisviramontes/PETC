{!! Form::open(array('url'=>'/captura','method' => 'GET','autocomplete'=>'on','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input  type="text" name="searchText" id="searchText" value="{{$searchText}}"  class="form-control" >
			</select>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">Buscar</button>

		</span>
	</div>
</div>

{!! Form::close() !!}
