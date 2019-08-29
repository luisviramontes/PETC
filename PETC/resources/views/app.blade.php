<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>TIEMPO COMPLETO</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    {!!Html::style('css/font-awesome.css')!!}
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/animate.css')!!}
    {!!Html::style('css/admin.css')!!}
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
    {!!Html::style('href="plugins/file-uploader/css/blueimp-gallery.min.css')!!}
    {!!Html::style('href="plugins/file-uploader/css/jquery.fileupload.css')!!}
    {!!Html::style('href="plugins/file-uploader/css/jquery.fileupload-ui.css')!!}
    {!!Html::style('type="text/css" href="plugins/bootstrap-datepicker/css/datepicker.css')!!}
    {!!Html::style('type="text/css" href="plugins/bootstrap-timepicker/compiled/timepicker.css')!!}
    {!!Html::style('type="text/css" href="plugins/bootstrap-colorpicker/css/colorpicker.css')!!}
    {!!Html::style('href="plugins/select2/dist/css/select2.css')!!}

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
    body {
      background-color: #464646;
      background-image: url(img/jkhggh.png);
      background-position: center center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ETC</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            <li><a href="/captura">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="{{route('auth/login')}}">Login</a></li>
            <li><a href="{{route('auth/register')}}">Register</a></li>
            @else
                    <li>
                        <a href="#">{{ Auth::user()->name }}</a>
                    </li>
                    <li><a href="{{route('auth/logout')}}">Logout</a></li>
                    
              @endif
        </ul>
      </div>
    </div>
  </nav>
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
    @yield('contenido')
    <!-- Scripts -->
    {!! Html::script('assets/js/bootstrap.min.js') !!}
          {!!Html::script('js/jquery-2.1.0.js')!!}
      {!!Html::script('js/bootstrap.min.js')!!}
      {!!Html::script('js/common-script.js')!!}
      {!!Html::script('js/jquery.slimscroll.min.js')!!}
      {!!Html::script('js/jquery.sparkline.js')!!}
      {!!Html::script('js/sparkline-chart.js')!!}
      {!!Html::script('js/graph.js')!!}
      {!!Html::script('js/edit-graph.js')!!}
      {!!Html::script('plugins/kalendar/kalendar.js" type="text/javascript')!!}
      {!!Html::script('plugins/kalendar/edit-kalendar.js" type="text/javascript')!!}

      {!!Html::script('plugins/sparkline/jquery.sparkline.js" type="text/javascript')!!}
      {!!Html::script('plugins/sparkline/jquery.customSelect.min.js')!!}
      {!!Html::script('plugins/sparkline/sparkline-chart.js')!!}
      {!!Html::script('plugins/sparkline/easy-pie-chart.js')!!}
      {!!Html::script('plugins/morris/morris.min.js" type="text/javascript')!!}
      {!!Html::script('plugins/morris/raphael-min.js" type="text/javascript')!!}
      {!!Html::script('plugins/morris/morris-script.js')!!}
      {!!Html::script('plugins/demo-slider/demo-slider.js')!!}
      {!!Html::script('plugins/knob/jquery.knob.min.js')!!}




      {!!Html::script('js/jPushMenu.js')!!}
      {!!Html::script('js/side-chats.js')!!}
      {!!Html::script('js/jquery.slimscroll.min.js')!!}
      {!!Html::script('plugins/scroll/jquery.nanoscroller.js')!!}
</body>
</html>