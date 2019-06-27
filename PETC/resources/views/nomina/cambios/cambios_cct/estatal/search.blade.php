{!! Form::open(array('url'=>'/cambios_cct_est','method' => 'GET','autocomplete'=>'on','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input  type="text" name="searchText" id="searchText" value="{{Input::old('searchText')}}"  class="form-control" >				
			</select>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>			

		</span>
	</div>
</div>
{!! Form::close() !!}