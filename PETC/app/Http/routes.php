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
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);


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
Route::get('pdf_reintegros/{id}', array('as'=> '/pdf_reintegros','uses'=>'ReintegrosController@invoice2'));
Route::get('traerpersonal/{cct}','ReintegrosController@traerpersonal');
Route::get('traerdire/{dire}','ReintegrosController@traerdire');
Route::get('cuenta/{nombre}','ReintegrosController@cuenta');
Route::get('banco/{banco}','ReintegrosController@banco');
Route::get('ver_reintegros', array('as'=> '/ver_reintegros','uses'=>'ReintegrosController@ver_reintegros'));
Route::get('pdf_reintegros/{id}', array('as'=> '/pdf_reintegros','uses'=>'ReintegrosController@invoice2'));
Route::get('busca_rein/{ciclo}','ReintegrosController@busca_rein');
Route::get('busca_rein_region/{region}/{ciclo}','ReintegrosController@busca_rein_region');
Route::get('descargar-reintegros/{ciclo}', 'ReintegrosController@excel')->name('nomina.reintegros.excel');

/////////////////////////////////////////////////////////////


//////////////////cat_puesto///////////////////////////////
Route::resource('cat_puesto', 'CatPuestoController');
Route::get('descargar-categoria-puesto', 'CatPuestoController@excel')->name('nomina.cat_puesto.excel');
Route::get('pdf_catpuesto/{id}', array('as'=> '/pdf_catpuesto','uses'=>'CatPuestoController@invoice'));
/////////////////////////////////////////////////////////////

//////////////////Cuentas///////////////////////////////
Route::resource('cuentas', 'CuentasController');
Route::get('descargar-cuentas', 'CuentasController@excel')->name('nomina.cuentas.excel');
Route::get('pdf_cuentas/{id}', array('as'=> '/pdf_cuentas','uses'=>'CuentasController@invoice'));
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
Route::get('ver_solicitudes', array('as'=> '/ver_solicitudes','uses'=>'SolicitudesController@ver_solicitudes'));
Route::get('busca_solis/{ciclo}','SolicitudesController@busca_solis');
Route::get('busca_solis_region/{region}/{ciclo}','SolicitudesController@busca_solis_region');
Route::get('descargar-solicitudes/{ciclo}', 'SolicitudesController@excel')->name('nomina.solicitudes.excel');
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
Route::get('ver_capturas', array('as'=> '/ver_capturas','uses'=>'CapturaController@ver_capturas'));
Route::get('busca_dias_captura/{ciclo}','CapturaController@busca_dias_captura');
Route::get('busca_dias_captura_region/{region}/{ciclo}','CapturaController@busca_dias_captura_region');
Route::get('traerescuelas/{esc}','CapturaController@traerescuelas');
Route::get('busca_captura_esc/{region}/{cct}','CapturaController@busca_captura_esc');
Route::get('pdf_captura1/{id}', array('as'=> '/pdf_captura1','uses'=>'CapturaController@invoice1'));
Route::get('descargar-listas-capturas/{ciclo}', 'CapturaController@excel2')->name('nomina.captura.excel2');
Route::get('traersos/{cct}','CapturaController@traersos');


//ALTAS FEDERALES
Route::resource('altasfed', 'AltasFedController');
Route::post('activaraltafed/{id}', 'AltasFedController@activar');
Route::get('descargar-altas-federales', 'AltasFedController@excel')->name('nomina.altas_federales.excel');

//ALTAS ESTATALES
Route::resource('altasest', 'AltasEstController');
Route::post('activaraltaest/{id}', 'AltasEstController@activar');
Route::get('descargar-altas-estatales', 'AltasEstController@excel')->name('nomina.altas_estatales.excel');

//BAJAS FEDERALES
Route::resource('bajasfed', 'BajasFedController');
Route::post('activarbajafed/{id}', 'BajasFedController@activar');
Route::get('descargar-bajas-federales', 'BajasFedController@excel')->name('nomina.bajas_federales.excel');

//BAJAS ESTATALES
Route::resource('bajasest', 'BajasEstController');
Route::post('activarbajaest/{id}', 'BajasEstController@activar');
Route::get('descargar-bajas-estatales', 'BajasEstController@excel')->name('nomina.bajas_estatales.excel');

//CAMBIOS DE CTE FEDERALES
Route::resource('cambios_cct_fed', 'CambiosFedController');
Route::post('activarcambiocct_fed/{id}', 'CambiosFedController@activar');
Route::get('descargar-cambioscct-federal', 'CambiosFedController@excel')->name('nomina.cambios_cct_fed.excel');


//CAMBIOS DE CTE ESTATALES
Route::resource('cambios_cct_est', 'CambiosEstController');
Route::post('activarcambiocct_est/{id}', 'CambiosEstController@activar');
Route::get('descargar-cambioscct-estatal', 'CambiosEstController@excel')->name('nomina.cambios_cct_est.excel');


//CAMBIOS DE FUNCION ESTATALES
Route::resource('cambios_funcion_est', 'CambiosFunEstController');
Route::post('activarcambiofuncion_est/{id}', 'CambiosFunEstController@activar');
Route::get('descargar-cfuncion-estatal', 'CambiosFunEstController@excel')->name('nomina.cambios_festatal.excel');

//CAMBIOS DE FUNCION FEDERAL
Route::resource('cambios_funcion_fed', 'CambiosFunFedController');
Route::post('activarcambiofuncion_fed/{id}', 'CambiosFunFedController@activar');
Route::get('descargar-cfuncion-federal', 'CambiosFunFedController@excel')->name('nomina.cambios_ffederal.excel');


//INTERINOS FEDERALES
Route::resource('interinosfed', 'InterinosFedController');
Route::post('activar_interinosfed/{id}', 'InterinosFedController@activar');
Route::get('descargar-interinos-fed', 'InterinosFedController@excel')->name('nomina.interinos-fed.excel');

//INTERINOS ESTATALES
Route::resource('interinosest', 'InterinosEstController');
Route::post('activar_interinosest/{id}', 'InterinosEstController@activar');
Route::get('descargar-interinos-est', 'InterinosEstController@excel')->name('nomina.interinos-est.excel');


//INASISTENCIAS
Route::resource('inasistencias', 'InasistenciasController');
Route::get('inasistencias2/{id}', 'InasistenciasController@index');
Route::post('eliminar_lista/{id}', 'InasistenciasController@inactivar');
Route::get('validar_lista/{cct}/{mes}/{ciclo}', 'InasistenciasController@validarLista');
Route::get('busca_personal/{cct}', 'InasistenciasController@BuscaPersonal');
Route::get('busca_personal2/{cct}', 'InasistenciasController@BuscaPersonal2');
Route::get('busca_dias/{mes}/{ciclo}', 'InasistenciasController@BuscaDias');
Route::get('ver_inasistencias/{id}/{ciclo}', array('as'=> '/ver_inasistencias','uses'=>'InasistenciasController@verInformacion'));
Route::get('pdf_inasistencias/{id}/{ciclo}', array('as'=> '/pdf_inasistencias','uses'=>'InasistenciasController@invoice'));
Route::get('descargar-inasistencias/{ciclo}', 'InasistenciasController@excel')->name('nomina.inasistencias.excel');
Route::get('ver_inasistencias_personal/{id}/{ciclo}', array('as'=> '/ver_inasistencias_personal','uses'=>'InasistenciasController@excel2'));
Route::get('ver_inasistencias_ct/{id}/{ciclo}', array('as'=> '/ver_inasistencias_ct','uses'=>'InasistenciasController@excel3'));
Route::get('busca_inasistencias/{id_cct}/{ciclo}/{mes}', 'InasistenciasController@BuscaInasistencias');

Route::get('genera_listas', 'InasistenciasController@generar_listas');
Route::get('busca_escuelas_region/{region}', 'InasistenciasController@busca_escuelas_region');
Route::post('generar_pdf_listas/','InasistenciasController@generar_pdf_listas')->name('nomina.inasistencias.generar_pdf_listas');

Route::get('extender_contrato/{id}', 'CapturaController@extender_contrato');
Route::post('guardar_contrato/{id}', 'CapturaController@guardar_contrato')->name('nomina.captura.guardar_contrato');



///CENTRO DE TRABAJO
Route::resource('centro_trabajo', 'CentroTrabajoController');
Route::get('descargar-centros-trabajo', 'CentroTrabajoController@excel')->name('nomina.centro_trabajo.excel');
Route::get('pdf_centros_trabajo', array('as'=> '/pdf_centros_trabajo','uses'=>'CentroTrabajoController@invoice'));
Route::get('verInformacionCentro/{id}/{ciclo}', array('as'=> '/verInformacionCentro','uses'=>'CentroTrabajoController@verInformacion'));
Route::get('pdf_centro_cct/{cct}/{ciclo}', array('as'=> '/pdf_centro_cct','uses'=>'CentroTrabajoController@invoice_centro_cct'));
Route::get('pdf_plantilla_personal/{cct}/{ciclo}', array('as'=> '/pdf_plantilla_personal','uses'=>'CentroTrabajoController@invoice_plantilla'));
Route::get('ver_centros_trabajo', array('as'=> '/ver_centros_trabajo','uses'=>'CentroTrabajoController@ver_centros_trabajo'));
Route::get('ver_opciones/{id}/', array('as'=> '/ver_opciones','uses'=>'CentroTrabajoController@option'));
Route::get('ver_centros_filtro/{op}/{id}', array('as'=> '/ver_centros_filtro','uses'=>'CentroTrabajoController@ver_centros_filtro'));

//DIRECTOR->CENTRO DE TRABAJO
Route::resource('director_centro_trabajo', 'DirectorCentroController');
Route::get('pdf_directores/', array('as'=> '/pdf_directores','uses'=>'DirectorCentroController@invoice'));
Route::get('descargar-directores-cte', 'DirectorCentroController@excel')->name('nomina.directores-cte.excel');



Route::resource('datos_centro_trabajo', 'DatosCentroTrabajoController');
////////////directorio_regional////////////////////////////
Route::resource('directorio_regional', 'DirectorioRegionalController');
Route::get('descargar-directorio-regional', 'DirectorioRegionalController@excel')->name('nomina.directorio_regional.excel');
Route::get('pdf_directorioregional/{id}', array('as'=> '/pdf_directorioregional','uses'=>'DirectorioRegionalController@invoice'));
///////////////////////////////////////////////////////////////////////////////


Route::resource('extencion_contrato', 'ExtencionContratoController');

///////////////////////Fortalecimiento///////////////////////////7
Route::resource('fortalecimiento', 'FortalecimientoController');
Route::post('subirforta', 'FortalecimientoController@subir');
Route::get('ver_fortalecimiento', array('as'=> '/ver_capturas','uses'=>'FortalecimientoController@ver_fortalecimiento'));
Route::get('busca_forta/{ciclo}','FortalecimientoController@busca_forta');
Route::get('busca_forta_region/{region}/{ciclo}','FortalecimientoController@busca_forta_region');
Route::get('descargar-fortalecimiento/{ciclo}', 'FortalecimientoController@excel')->name('nomina.fortalecimiento.excel');
Route::get('pdf_fortalecimiento/{id}', array('as'=> '/pdf_fortalecimiento','uses'=>'FortalecimientoController@invoice'));
////////////////////////////////////////////////////////////////////7

///////TARJETAS DE FORTALECIMIENTO
Route::resource('tarjetas_fortalecimiento', 'TarjetasFortalecimientoController');
Route::get('descargar-tarjetas_fortalecimiento/{id}', 'TarjetasFortalecimientoController@excel')->name('nomina.tarjetas_fortalecimiento.excel');
Route::get('pdf-tarjetas_fortalecimiento/{id}', array('as'=> '/pdf-tarjetas_fortalecimiento','uses'=>'TarjetasFortalecimientoController@invoice'));
Route::get('traer_escuelasforta/{ciclo}','TarjetasFortalecimientoController@traer_escuelasforta');
Route::get('traer_montos_forta/{cct}','TarjetasFortalecimientoController@traer_montos_forta');
Route::get('generar_cartas', 'TarjetasFortalecimientoController@generar_cartas');
Route::post('generar_pdf_cartas/','TarjetasFortalecimientoController@generar_pdf_cartas')->name('nomina.tarjetas_fortalecimiento.generar_pdf_cartas');



Route::resource('/tarjetas_forta','TarjetasFortalecimientoController@tarjetas_forta');
Route::resource('/importar_cartas','TarjetasFortalecimientoController@importar_cartas');
Route::resource('detalle_tarjetas', 'TarjetasFortalecimientoController@detalle_tarjetas');
//////


////////////listas de asisrencias////////////////

Route::resource('listas_asistencias', 'ListasAsistenciasController');
Route::get('descargar-listas-asistencias', 'ListasAsistenciasController@excel')->name('nomina.listas_asistencias.excel');
Route::get('pdf_listasasistencias/{id}', array('as'=> '/pdf_listasasistencias','uses'=>'ListasAsistenciasController@invoice'));
Route::get('ver_listas', array('as'=> '/ver_listas','uses'=>'ListasAsistenciasController@ver_listas'));
Route::get('busca_listas/{ciclo}','ListasAsistenciasController@busca_listas');
Route::get('busca_listas_region/{ciclo}/{region}','ListasAsistenciasController@busca_listas_region');
Route::get('busca_listas_mes/{ciclo}/{region}/{mes}','ListasAsistenciasController@busca_listas_mes');
Route::get('descargar-listas-ciclo/{id}', 'ListasAsistenciasController@excel2')->name('nomina.reclamos.excel2');
Route::get('escuelas/{esc}','ListasAsistenciasController@escuelas');
Route::get('busca_listas_esc/{region}/{cct}','ListasAsistenciasController@busca_listas_esc');
Route::get('recepcion_listas','ListasAsistenciasController@recepcion_listas');
Route::get('busca_listas_codigo/{codigo}/{mes}/{ciclo}','ListasAsistenciasController@busca_listas_codigo');
Route::post('listas_codigo','ListasAsistenciasController@listas_codigo');





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
Route::get('buscar_qnas_pagos/{ciclo}/','NominaCapturadaController@buscar_qnas_pagos');
Route::get('ver_captura_qna/{qna}', array('as'=> '/ver_captura_qna','uses'=>'NominaCapturadaController@ver_captura_qna'));
Route::get('pdf_reporte_qna/{qna}', array('as'=> '/pdf_reporte_qna','uses'=>'NominaCapturadaController@invoice2'));
Route::get('descargar_reporte_qna/{qna}', 'NominaCapturadaController@excel2')->name('nomina.descargar_reporte_qna.excel2');


////////////////////////////////////////////////////////////////

////////////////Nomina Federañ//////////////////////////7
Route::resource('nomina_federal', 'NominaFederalController');
Route::post('importExcel', 'NominaFederalController@importExcel');
Route::get('pdf_bancos/{id}', array('as'=> '/pdf_bancos','uses'=>'BancosController@invoice'));
////////////////////////////////////////////////////////////////

////CUADROS CIFRAS///////////
Route::resource('cuadros_cifras', 'CuadroCifrasController');
Route::get('descargar-cuadros-cifras/{id}', 'CuadroCifrasController@excel')->name('nomina.cuadros-cifras.excel');
Route::get('pdf-cuadros-cifras/{id}', array('as'=> '/pdf-cuadros-cifras','uses'=>'CuadroCifrasController@invoice'));


//PAGOS IMPROCEDENTES
Route::resource('pagos_improcedentes', 'PagosImprocedentesController');
Route::get('descargar-pagos-improcedentes/{id}', 'PagosImprocedentesController@excel')->name('nomina.pagos-improcedentes.excel');
Route::get('pdf-pagos-improcedentes/{id}', array('as'=> '/pdf-pagos-improcedentes','uses'=>'PagosImprocedentesController@invoice'));
Route::post('activarpagos_improcedentes/{id}', 'PagosImprocedentesController@activar');


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


//RECLAMOS

Route::resource('reclamos', 'ReclamosController');
Route::get('reclamos2/{id}', 'ReclamosController@index');
Route::get('valida_reclamos/{dia}/{mes}/{year}/','ReclamosController@valida_reclamos');
Route::get('calcular_reclamo/{dias}/{categoria}/{ciclo}','ReclamosController@calcular_reclamo');
Route::get('buscar_qnas/{ciclo}', 'ReclamosController@buscar_qnas');
Route::get('descargar-reclamos/{id}', 'ReclamosController@excel')->name('nomina.reclamos.excel');
Route::post('activar_reclamo/{id}', 'ReclamosController@activar');
Route::get('ver_reclamos', array('as'=> '/ver_reclamos','uses'=>'ReclamosController@ver_reclamos'));
Route::get('busca_dias_reclamo/{ciclo}','ReclamosController@busca_dias_reclamo');
Route::get('busca_dias_reclamo_region/{region}/{ciclo}','ReclamosController@busca_dias_reclamo_region');
Route::get('pdf_reclamos/{ciclo}', array('as'=> '/pdf_reclamos','uses'=>'ReclamosController@invoice'));
Route::get('descargar-capturas/{id}', 'CapturaController@excel')->name('nomina.reclamos.excel');
Route::get('busca_captura_ciclo/{ciclo}','CapturaController@busca_captura_ciclo');


//DIRECTORIO EXTERNO
Route::resource('directorio_externo', 'DirectorioExternoController');
Route::get('descargar-directorio-externo', 'DirectorioExternoController@excel')->name('nomina.directorio_externo.excel');
Route::get('pdf_directorio_externo', array('as'=> '/pdf_directorio_externo','uses'=>'DirectorioExternoController@invoice'));

//DIRECTORIO INTERNO
Route::resource('directorio_interno', 'DirectorioInternoController');
Route::get('descargar-directorio-interno', 'DirectorioInternoController@excel')->name('nomina.directorio_interno.excel');
Route::get('pdf_directorio_externo', array('as'=> '/pdf_directorio_externo','uses'=>'DirectorioInternoController@invoice'));




//OFICIOS EMITIDOS

Route::resource('oficiosemitidos', 'OficiosEmitidosController');
Route::get('descargar-oficios-emitidos/{id}', 'OficiosEmitidosController@excel')->name('administrativa.oficios-emitidos.excel');
Route::get('descargar-oficios-emitidos-area/{id}/{area}', 'OficiosEmitidosController@excel2')->name('administrativa.oficios-emitidos-area.excel');
Route::post('oficioemitido_resuelto/{id}', 'OficiosEmitidosController@oficioemitido_resuelto');
Route::get('buscar_oficio/{oficio}/{ciclo}', 'OficiosEmitidosController@buscar_oficio');
Route::get('busca_oficio/{oficio}/{ciclo}', 'OficiosEmitidosController@busca_oficio');
Route::get('buscar_oficio2/{oficio}/{ciclo}', 'OficiosEmitidosController@buscar_oficio2');
Route::get('ultimo_oficio/{id}', 'OficiosEmitidosController@ultimo_oficio');
Route::get('buscar_oficio3/{oficio}/{id}', 'OficiosEmitidosController@buscar_oficio3');
Route::get('ver_oficios_e', array('as'=> '/ver_oficios_e','uses'=>'OficiosEmitidosController@ver_oficios_e'));
Route::get('ver_oficios_ciclo/{ciclo}/','OficiosEmitidosController@ver_oficios_ciclo'); 
Route::get('ver_oficios_area/{ciclo}/{area}','OficiosEmitidosController@ver_oficios_area');
Route::get('ver_oficios_persona/','OficiosEmitidosController@ver_oficios_persona');
Route::get('ver_oficios_personar/','OficiosEmitidosController@ver_oficios_personar');
Route::post('subir_imagen_oficioe/{id}', 'OficiosEmitidosController@subir_imagen_oficioe');

//OFICIOS RECIBIDOS

Route::resource('oficiosrecibidos', 'OficiosRecibidosController');
Route::get('descargar-oficios-recibidos/{id}', 'OficiosRecibidosController@excel')->name('administrativa.oficios-recibidos.excel');
Route::get('descargar-oficios-recibidos-area/{id}/{area}', 'OficiosRecibidosController@excel2')->name('administrativa.oficios-recibidos-area.excel');
Route::post('oficiorecibido_resuelto/{id}', 'OficiosRecibidosController@oficiorecibido_resuelto');
Route::get('buscar_oficio_r/{oficio}/{ciclo}', 'OficiosRecibidosController@buscar_oficio');
Route::get('ultimo_oficior/{id}', 'OficiosRecibidosController@ultimo_oficio');
Route::get('buscar_oficior3/{oficio}/{id}', 'OficiosRecibidosController@buscar_oficio3');
Route::get('ver_oficios_r', array('as'=> '/ver_oficios_e','uses'=>'OficiosRecibidosController@ver_oficios_r'));
Route::get('ver_oficiosr_ciclo/{ciclo}/','OficiosRecibidosController@ver_oficios_ciclo');
Route::get('ver_oficios_arear/{ciclo}/{area}','OficiosRecibidosController@ver_oficios_area');
Route::post('subir_imagen_oficior/{id}', 'OficiosRecibidosController@subir_imagen_oficioe');


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


//PLAN CONTRASTE
Route::resource('plan_contraste', 'PlanContasteController');
Route::get('descargar-plan_contraste/{ciclo}', 'PlanContasteController@excel')->name('nomina.plan_contraste.excel');
Route::get('pdf-plan_contraste/{ciclo}', array('as'=> '/pdf-plan_contraste','uses'=>'PlanContasteController@invoice'));
Route::get('ver_plan_c_n/{ciclo}', array('as'=> '/ver_plan_c_n','uses'=>'PlanContasteController@ver_plan'));
Route::get('ver_plan_region/{ciclo}/{region}', array('as'=> '/ver_plan_region','uses'=>'PlanContasteController@ver_plan_region'));

//CALCULO DE NOMINAS
Route::resource('calculo_nomina', 'NominaCapturadaController@calculo_nomina');
Route::get('buscar_qnas_activas/{ciclo}', 'NominaCapturadaController@buscar_qnas');
Route::get('montos_qnas/{qna}', 'NominaCapturadaController@montos_qnas');
Route::get('montos_qnas_region/{qna}/{region}/{ciclo}', 'NominaCapturadaController@montos_qnas_region');

//ESTADISTICA 911
Route::resource('estadistica911', 'Estadistica911Controller');
Route::get('descargar-estadistica911/{ciclo}', 'Estadistica911Controller@excel')->name('nomina.descargar-estadistica911.excel');
Route::get('verifica_ciclo/{ciclo}', 'Estadistica911Controller@verifica');

//MAPAS
Route::get('gmaps', ['as'=>'gmaps','uses' => 'GmapsController@index']);
