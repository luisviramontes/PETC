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
             <form action="{{url('captura', [$datos->id])}}" method="POST" lass="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
        {{csrf_field()}}

         <input type="hidden" name="_method" value="DELETE">
           <input type="hidden" value="{{$datos->id}}">

              <h4>¿Esta segúro que desea Inactivar este Registro del Personal de ETC?</h4>
              <br> <br>
              <div class="form-group">


                <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
                <div class="col-sm-8">

                  <input name="observaciones{{$datos->id}}" name="observaciones{{$datos->id}}" type="text"  maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="{{$datos->id}}" placeholder="Ingrese las Observaciónes de la Baja"/>
                </div>
              </div>
              <br> <br>

              <div class="form-group">
                <label class="col-sm-3 control-label">Documentación Entregada: <strog class="theme_color">*</strog></label>
                <div class="col-sm-8">
                  <input type="checkbox" name="doc1" id="doc1" onchange="cambia5(this.id)" value="ORDEN">Orden de Presentación<br>
                  <input type="checkbox" name="doc2" id="doc2" onchange="cambia5(this.id)" value="OFICIO">Ofició<br>
                  <input type="checkbox" name="doc3" id="doc3" onchange="cambia5(this.id)" value="TALON">Talón de Cheque<br>
                </div>

              </div><!--/form-group-->  
              <br> <br>
              <br> <br>

              <div class="form-group">
                <label class="col-sm-3 control-label">Fecha de Termino de Labores<strog class="theme_color">*</strog></label>
                <div class="col-sm-8">

                  <input type="date" name="fecha{{$datos->id}}" id="fecha{{$datos->id}}" value="" class="form-control mask" >
                </div>
              </div>




              <div class="form-group">
                <div class="col-sm-6">
                  <input  id="doc"  name="doc" type="hidden"  class="form-control""/>
                </div>
              </div>


            </div><!--/porlets-content-->
          </div><!--/block-web-->
        </div>
      </section> 
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
    <div class="modal-footer" style="margin-top: -10px;">
      <div class="row col-md-5 col-md-offset-7" style="margin-top: -5px;">     

         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         <button type="submit" class="btn btn-primary">Eliminar</button>
       </form>
     </div>
   </div>
 </div><!--/modal-content-->
</div><!--/modal-dialog-->
</div><!--/modal-fade-->


