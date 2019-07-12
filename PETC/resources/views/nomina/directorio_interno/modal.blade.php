<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$datos->id}}">
  <div class="modal-dialog">
    <div class="modal-content panel default blue_border horizontal_border_1">
      <div class="modal-body">
        <div class="row">
          <div class="block-web">
            <div class="header">
              <h3 class="content-header theme_color">&nbsp;Eliminar Registro</h3>
            </div>
            <div class="porlets-content" style="margin-bottom: -50px;">
              <h4>¿Esta segúro que desea Inactivar este Registro?</h4>
            </div><!--/porlets-content-->


          </div><!--/block-web-->
          <br> <br> <br>
                     <div class="form-group">
                <label class="col-sm-3 control-label">Fecha de Termino de Labores<strog class="theme_color">*</strog></label>
                <div class="col-sm-8">

                  <input type="date" name="fecha_salida{{$datos->id}}" id="fecha_salida{{$datos->id}}" value="" class="form-control mask" >
                </div>
              </div>

        </div>

      </section>
    </div>
    <div class="modal-footer" style="margin-top: -10px;">
      <div class="row col-md-5 col-md-offset-7" style="margin-top: -5px;">
      <form action="{{url('directorio_interno', [$datos->id])}}" method="POST">
         <input type="hidden" name="_method" value="DELETE">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         <button type="submit" class="btn btn-primary">Eliminar</button>
       </form>
     </div>
   </div>
 </div><!--/modal-content-->
</div><!--/modal-dialog-->
</div><!--/modal-fade-->
