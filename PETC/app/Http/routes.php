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

//////////////////contatc///////////////////////////////
Route::get('contact', function () {
	return view('contact');
});
/////////////////////////////////////////////////////////////

//////////////////contatc///////////////////////////////
Route::get('about', function () {
	return view('about');
});
/////////////////////////////////////////////////////////////

//////////////////contatc///////////////////////////////
Route::get('services', function () {
	return view('services');
});
/////////////////////////////////////////////////////////////


//////////////////reintegros///////////////////////////////
Route::resource('reintegros', 'ReintegrosController');
Route::get('descargar-categoria-puesto', 'CatPuestoController@excel')->name('nomina.cat_puesto.excel');
Route::get('pdf_catpuesto/{id}', array('as'=> '/pdf_catpuesto','uses'=>'CatPuestoController@invoice'));
/////////////////////////////////////////////////////////////


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

//////////////////////RchazosCAP///////////////////////7
Route::resource('cap_rechazo', 'RechazoCapController');
Route::get('descargar-rechazocap', 'RechazoCapController@excel')->name('nomina.cap_rechazo.excel');
Route::get('pdf_cap_rechazo/{id}', array('as'=> '/pdf_region','uses'=>'RechazoCapController@invoice'));
Route::get('validar_quincena/{qna}/{sostenimiento}/{tipo}','RechazoCapController@validar_quincena');
Route::get('validar_quincenaExis/{qna}/{sostenimiento}/{tipo}','RechazoCapController@validar_quincenaExis');
///////////////////////////////////////////////////

//////////////////////RchazosFED///////////////////////7
Route::resource('rechazos_fed', 'RechazosFederalController');
Route::get('descargar-rechazos_fed', 'RechazosFederalController@excel')->name('nomina.rechazos_fed.excel');
Route::get('pdf_rechazosfed/{id}', array('as'=> '/pdf_rechazosfed','uses'=>'RechazosFederalController@invoice'));
///////////////////////////////////////////////////


//////////////////////RchazosEst///////////////////////7
Route::resource('rechazos_est', 'RechazosEstController');
Route::get('descargar-rechazosest', 'RechazosEstController@excel')->name('nomina.rechazosest.excel');
Route::get('pdf_rechazoest/{id}', array('as'=> '/pdf_rechazoest','uses'=>'RechazosEstController@invoice'));
///////////////////////////////////////////////////

///////////////////Solicitudes/////////////////////////////7
Route::resource('solicitudes','SolicitudesController');
Route::get('descargar-solicitudes', 'SolicitudesController@excel')->name('nomina.solicitudes.excel');
Route::get('pdf_solicitudes/{id}', array('as'=> '/pdf_solicitudes','uses'=>'SolicitudesController@invoice'));
//////////////////////////////////////////////////////////////

Route::resource('bajas_contrato', 'BajasContratoController');
Route::resource('cambios_cct', 'CambiosCctController');

//CAPTURA PERSONAL
Route::resource('captura', 'CapturaController');
Route::get('descargar-tabla-captura', 'CapturaController@excel')->name('nomina.captura.excel');
Route::get('ver_datoscaptura/{id}/{ciclo}', array('as'=> '/ver_datoscaptura','uses'=>'CapturaController@verInformacion'));
Route::get('validarcaptura/{cct}/{puesto}', 'CapturaController@validarCaptura');
Route::post('activarrfc', 'CapturaController@activar');
Route::get('validarnuevor/{cct}/{puesto}', 'CapturaController@validarNuevo');
Route::get('validarpersonal/{rfc}', 'CapturaController@validarRFC');
Route::get('extender_contrato/{id}', 'CapturaController@extender_contrato');
Route::post('guardar_contrato/{id}', 'CapturaController@guardar_contrato')->name('nomina.captura.guardar_contrato');
Route::get('pdf_captura/{id}/{ciclo}', array('as'=> '/pdf_captura','uses'=>'CapturaController@invoice'));




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
///////////////////////////////////////////////////////////////////////////////


Route::resource('extencion_contrato', 'ExtencionContratoController');

///////////////////////Fortalecimiento///////////////////////////7
Route::resource('fortalecimiento', 'FortalecimientoController');
Route::get('descargar-fortalecimiento', 'FortalecimientoController@excel')->name('nomina.fortalecimiento.excel');
Route::get('pdf_fortalecimiento/{id}', array('as'=> '/pdf_fortalecimiento','uses'=>'FortalecimientoController@invoice'));
////////////////////////////////////////////////////////////////////7
Route::resource('inasistencias', 'InasistenciasController');

////////////listas de asisrencias////////////////

Route::resource('listas_asistencias', 'ListasAsistenciasController');
Route::get('descargar-listas-asistencias', 'ListasAsistenciasController@excel')->name('nomina.listas_asistencias.excel');
Route::get('pdf_listasasistencias/{id}', array('as'=> '/pdf_listasasistencias','uses'=>'ListasAsistenciasController@invoice'));

//////////////////nomina estatal////////////////////////////////
Route::resource('nomina_estatal', 'NominaEstatalController');
Route::post('importExcel', 'NominaEstatalController@importExcel');
////////////////////////////////////////////////////////////////

//////////////////nomina Capturada E////////////////////////////////
Route::resource('nomina_capturada', 'NominaCapturadaController');
Route::get('descargar-nominas-capturadas', 'NominaCapturadaController@excel')->name('nomina.nomina_capturada.excel');
Route::get('pdf_nomina_capturada/{id}', array('as'=> '/pdf_nomina_capturada','uses'=>'NominaCapturadaController@invoice'));
Route::get('validar_nomina/{qna}/{sostenimiento}/{tipo}','NominaCapturadaController@validar_nomina');
Route::get('validar_quincenaIna/{qna}/{sostenimiento}/{tipo}','NominaCapturadaController@validar_quincenaIna');

////////////////////////////////////////////////////////////////

////////////////Nomina Federañ//////////////////////////7
Route::resource('nomina_federal', 'NominaFederalController');
Route::post('importExcel', 'NominaFederalController@importExcel');
Route::get('pdf_bancos/{id}', array('as'=> '/pdf_bancos','uses'=>'BancosController@invoice'));
////////////////////////////////////////////////////////////////

////////////BANCOS////////////////////////////////////////////////7
Route::resource('bancos', 'BancosController');
Route::get('descargar-bancos', 'BancosController@excel')->name('nomina.bancos.excel');
///////////////////////////////////////////////////////////////////

///PERSONAL
Route::resource('personal', 'PersonalController');
Route::get('descargar-tabla-personal', 'PersonalController@excel')->name('nomina.personal.excel');
Route::get('ver_datospersonal/{id}', array('as'=> '/ver_datospersonal','uses'=>'PersonalController@verInformacion'));
//Route::post('activarrfc', 'PersonalController@activar');
//Route::get('pdf_tablapagos/{id}', array('as'=> '/pdf_tablapagos','uses'=>'TablaPagosController@invoice'));


Route::resource('reclamos', 'ReclamosController');



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
