<?php

Route::group(['prefix' => 'wilayah-indonesia'], function() {

	//ROUTE PROVINSI
    Route::get('/provinsi', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsiindex');
    Route::post('/provinsi', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsicreate');
    Route::get('/provinsi/option', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsioption');
    Route::post('/provinsi/delete', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsidelete');
    Route::post('/provinsi/{id}/edit', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsiedit');
    Route::get('/provinsi/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsishow');
    Route::get('/{provinsi}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@provinsisearch');
	//END ROUTE PROVINSI

	//ROUTE KABUPATEN
    Route::get('/kabupaten', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatenindex');
    Route::post('/kabupaten', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatencreate');
    Route::get('/kabupaten/option', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatenoption');
    Route::post('/kabupaten/delete', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatendelete');
    Route::post('/kabupaten/{id}/edit', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatenedit');
    Route::get('/kabupaten/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatenshow');
    Route::get('/{provinsi}/{kabupaten}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kabupatensearch');
	//END ROUTE KABUPATEN

	//ROUTE KECAMATAN
    Route::get('/kecamatan', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatanindex');
    Route::post('/kecamatan/create', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatancreate');
    Route::get('/kecamatan/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatanshow');
    Route::post('/kecamatan/{id}/edit', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatanedit');
    Route::post('/kecamatan/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatandelete');
    Route::get('/{provinsi}/{kabupaten}/{kecamatan}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@kecamatansearch');
	//END ROUTE KECAMATAN
	
	//ROUTE DESA
    Route::get('/desa', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desaindex');
    Route::post('/desa/create', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desacreate');
    Route::get('/desa/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desashow');
    Route::post('/desa/{id}/edit', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desaedit');
    Route::post('/desa/{id}', 'Bantenprov\WilayahIndonesia\Http\Controllers\WilayahIndonesiaController@desadelete');
	//END ROUTE DESA
});
