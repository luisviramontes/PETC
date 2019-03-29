<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
 

Route::resource('cat_puesto', 'CatPuestoController');

Route::resource('cat_puesto', 'CatPuestoController');


Route::resource('bajas_contrato', 'BajasContratoController');

Route::resource('cambios_cct', 'CambiosCctController');

Route::resource('captura', 'CapturaController');

///CENTRO DE TRABAJO
Route::resource('centro_trabajo', 'CentroTrabajoController');
Route::get('descargar-centros-trabajo', 'CentroTrabajoController@excel')->name('nomina.centro_trabajo.excel');

Route::resource('datos_centro_trabajo', 'DatosCentroTrabajoController');

Route::resource('directorio_regional', 'DirectorioRegionalController');

Route::resource('extencion_contrato', 'ExtencionContratoController');

Route::resource('fortalecimiento', 'FortalecimientoController');

Route::resource('inasistencias', 'InasistenciasController');

Route::resource('listas_asistencias', 'ListasAsistenciasController');

Route::resource('nomina_estatal', 'NominaEstatalController');

Route::resource('nomina_federal', 'NominaFederalController');

Route::resource('personal', 'PersonalController');

Route::resource('reclamos', 'ReclamosController');

Route::resource('reintegros', 'ReintegrosController');

///TABLA DE PAGOS
Route::resource('tabla_pagos', 'TablaPagosController');
Route::get('descargar-tabla-pagos', 'TablaPagosController@excel')->name('nomina.tabla_pagos.excel');
Route::get('pdf_tablapagos/{id}', array('as'=> '/pdf_tablapagos','uses'=>'TablaPagosController@invoice'));

//TABULADOR DE PAGOS
Route::resource('tabulador_pagos', 'TabuladorPagosController');
Route::get('descargar-tabla-empleado', 'TabuladorPagosController@excel')->name('nomina.tabulador_pagos.excel');
Route::get('tablaempleado/{id}', array('as'=> '/pdf_tablaempleado','uses'=>'TabuladorPagosController@invoice'));
Route::get('calculadora_pagos', 'TabuladorPagosController@calculadora')->name('nomina.tabulador_pagos.calculadora_pagos');