<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete">
  <div class="modal-dialog">
    <div class="modal-content panel default blue_border horizontal_border_1">
      <div class="modal-body">
        <div class="row">
          <div class="block-web">
            <div class="header">
              <h3 class="content-header theme_color">&nbsp;Fortalecimientos</h3>
            </div>
            <div class="porlets-content" style="margin-bottom: -50px;">
              <h4>Subir Fortalecimientos Excel.</h4>
            </div><!--/porlets-content-->
          </div><!--/block-web-->
        </div>
      </section>
    </div>
    <div class="modal-footer" style="margin-top: -10px;">
      <div class="col-md-12">
        <form action="{{url('subirforta')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
          {{csrf_field()}}

          <div class="form-group">
            	<label class="col-sm-3 control-label">Cargar Archivo: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<input type="file" id="file" name="file" onchange="valida_file_forta()" required=""  accept=".csv" onchange="">
							<div class="text-danger" id='error_file'>{{$errors->formulario->first('file')}}</div>
						</div>
					</div>

          <div align="center">
            <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong> Nota: <u> <b> El archivo excel Tiene que Llevar los encabezados de la Siguiente Forma </b> </u> </strong></h4>
            <img src="{{asset('img/ejemplos/fortas.png')}}" id="src"  alt="correcto" height="1000px" width="1000px" class="img-thumbnail">

          </div>

          <div class="form-group">
          <div class="">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         <button type="submit" id="submit1" disabled="true" class="btn btn-primary">Subir</button>
         </div>
         </div>
       </form>
     </div>
   </div>
 </div><!--/modal-content-->
</div><!--/modal-dialog-->
</div><!--/modal-fade-->
<script type="text/javascript">

window.onload = function() {
		valida_file_forta();
	}

function valida_file_forta(){
  var fileInput = document.getElementById('file');
  var filePath = fileInput.value;
  var allowedExtensions = /(.csv|.csv|.xlsx)$/i;

  if( document.getElementById("file").files.length == 0 ){

      //swal("ERROR!","No se ha seleccionado ninguna Nomina.","error");
      document.getElementById("error_file").innerHTML = "Carga tu nomina.";
      return false
    }else{

      if(!allowedExtensions.exec(filePath)){
        swal("WARNING!",'Solo es permitido subir archivos con extención ".csv y .xlsx" o de tipo Excel verifique sus datos',"warning");
        fileInput.value = '';
        return false;
      }
      document.getElementById('submit1').disabled=false;

    }

  }
</script>
