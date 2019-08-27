{!! Form::open(array('url'=>'/altasest','method' => 'GET','autocomplete'=>'on','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input  type="text" name="searchText" id="searchText" vvalue="{{$searchText}}"   class="form-control" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >				
			</select>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>			

		</span>
	</div>
</div>
{!! Form::close() !!}