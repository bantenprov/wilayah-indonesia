<?php

Route::group(['prefix' => 'wilayah-indonesia'], function() {
//    Route::get('demo', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@demo');

	//ROUTE PROVINSI
    Route::get('/{provinsi}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsisearch');
    Route::get('/provinsi', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsiindex');
    Route::post('/provinsi/create', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsicreate');
    Route::get('/provinsi/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsishow');
    Route::post('/provinsi/{id}/edit', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsiedit');
    Route::post('/provinsi/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsidelete');
	//END ROUTE PROVINSI

	//ROUTE KABUPATEN
    Route::get('/kabupaten', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatenindex');
    Route::post('/kabupaten/create', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatencreate');
    Route::get('/kabupaten/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatenshow');
    Route::post('/kabupaten/{id}/edit', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatenedit');
    Route::post('/kabupaten/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatendelete');
	//END ROUTE KABUPATEN

	//ROUTE KECAMATAN
    Route::get('/kecamatan', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatanindex');
    Route::post('/kecamatan/create', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatancreate');
    Route::get('/kecamatan/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatanshow');
    Route::post('/kecamatan/{id}/edit', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatanedit');
    Route::post('/kecamatan/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatandelete');
	//END ROUTE KECAMATAN
	
	//ROUTE DESA
    Route::get('/desa', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desaindex');
    Route::post('/desa/create', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desacreate');
    Route::get('/desa/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desashow');
    Route::post('/desa/{id}/edit', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desaedit');
    Route::post('/desa/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desadelete');
	//END ROUTE DESA
});
