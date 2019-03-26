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

<<<<<<< HEAD
Route::resource('cat_puesto', 'CatPuestoController'); //
=======
Route::resource('cat_puesto', 'CatPuestoController');
>>>>>>> a82156159f9f8d4e90dadd1c34cc2002a0c63c52

Route::resource('bajas_contrato', 'BajasContratoController');//

Route::resource('cambios_cct', 'CambiosCctController');//

Route::resource('captura', 'CapturaController');//

Route::resource('centro_trabajo', 'CentroTrabajoController');//

Route::resource('datos_centro_trabajo', 'DatosCentroTrabajoController');//

Route::resource('directorio_regional', 'DirectorioRegionalController');//

Route::resource('extencion_contrato', 'ExtencionContratoController');//

Route::resource('fortalecimiento', 'FortalecimientoController');//

Route::resource('inasistencias', 'InasistenciasController');//

Route::resource('listas_asistencias', 'ListasAsistenciasController');

Route::resource('nomina_estatal', 'NominaEstatalController');

Route::resource('nomina_federal', 'NominaFederalController');

Route::resource('personal', 'PersonalController');

Route::resource('reclamos', 'ReclamosController');

Route::resource('reintegros', 'ReintegrosController');

Route::resource('tabla_pagos', 'TablaPagosController');
