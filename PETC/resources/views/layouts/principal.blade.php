
@inject('metodo','petc\Http\Controllers\OficiosEmitidosController')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PETC</title>
  
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="icon" type="img" href="img/logopetc.jpg" />
    {!!Html::style('css/font-awesome.css')!!}
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/animate.css')!!}
    {!!Html::style('css/admin.css')!!}
    {!!Html::style('css/MisEstilos.css')!!}
    {!!Html::style('plugins/advanced-datatable/css/demo_table.css')!!}
    {!!Html::style('plugins/advanced-datatable/css/demo_page.css')!!}
    {!!Html::style('plugins/toggle-switch/toggles.css')!!}
    <!--link href="css/select2.css" rel="stylesheet"-->
    {!!Html::style('plugins/bootstrap-editable/bootstrap-editable.css')!!}
    {!!Html::style('plugins/dropzone/dropzone.css')!!}
    {!!Html::style('plugins/data-tables/DT_bootstrap.css')!!}
    {!!Html::style('plugins/data-tables/DT_bootstrap.css')!!}
    {!!Html::style('plugins/advanced-datatable/css/demo_table.css')!!}
    {!!Html::style('plugins/advanced-datatable/css/demo_page.css')!!}
    {!!Html::style('plugins/bootstrap-fileupload/bootstrap-fileupload.min.css')!!}
    {!!Html::style('plugins/file-uploader/css/jquery.fileupload.css')!!}
    {!!Html::style('plugins/file-uploader/css/jquery.fileupload-ui.css')!!}
    {!!Html::style('plugins/bootstrap-datepicker/css/datepicker.css')!!}
    {!!Html::style('plugins/bootstrap-timepicker/compiled/timepicker.css')!!}
    {!!Html::style('plugins/bootstrap-colorpicker/css/colorpicker.css')!!}
    {!!Html::style('plugins/select2/dist/css/select2.css')!!}

    <!--Estilos Para radio buton y switch -->
    {!!Html::style('plugins/toggle-switch/toggles.css')!!}
    {!!Html::style('plugins/checkbox/icheck.css')!!}
    {!!Html::style('plugins/checkbox/minimal/blue.css')!!}
    {!!Html::style('plugins/checkbox/minimal/green.css')!!}
    {!!Html::style('plugins/checkbox/minimal/grey.css')!!}
    {!!Html::style('plugins/checkbox/minimal/orange.css')!!}
    {!!Html::style('plugins/checkbox/minimal/pink.css')!!}
    {!!Html::style('plugins/checkbox/minimal/purple.css')!!}
    {!!Html::style('plugins/bootstrap-fileupload/bootstrap-fileupload.min.css')!!}

    <!--Wizard  -->
    {!!Html::style('plugins/wizard/css/smart_wizard.css')!!}
    <!-- Optional SmartWizard theme -->
    {!!Html::style('plugins/wizard/css/smart_wizard_theme_dots.css')!!}
    <!-- Optional SmartWizard theme -->
    {!!Html::style('plugins/wizard/css/smart_wizard_theme_circles.css')!!}
    {!!Html::style('plugins/wizard/css/smart_wizard_theme_arrows.css')!!}
    {!!Html::style('plugins/wizard/css/smart_wizard_theme_dots.css')!!}

  </head>
  <style type="text/css">
    .disabled {
      pointer-events:none; /*This makes it not clickable*/
      opacity:0.6;         /*This grays it out to look disabled*/
    }
    .lblheader{
      color:#2196F3;
    }

    a {
      color: #FFF;
      text-decoration: none;
    }

    b:hover{
      /*color: #428BCA;*/
      color: #66B5EB;
      /*background-color: lightblue;*/
    }

  </style>
  <body class="blue_thm  fixed_header left_nav_fixed">
    <div class="wrapper">
      <!--\\\\\\\ wrapper Start \\\\\\-->
      <div class="header_bar">
        <!--\\\\\\\ header Start \\\\\\-->
        <div class="brand">
          <!--\\\\\\\ brand Start \\\\\\-->
          <div class="logo" style="display:block"><span class="light_theme">PETC</span> </div>
          <div class="small_logo" style="display:none"><img src="images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
        </div>
        <!--\\\\\\\ brand end \\\\\\-->
        <div class="header_top_bar">
          <!--\\\\\\\ header top bar start \\\\\\-->
          <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
          <div class="top_left">

          </div>

          <div class="top_right_bar">            
            <div class="container">
             @if (Session::has('errors'))
             <div class="alert alert-warning" role="alert">
              <ul>
                <strong>Oops! Something went wrong : </strong>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
          </div>
          
          @if (Auth::guest())
          <ul class="dropdown-menu">
            <div class="top_pointer"></div>
            <li><a href="{{route('auth/login')}}">Login</a></li>
            <li><a href="{{route('auth/register')}}">Register</a></li>

            @else
            <div class="user_admin dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"><span class="user_adminname"><!--{{Route::getCurrentRoute()->getName()}}--> <i class="fa fa-user"></i> {{ Auth::user()->name }}</span> <b class="caret"></b> </a>

              <ul class="dropdown-menu">
                <div class="top_pointer"></div>
                <li> <a href="{{URL::action('DirectorioInternoController@perfil',Auth::user()->id_usuario )}}"><i class="fa fa-user"></i> Perfil</a> </li>
                <li> <a href="/oficiosemitidos"><i class="fa fa-warning"></i>{{$metodo->ver_oficios_persona()}} Oficios Emite</a>  </li>
                <li> <a href="/oficiosrecibidos"><i class="fa fa-warning"></i>{{$metodo->ver_oficios_personar()}} Oficios Recibe</a>  </li>
                <li> <a href="settings.html"><i class="fa fa-cog"></i> Ajustes </a></li>
                <li> <a href="{{route('auth/logout')}}""><i class="fa fa-power-off"></i> Salir</a> </li>
              </ul>
              @endif 
            </div>
          </div>
        </div>
        <!--\\\\\\\ header top bar end \\\\\\-->
      </div>
      <!--\\\\\\\ header end \\\\\\-->
      <div class="inner">
        <!--\\\\\\\ inner start \\\\\\--><div class="left_nav">

        <!--\\\\\\\left_nav start \\\\\\-->

        @if (Auth::guest())
        @else
        @if(Auth::user()->tipo_usuario == 2)

        <div class="left_nav_slidebar">
          <ul >
            <li class="left_nav_active theme_border"><a href="javascript:void(0);"><i class="glyphicon glyphicon-usd"></i> NOMINA<span class="left_nav_pointer"></span> <span class="plus"><i class="fa fa-plus"></i></span> </a>


              <ul  >
                <li> <a href="{{url('nomina_federal')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Federal</b> </a> </li>
                <li> <a href="{{url('nomina_estatal')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Estatal</b> </a> </li> 
                <li> <a href="{{url('nomina_capturada')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Nominas Capturadas</b> </a> </li>
                <li> <a href="{{url('cuadros_cifras?ciclo_escolar2=2')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Cuadro Cifras</b> </a> </li>
                <li> <a href="{{url('pagos_improcedentes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Pagos Improcedentes</b> </a> </li>
                <li> <a href="{{url('plan_contraste')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Plan Contraste</b> </a> </li> 
                <li> <a href="{{url('calculo_nomina')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Calculo de Nomina</b> </a> </li>                        

              </ul>
            </li>
            <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i>FEDERAL <span class="plus"><i class="fa fa-plus"></i></span></a>
              <ul>
                <li> <a href="{{url('captura')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Captura</b> </a> </li>
                <li> <a href="{{url('interinosfed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Interinos</b> </a> </li>
                <li> <a href="{{url('altasfed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Altas</b> </a> </li>
                <li> <a href="{{url('bajasfed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Bajas</b> </a> </li>
                <li> <a href="{{url('cambios_cct_fed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cambios CTE</b> </a> </li>
                <li> <a href="{{url('cambios_funcion_est')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cambios de Función</b> </a> </li>
                <li> <a href="{{url('rechazos_fed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Rechazos</b> </a> </li>

              </ul>

            </li>
            <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i>ESTATAL<span class="plus"><i class="fa fa-plus"></i></span></a>
              <ul>
                <li> <a href="{{url('captura')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Captura</b> </a> </li>
                <li> <a href="{{url('interinosest')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Interinos</b> </a> </li>
                <li> <a href="{{url('altasest')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Altas</b> </a> </li>
                <li> <a href="{{url('bajasest')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Bajas</b> </a> </li>
                <li> <a href="{{url('cambios_cct_est')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cambios CTE</b> </a> </li>
                <li> <a href="{{url('cambios_funcion_est')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cambios de Función</b> </a> </li>
                <li> <a href="{{url('rechazos_est')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Rechazos</b> </a> </li>
              </ul>




            </li>
            <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i> CAPTURA <span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul>
                <li> <a href="{{url('captura')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Captura</b> </a> </li>                        
              </ul>


            </li>
            <li> <a href="javascript:void(0);"> <i class="fa fa-home"></i> ESCUELAS <span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul>
                <li> <a href="{{url('centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Centros de Trabajo</b> </a> </li>
                <li> <a href="{{url('ver_centros_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Informe de CTE</b> </a> </li>
                <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>
                <li> <a href="{{url('municipios')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Municipios</b> </a> </li>
                <li> <a href="{{url('localidades')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Localidades</b> </a> </li>
              </ul>
            </li>


            <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-phone-alt"></i> DIRECTORIO <span class="plus"><i class="fa fa-plus"></i></span></a>
              <ul>
                <li> <a href="{{url('region')}}"> <span>&nbsp;</span> <i class="glyphicon glyphicon-phone-alt"></i> <b>Regiónes</b> </a> </li>
                <li> <a href="{{url('directorio_regional')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio Regional</b> </a> </li>
                <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>              
                <li> <a href="{{url('directorio_externo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio SEDUZAC</b> </a> </li>
                <li> <a href="{{url('directorio_interno')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio PETC</b> </a> </li>




              </ul>
            </li>
            <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pushpin"></i> LISTAS DE ASISTENCIA <span class="plus"><i class="fa fa-plus"></i></span></a>
              <ul>
                <li> <a href="{{url('listas_asistencias')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Listas de Asistencia</b> </a> </li>
                <li> <a href="{{url('recepcion_listas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recepción de Listas </b> </a> </li>
                <li> <a href="{{url('genera_listas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Generar Listas </b> </a> </li>
                <li> <a href="{{url('inasistencias2/2')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Inasistencias</b> </a> </li>
                <li> <a href="{{url('ver_listas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Reporte de Listas</b> </a> </li>
              </ul>
            </li>


            <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-usd"></i> REINTEGROS <span class="plus"><i class="fa fa-plus"></i></span></a>
              <ul>
                <li> <a href="{{url('reintegros')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Reintegros</b> </a> </li>

              </ul>
            </li>

            <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i> RECLAMOS <span class="plus"><i class="fa fa-plus"></i></span></a>
              <ul>
                <li> <a href="{{url('reclamos2/2')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Reclamos</b> </a> </li>

              </ul>
            </li>

            <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-usd"></i>PAGOS <span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul>
               <li> <a href="{{url('ciclo_escolar')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Ciclo Escolar</b> </a> </li>
               <li> <a href="{{url('tabla_pagos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tabla de Pagos</b> </a> </li>
             </ul>
             <ul>
              <li> <a href="{{url('tabulador_pagos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tabla de Pagos Por Dia Laborado</b> </a> </li>
            </ul>
            <ul>
              <li> <a href="{{url('calculadora_pagos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Calculadora de Pagos</b> </a> </li>
            </ul>
          </li>


          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-tasks"></i> FORTALECIMIENTO <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('fortalecimiento')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recurso de Fortalecimeinto</b> </a> </li>
              <li> <a href="{{url('tarjetas_fortalecimiento')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tarjetas de Fortalecimeinto</b> </a> </li>
              <li> <a href="{{url('tarjetas_forta')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Importar Tarjetas</b> </a> </li>
              <li> <a href="{{url('generar_cartas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cartas Compromiso</b> </a> </li>
            </ul>
          </li>


          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-user"></i> CATEGORIAS/PUESTO <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('cat_puesto')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Categorias y Puestos</b> </a> </li>
            </ul>
          </li>

          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i> SOLICITUDES DE INGRESO <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('solicitudes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Solicitudes</b> </a> </li>
            </ul>
          </li>

          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i>Oficios <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('oficiosrecibidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recibidos</b> </a> </li>
              <li> <a href="{{url('oficiosemitidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Emitidos</b> </a> </li>
            </ul>
          </li>

          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-usd"></i> Bancos <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('bancos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Bancos</b> </a> </li>
              <li> <a href="{{url('cuentas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cuentas</b> </a> </li>
            </ul>
          </li>

          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-th"></i> Estadisticas <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('estadistica911')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Estadistica 911</b> </a> </li>
            </ul>
          </li>


          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i> Otros <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('gmaps')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Mapas</b> </a> </li>  
              <li> <a href="{{url('calendario')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Eventos</b> </a> </li>            
            </ul>        
          </li>

          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i> Actividad Reciente <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('actividad')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Actividad Reciente</b> </a> </li>                        
            </ul>
          </li>

          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i> Avisos <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Avisos</b> </a> </li>                        
            </ul>
          </li>

          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i>Capacitaciones <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Capacitaciones</b> </a> </li>                        
            </ul>
          </li>

          <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i>Quejas Y Denuncias <span class="plus"><i class="fa fa-plus"></i></span> </a>
            <ul>
              <li> <a href="{{url('quejas')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Quejas Y Denuncias</b> </a> </li>                        
            </ul>
          </li>





        </ul>
      </div>
      @elseif (Auth::user()->tipo_usuario == 1)

      <div class="left_nav_slidebar">
        <ul >
        </li>


        <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Alimentación <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('servicio_a')}}" target="_blank"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Alimentación</b> </a> </li>                        
          </ul>
        </li>

        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i> Actividad Reciente <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('actividad')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Actividad Reciente</b> </a> </li>                        
          </ul>
        </li>

        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i> Avisos <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Avisos</b> </a> </li>                        
          </ul>
        </li>

        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i>Capacitaciones <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Capacitaciones</b> </a> </li>                        
          </ul>
        </li>




        <li> <a href="javascript:void(0);"> <i class="fa fa-home"></i> ESCUELAS <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Centros de Trabajo</b> </a> </li>
            <li> <a href="{{url('ver_centros_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Informe de CTE</b> </a> </li>
            <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>
            <li> <a href="{{url('municipios')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Municipios</b> </a> </li>
            <li> <a href="{{url('localidades')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Localidades</b> </a> </li>
          </ul>
        </li>


        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-phone-alt"></i> DIRECTORIO <span class="plus"><i class="fa fa-plus"></i></span></a>
          <ul>
            <li> <a href="{{url('region')}}"> <span>&nbsp;</span> <i class="glyphicon glyphicon-phone-alt"></i> <b>Regiónes</b> </a> </li>
            <li> <a href="{{url('directorio_regional')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio Regional</b> </a> </li>
            <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>              
            <li> <a href="{{url('directorio_externo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio SEDUZAC</b> </a> </li>
            <li> <a href="{{url('directorio_interno')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio PETC</b> </a> </li>




          </ul>
        </li>







        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-tasks"></i> FORTALECIMIENTO <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('fortalecimiento')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recurso de Fortalecimeinto</b> </a> </li>
            <li> <a href="{{url('tarjetas_fortalecimiento')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tarjetas de Fortalecimeinto</b> </a> </li>
            <li> <a href="{{url('generar_cartas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cartas Compromiso</b> </a> </li>
          </ul>
        </li>




        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i> SOLICITUDES DE INGRESO <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('solicitudes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Solicitudes</b> </a> </li>
          </ul>
        </li>

        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i>Oficios <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('oficiosrecibidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recibidos</b> </a> </li>
            <li> <a href="{{url('oficiosemitidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Emitidos</b> </a> </li>
          </ul>
        </li>



        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-th"></i> Estadisticas <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('estadistica911')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Estadistica 911</b> </a> </li>
          </ul>
        </li>


        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i> Otros <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('gmaps')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Mapas</b> </a> </li>  
            <li> <a href="{{url('calendario')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Eventos</b> </a> </li>            
          </ul>        
        </li>




      </ul>
    </div>


    @elseif(Auth::user()->tipo_usuario == 3)

    <div class="left_nav_slidebar">
      <ul >
        <li class="left_nav_active theme_border"><a href="javascript:void(0);"><i class="glyphicon glyphicon-usd"></i> NOMINA<span class="left_nav_pointer"></span> <span class="plus"><i class="fa fa-plus"></i></span> </a>


          <ul  >
            <li> <a href="{{url('nomina_federal')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Federal</b> </a> </li>
            <li> <a href="{{url('nomina_estatal')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Estatal</b> </a> </li> 
            <li> <a href="{{url('nomina_capturada')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Nominas Capturadas</b> </a> </li>
            <li> <a href="{{url('cuadros_cifras?ciclo_escolar2=2')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Cuadro Cifras</b> </a> </li>
            <li> <a href="{{url('pagos_improcedentes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Pagos Improcedentes</b> </a> </li>
            <li> <a href="{{url('plan_contraste')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Plan Contraste</b> </a> </li> 
            <li> <a href="{{url('calculo_nomina')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Calculo de Nomina</b> </a> </li>                        

          </ul>
        </li>


        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i> CAPTURA <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('captura')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Captura</b> </a> </li>                        
          </ul>


        </li>
        <li> <a href="javascript:void(0);"> <i class="fa fa-home"></i> ESCUELAS <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Centros de Trabajo</b> </a> </li>
            <li> <a href="{{url('ver_centros_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Informe de CTE</b> </a> </li>
            <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>
            <li> <a href="{{url('municipios')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Municipios</b> </a> </li>
            <li> <a href="{{url('localidades')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Localidades</b> </a> </li>
          </ul>
        </li>


        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-phone-alt"></i> DIRECTORIO <span class="plus"><i class="fa fa-plus"></i></span></a>
          <ul>
            <li> <a href="{{url('region')}}"> <span>&nbsp;</span> <i class="glyphicon glyphicon-phone-alt"></i> <b>Regiónes</b> </a> </li>
            <li> <a href="{{url('directorio_regional')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio Regional</b> </a> </li>
            <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>              
            <li> <a href="{{url('directorio_externo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio SEDUZAC</b> </a> </li>
            <li> <a href="{{url('directorio_interno')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio PETC</b> </a> </li>




          </ul>
        </li>
        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pushpin"></i> LISTAS DE ASISTENCIA <span class="plus"><i class="fa fa-plus"></i></span></a>
          <ul>
            <li> <a href="{{url('listas_asistencias')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Listas de Asistencia</b> </a> </li>
            <li> <a href="{{url('inasistencias2/2')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Inasistencias</b> </a> </li>
            <li> <a href="{{url('ver_listas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Reporte de Listas</b> </a> </li>
          </ul>
        </li>


        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-usd"></i> REINTEGROS <span class="plus"><i class="fa fa-plus"></i></span></a>
          <ul>
            <li> <a href="{{url('reintegros')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Reintegros</b> </a> </li>

          </ul>
        </li>

        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i> RECLAMOS <span class="plus"><i class="fa fa-plus"></i></span></a>
          <ul>
            <li> <a href="{{url('reclamos2/2')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Reclamos</b> </a> </li>

          </ul>
        </li>

        <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-usd"></i>PAGOS <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
           <li> <a href="{{url('ciclo_escolar')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Ciclo Escolar</b> </a> </li>
           <li> <a href="{{url('tabla_pagos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tabla de Pagos</b> </a> </li>
         </ul>
         <ul>
          <li> <a href="{{url('tabulador_pagos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tabla de Pagos Por Dia Laborado</b> </a> </li>
        </ul>
        <ul>
          <li> <a href="{{url('calculadora_pagos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Calculadora de Pagos</b> </a> </li>
        </ul>
      </li>


      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-tasks"></i> FORTALECIMIENTO <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('fortalecimiento')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recurso de Fortalecimeinto</b> </a> </li>
          <li> <a href="{{url('tarjetas_fortalecimiento')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tarjetas de Fortalecimeinto</b> </a> </li>
          <li> <a href="{{url('generar_cartas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cartas Compromiso</b> </a> </li>
        </ul>
      </li>


      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-user"></i> CATEGORIAS/PUESTO <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('cat_puesto')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Categorias y Puestos</b> </a> </li>
        </ul>
      </li>

      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i> SOLICITUDES DE INGRESO <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('solicitudes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Solicitudes</b> </a> </li>
        </ul>
      </li>

      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i>Oficios <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('oficiosrecibidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recibidos</b> </a> </li>
          <li> <a href="{{url('oficiosemitidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Emitidos</b> </a> </li>
        </ul>
      </li>

      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-usd"></i> Bancos <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('bancos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Bancos</b> </a> </li>
          <li> <a href="{{url('cuentas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cuentas</b> </a> </li>
        </ul>
      </li>

      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-th"></i> Estadisticas <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('estadistica911')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Estadistica 911</b> </a> </li>
        </ul>
      </li>

      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i> Actividad Reciente <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('actividad')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Actividad Reciente</b> </a> </li>                        
        </ul>
      </li>

      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i> Avisos <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Avisos</b> </a> </li>                        
        </ul>
      </li>

      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-th"></i>Capacitaciones <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Capacitaciones</b> </a> </li>                        
        </ul>
      </li>

      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i>Quejas Y Denuncias <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('quejas')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Quejas Y Denuncias</b> </a> </li>                        
        </ul>
      </li>


      <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i> Otros <span class="plus"><i class="fa fa-plus"></i></span> </a>
        <ul>
          <li> <a href="{{url('gmaps')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Mapas</b> </a> </li>  
          <li> <a href="{{url('calendario')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Eventos</b> </a> </li>            
        </ul>        
      </li>




    </ul>
  </div>



  @elseif(Auth::user()->tipo_usuario == 4)
  <div class="left_nav_slidebar">
    <ul >
    </li>


    <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i>Herramientas <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('servicio_a')}}" target="_blank"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Contraloría Social</b> </a> </li>     
        <li> <a href="{{url('ficheros')}}" target="_blank"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Líneas de Trabajo</b> </a> </li>         
        <li> <a href="{{url('materiales_a')}}" target="_blank"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Guías y Doc</b> </a> </li>                        
      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i> Actividad Reciente <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('actividad')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Actividad Reciente</b> </a> </li>                        
      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i> Avisos <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Avisos</b> </a> </li>                        
      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i>Capacitaciones <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Capacitaciones</b> </a> </li>                        
      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i>Quejas Y Denuncias <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('quejas')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Quejas Y Denuncias</b> </a> </li>                        
      </ul>
    </li>




    <li> <a href="javascript:void(0);"> <i class="fa fa-home"></i> ESCUELAS <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Centros de Trabajo</b> </a> </li>
        <li> <a href="{{url('ver_centros_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Informe de CTE</b> </a> </li>
        <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>
        <li> <a href="{{url('municipios')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Municipios</b> </a> </li>
        <li> <a href="{{url('localidades')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Localidades</b> </a> </li>
      </ul>
    </li>


    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-phone-alt"></i> DIRECTORIO <span class="plus"><i class="fa fa-plus"></i></span></a>
      <ul>
        <li> <a href="{{url('region')}}"> <span>&nbsp;</span> <i class="glyphicon glyphicon-phone-alt"></i> <b>Regiónes</b> </a> </li>
        <li> <a href="{{url('directorio_regional')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio Regional</b> </a> </li>
        <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>              
        <li> <a href="{{url('directorio_externo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio SEDUZAC</b> </a> </li>
        <li> <a href="{{url('directorio_interno')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio PETC</b> </a> </li>




      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i> SOLICITUDES DE INGRESO <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('solicitudes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Solicitudes</b> </a> </li>
      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i>Oficios <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('oficiosrecibidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recibidos</b> </a> </li>
        <li> <a href="{{url('oficiosemitidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Emitidos</b> </a> </li>
      </ul>
    </li>



    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-th"></i> Estadisticas <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('estadistica911')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Estadistica 911</b> </a> </li>
      </ul>
    </li>


    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i> Otros <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('gmaps')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Mapas</b> </a> </li>  
        <li> <a href="{{url('calendario')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Eventos</b> </a> </li>            
      </ul>        
    </li>




  </ul>
</div>

@elseif(Auth::user()->tipo_usuario == 5)
<div class="left_nav_slidebar">
  <ul >
    <li class="left_nav_active theme_border"><a href="javascript:void(0);"><i class="glyphicon glyphicon-usd"></i> NOMINA<span class="left_nav_pointer"></span> <span class="plus"><i class="fa fa-plus"></i></span> </a>


      <ul  >
        <li> <a href="{{url('nomina_federal')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Federal</b> </a> </li>
        <li> <a href="{{url('nomina_estatal')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Estatal</b> </a> </li> 
        <li> <a href="{{url('nomina_capturada')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Nominas Capturadas</b> </a> </li>
        <li> <a href="{{url('cuadros_cifras?ciclo_escolar2=2')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Cuadro Cifras</b> </a> </li>
        <li> <a href="{{url('pagos_improcedentes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Pagos Improcedentes</b> </a> </li>
        <li> <a href="{{url('plan_contraste')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Plan Contraste</b> </a> </li> 
        <li> <a href="{{url('calculo_nomina')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b >Calculo de Nomina</b> </a> </li>                        

      </ul>
    </li>
    <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i>FEDERAL <span class="plus"><i class="fa fa-plus"></i></span></a>
      <ul>
        <li> <a href="{{url('captura')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Captura</b> </a> </li>
        <li> <a href="{{url('interinosfed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Interinos</b> </a> </li>
        <li> <a href="{{url('altasfed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Altas</b> </a> </li>
        <li> <a href="{{url('bajasfed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Bajas</b> </a> </li>
        <li> <a href="{{url('cambios_cct_fed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cambios CTE</b> </a> </li>
        <li> <a href="{{url('cambios_funcion_est')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cambios de Función</b> </a> </li>
        <li> <a href="{{url('rechazos_fed')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Rechazos</b> </a> </li>

      </ul>

    </li>
    <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i>ESTATAL<span class="plus"><i class="fa fa-plus"></i></span></a>
      <ul>
        <li> <a href="{{url('captura')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Captura</b> </a> </li>
        <li> <a href="{{url('interinosest')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Interinos</b> </a> </li>
        <li> <a href="{{url('altasest')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Altas</b> </a> </li>
        <li> <a href="{{url('bajasest')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Bajas</b> </a> </li>
        <li> <a href="{{url('cambios_cct_est')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cambios CTE</b> </a> </li>
        <li> <a href="{{url('cambios_funcion_est')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cambios de Función</b> </a> </li>
        <li> <a href="{{url('rechazos_est')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Rechazos</b> </a> </li>
      </ul>




    </li>
    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i> CAPTURA <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('captura')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Captura</b> </a> </li>                        
      </ul>


    </li>
    <li> <a href="javascript:void(0);"> <i class="fa fa-home"></i> ESCUELAS <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Centros de Trabajo</b> </a> </li>
        <li> <a href="{{url('ver_centros_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Informe de CTE</b> </a> </li>
        <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>
        <li> <a href="{{url('municipios')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Municipios</b> </a> </li>
        <li> <a href="{{url('localidades')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Localidades</b> </a> </li>
      </ul>
    </li>


    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-phone-alt"></i> DIRECTORIO <span class="plus"><i class="fa fa-plus"></i></span></a>
      <ul>
        <li> <a href="{{url('region')}}"> <span>&nbsp;</span> <i class="glyphicon glyphicon-phone-alt"></i> <b>Regiónes</b> </a> </li>
        <li> <a href="{{url('directorio_regional')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio Regional</b> </a> </li>
        <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>              
        <li> <a href="{{url('directorio_externo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio SEDUZAC</b> </a> </li>
        <li> <a href="{{url('directorio_interno')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio PETC</b> </a> </li>




      </ul>
    </li>
    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pushpin"></i> LISTAS DE ASISTENCIA <span class="plus"><i class="fa fa-plus"></i></span></a>
      <ul>
        <li> <a href="{{url('listas_asistencias')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Listas de Asistencia</b> </a> </li>
        <li> <a href="{{url('recepcion_listas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recepción de Listas </b> </a> </li>
        <li> <a href="{{url('genera_listas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Generar Listas </b> </a> </li>
        <li> <a href="{{url('inasistencias2/2')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Inasistencias</b> </a> </li>
        <li> <a href="{{url('ver_listas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Reporte de Listas</b> </a> </li>
      </ul>
    </li>


    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-usd"></i> REINTEGROS <span class="plus"><i class="fa fa-plus"></i></span></a>
      <ul>
        <li> <a href="{{url('reintegros')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Reintegros</b> </a> </li>

      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i> RECLAMOS <span class="plus"><i class="fa fa-plus"></i></span></a>
      <ul>
        <li> <a href="{{url('reclamos2/2')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Reclamos</b> </a> </li>

      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-usd"></i>PAGOS <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
       <li> <a href="{{url('ciclo_escolar')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Ciclo Escolar</b> </a> </li>
       <li> <a href="{{url('tabla_pagos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tabla de Pagos</b> </a> </li>
     </ul>
     <ul>
      <li> <a href="{{url('tabulador_pagos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tabla de Pagos Por Dia Laborado</b> </a> </li>
    </ul>
    <ul>
      <li> <a href="{{url('calculadora_pagos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Calculadora de Pagos</b> </a> </li>
    </ul>
  </li>


  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-tasks"></i> FORTALECIMIENTO <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('fortalecimiento')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recurso de Fortalecimeinto</b> </a> </li>
      <li> <a href="{{url('tarjetas_fortalecimiento')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Tarjetas de Fortalecimeinto</b> </a> </li>
      <li> <a href="{{url('tarjetas_forta')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Importar Tarjetas</b> </a> </li>
      <li> <a href="{{url('generar_cartas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cartas Compromiso</b> </a> </li>
    </ul>
  </li>


  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-user"></i> CATEGORIAS/PUESTO <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('cat_puesto')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Categorias y Puestos</b> </a> </li>
    </ul>
  </li>

  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i> SOLICITUDES DE INGRESO <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('solicitudes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Solicitudes</b> </a> </li>
    </ul>
  </li>

  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i>Oficios <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('oficiosrecibidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recibidos</b> </a> </li>
      <li> <a href="{{url('oficiosemitidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Emitidos</b> </a> </li>
    </ul>
  </li>

  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-usd"></i> Bancos <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('bancos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Bancos</b> </a> </li>
      <li> <a href="{{url('cuentas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cuentas</b> </a> </li>
    </ul>
  </li>

  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-th"></i> Estadisticas <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('estadistica911')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Estadistica 911</b> </a> </li>
    </ul>
  </li>


  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i> Otros <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('gmaps')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Mapas</b> </a> </li>  
      <li> <a href="{{url('calendario')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Eventos</b> </a> </li>            
    </ul>        
  </li>

  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i> Actividad Reciente <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('actividad')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Actividad Reciente</b> </a> </li>                        
    </ul>
  </li>

  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i> Avisos <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Avisos</b> </a> </li>                        
    </ul>
  </li>

  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i>Capacitaciones <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Capacitaciones</b> </a> </li>                        
    </ul>
  </li>

  <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i>Quejas Y Denuncias <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('quejas')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Quejas Y Denuncias</b> </a> </li>                        
    </ul>
  </li>

  <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i>Herramientas <span class="plus"><i class="fa fa-plus"></i></span> </a>
    <ul>
      <li> <a href="{{url('servicio_a')}}" target="_blank"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Contraloría Social</b> </a> </li>     
      <li> <a href="{{url('ficheros')}}" target="_blank"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Líneas de Trabajo</b> </a> </li>         
      <li> <a href="{{url('materiales_a')}}" target="_blank"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Guías y Doc</b> </a> </li>                        
    </ul>
  </li>

  <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Alimentación <span class="plus"><i class="fa fa-plus"></i></span> </a>
          <ul>
            <li> <a href="{{url('servicio_a')}}" target="_blank"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Alimentación</b> </a> </li>                        
          </ul>
        </li>





</ul>
</div>

@elseif(Auth::user()->tipo_usuario == 6)
  <div class="left_nav_slidebar">
    <ul >
    </li>


    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i> Actividad Reciente <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('actividad')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Actividad Reciente</b> </a> </li>                        
      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i> Avisos <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Avisos</b> </a> </li>                        
      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i>Capacitaciones <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('avisos')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Capacitaciones</b> </a> </li>                        
      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i>Quejas Y Denuncias <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('quejas')}}"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Quejas Y Denuncias</b> </a> </li>                        
      </ul>
    </li>




    <li> <a href="javascript:void(0);"> <i class="fa fa-home"></i> ESCUELAS <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Centros de Trabajo</b> </a> </li>
        <li> <a href="{{url('ver_centros_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Informe de CTE</b> </a> </li>
        <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>
        <li> <a href="{{url('municipios')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Municipios</b> </a> </li>
        <li> <a href="{{url('localidades')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Localidades</b> </a> </li>
      </ul>
    </li>


    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-phone-alt"></i> DIRECTORIO <span class="plus"><i class="fa fa-plus"></i></span></a>
      <ul>
        <li> <a href="{{url('region')}}"> <span>&nbsp;</span> <i class="glyphicon glyphicon-phone-alt"></i> <b>Regiónes</b> </a> </li>
        <li> <a href="{{url('directorio_regional')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio Regional</b> </a> </li>
        <li> <a href="{{url('director_centro_trabajo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directores PETC</b> </a> </li>              
        <li> <a href="{{url('directorio_externo')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio SEDUZAC</b> </a> </li>
        <li> <a href="{{url('directorio_interno')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Directorio PETC</b> </a> </li>




      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-folder-open"></i> SOLICITUDES DE INGRESO <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('solicitudes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Solicitudes</b> </a> </li>
      </ul>
    </li>

    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-paperclip"></i>Oficios <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('oficiosrecibidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recibidos</b> </a> </li>
        <li> <a href="{{url('oficiosemitidos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Emitidos</b> </a> </li>
      </ul>
    </li>



    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-th"></i> Estadisticas <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('estadistica911')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Estadistica 911</b> </a> </li>
      </ul>
    </li>


    <li> <a href="javascript:void(0);"> <i class="glyphicon glyphicon-road"></i> Otros <span class="plus"><i class="fa fa-plus"></i></span> </a>
      <ul>
        <li> <a href="{{url('gmaps')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Mapas</b> </a> </li>  
        <li> <a href="{{url('calendario')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Eventos</b> </a> </li>            
      </ul>        
    </li>




  </ul>
</div>


@endif
@endif 
</div>
<!--\\\\\\\left_nav end \\\\\\-->
<div class="contentpanel">

  @yield('contenido')

  <div class="row col-md-6 col-md-offset-3"  style="height: 1000px;" >

  </div>

  <!--\\\\\\\ container  end \\\\\\-->
</div>



<!--\\\\\\\ content panel end \\\\\\-->
</div>
<!--\\\\\\\ inner end\\\\\\-->
</div>
{!!Html::script('js/jquery-2.1.0.js')!!}
{!!Html::script('js/script.js')!!}
{!!Html::script('js/moment.min.js')!!}
{!!Html::script('js/jquery-2.1.0.js')!!}
{!!Html::script('js/bootstrap.min.js')!!}
{!!Html::script('js/common-script.js')!!}
{!!Html::script('js/jquery.slimscroll.min.js')!!}
{!!Html::script('plugins/toggle-switch/toggles.min.js')!!} 
{!!Html::script('plugins/checkbox/zepto.js')!!}
{!!Html::script('plugins/checkbox/icheck.js')!!}
{!!Html::script('js/icheck-init.js')!!}
{!!Html::script('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')!!} 
{!!Html::script('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')!!} 
{!!Html::script('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')!!} 
{!!Html::script('plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')!!} 
{!!Html::script('js/form-components.js')!!} 
{!!Html::script('plugins/input-mask/jquery.inputmask.min.js')!!} 
{!!Html::script('plugins/input-mask/demo-mask.js')!!} 
{!!Html::script('plugins/bootstrap-fileupload/bootstrap-fileupload.min.js')!!} 
{!!Html::script('plugins/dropzone/dropzone.min.js')!!} 
{!!Html::script('plugins/ckeditor/ckeditor.js')!!}
{!!Html::script('js/jPushMenu.js')!!} 
{!!Html::script('plugins/validation/parsley.min.js')!!}
{!!Html::script('plugins/data-tables/jquery.dataTables.js')!!}
{!!Html::script('plugins/data-tables/DT_bootstrap.js')!!}
{!!Html::script('plugins/data-tables/dynamic_table_init.js')!!}
{!!Html::script('plugins/edit-table/edit-table.js')!!}
{!!Html::script('plugins/file-uploader/js/vendor/jquery.ui.widget.js')!!}
{!!Html::script('plugins/file-uploader/js/jquery.iframe-transport.js')!!}
{!!Html::script('plugins/file-uploader/js/jquery.fileupload.js')!!}
{!!Html::script('plugins/validation/parsley.min.js')!!}
{!!Html::script('plugins/select2/dist/js/select2.full.min.js')!!}
<!-- Include SmartWizard JavaScript source -->
{!!Html::script('plugins/wizard/js/jquery.smartWizard.js')!!}
<!-- Include jQuery Validator plugin -->
{!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js')!!}


{!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js')!!}
<script type="text/javascript">
 $(document).on('ready', function()  {

          //Initialize Select2 Elements
          $('.select2').select2()

        })
      </script>

    </body>

    </html>
