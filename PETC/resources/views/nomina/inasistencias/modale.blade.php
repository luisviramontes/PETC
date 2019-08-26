<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete2-{{$datos->id}}">
  <div class="modal-dialog">
    <div class="modal-content panel default blue_border horizontal_border_1">
      <div class="modal-body">
        <div class="row">
          <div class="block-web">
            <div class="header">
              <h3 class="content-header theme_color">&nbsp;Eliminar Registro</h3>
            </div>
            <div class="porlets-content" style="margin-bottom: -50px;">
            <form action="{{url('inasistencias', [$datos->id])}}" method="POST" lass="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
                {{csrf_field()}}

                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" value="{{$datos->id}}">

                <h4>¿Esta segúro que desea Aplicar Esta Inasistencia PETC?</h4>
                <br> <br>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Qna En la Que se Aplica la Inasistencia: <strog class="theme_color">*</strog></label>
                  <div class="col-sm-8">
                    <select name="qna{{$datos->id}}" id="qna{{$datos->id}}" class="form-control select2" ">
                      @foreach($qnas as $qna) 
                      <option value='{{$qna->qna}}'>
                        {{$qna->qna}}
                      </option>
                      @endforeach
                    </select>

                  </div>
                </div>
                <br> <br>
                <br> <br>




                <br> <br>
                          


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
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div><!--/modal-content-->
</div><!--/modal-dialog-->
</div><!--/modal-fade-->


