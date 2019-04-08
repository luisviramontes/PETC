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

//////////////////cat_puesto///////////////////////////////
Route::resource('cat_puesto', 'CatPuestoController');
Route::get('descargar-categoria-puesto', 'CatPuestoController@excel')->name('nomina.cat_puesto.excel');
Route::get('pdf_catpuesto/{id}', array('as'=> '/pdf_catpuesto','uses'=>'CatPuestoController@invoice'));
/////////////////////////////////////////////////////////////

///////////////////ciclo escolar///////////////////////////
Route::resource('ciclo_escolar', 'CicloEscolarController');
Route::get('descargar-ciclo-escolar', 'CicloEscolarController@excel')->name('nomina.ciclo_escolar.excel');
Route::get('pdf_cicloescolar/{id}', array('as'=> '/pdf_cicloescolar','uses'=>'CicloEscolarController@invoice'));
/////////////////////////////////////////////

//////////////////////Region///////////////////////7
Route::resource('region', 'RegionController');
Route::get('descargar-region', 'RegionController@excel')->name('nomina.region.excel');
Route::get('pdf_region/{id}', array('as'=> '/pdf_region','uses'=>'RegionController@invoice'));
///////////////////////////////////////////////////

Route::response('solicitudes','SolicitudesController');

Route::resource('bajas_contrato', 'BajasContratoController');

Route::resource('cambios_cct', 'CambiosCctController');

Route::resource('captura', 'CapturaController');

///CENTRO DE TRABAJO
Route::resource('centro_trabajo', 'CentroTrabajoController');
Route::get('descargar-centros-trabajo', 'CentroTrabajoController@excel')->name('nomina.centro_trabajo.excel');
Route::get('pdf_centros_trabajo', array('as'=> '/pdf_centros_trabajo','uses'=>'CentroTrabajoController@invoice'));
Route::get('verInformacion/{id}', array('as'=> '/verInformacion','uses'=>'CentroTrabajoController@verInformacion'));


Route::resource('datos_centro_trabajo', 'DatosCentroTrabajoController');
////////////directorio_regional////////////////////////////
Route::resource('directorio_regional', 'DirectorioRegionalController');
Route::get('descargar-directorio-regional', 'DirectorioRegionalController@excel')->name('nomina.directorio_regional.excel');
Route::get('pdf_directorioregional/{id}', array('as'=> '/pdf_directorioregional','uses'=>'DirectorioRegionalController@invoice'));



Route::resource('extencion_contrato', 'ExtencionContratoController');

Route::resource('fortalecimiento', 'FortalecimientoController');

Route::resource('inasistencias', 'InasistenciasController');

////////////listas de asisrencias////////////////

Route::resource('listas_asistencias', 'ListasAsistenciasController');
Route::get('descargar-listas-asistencias', 'ListasAsistenciasController@excel')->name('nomina.listas_asistencias.excel');
Route::get('pdf_listasasistencias/{id}', array('as'=> '/pdf_listasasistencias','uses'=>'ListasAsistenciasController@invoice'));


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


///MUNICIPIOS
Route::resource('municipios', 'MunicipiosController');
Route::get('descargar-tabla-municipios', 'MunicipiosController@excel')->name('nomina.region.municipios.excel');
Route::get('pdf_municipios', array('as'=> '/pdf_municipios','uses'=>'MunicipiosController@invoice'));


//LOCALIDADES
Route::resource('localidades', 'LocalidadesController');
Route::get('descargar-tabla-localidades', 'LocalidadesController@excel')->name('nomina.region.municipios.localidades.excel');
Route::get('pdf_localidades', array('as'=> '/pdf_localidades','uses'=>'LocalidadesController@invoice'));
Route::get('ver_localidades/{id}', array('as'=> '/ver_localidades','uses'=>'LocalidadesController@verInformacion'));
