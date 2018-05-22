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

Route::group(['prefix' => 'api/wilayah-indonesia/province', 'middleware' => ['auth', 'role:superadministrator|admin_sekolah']], function() {
    $class          = 'Bantenprov\WilayahIndonesia\Http\Controllers\ProvinceController';
    $name           = 'wilayah-indonesia.province';
    $controllers    = (object) [
        'index'     => $class.'@index',
        'get'       => $class.'@get',
        'create'    => $class.'@create',
        'show'      => $class.'@show',
        'store'     => $class.'@store',
        'edit'      => $class.'@edit',
        'update'    => $class.'@update',
        'destroy'   => $class.'@destroy',
    ];

    Route::get('/',             $controllers->index)->name($name.'.index')->middleware(['role:superadministrator']);
    Route::get('/get',          $controllers->get)->name($name.'.get')->middleware(['role:superadministrator|admin_sekolah']);
    Route::get('/create',       $controllers->create)->name($name.'.create')->middleware(['role:superadministrator']);
    Route::get('/{id}',         $controllers->show)->name($name.'.show')->middleware(['role:superadministrator']);
    Route::post('/',            $controllers->store)->name($name.'.store')->middleware(['role:superadministrator']);
    Route::get('/{id}/edit',    $controllers->edit)->name($name.'.edit')->middleware(['role:superadministrator']);
    Route::put('/{id}',         $controllers->update)->name($name.'.update')->middleware(['role:superadministrator']);
    Route::delete('/{id}',      $controllers->destroy)->name($name.'.destroy')->middleware(['role:superadministrator']);
});

Route::group(['prefix' => 'api/wilayah-indonesia/city', 'middleware' => ['auth', 'role:superadministrator|admin_sekolah']], function() {
    $class          = 'Bantenprov\WilayahIndonesia\Http\Controllers\CityController';
    $name           = 'wilayah-indonesia.city';
    $controllers    = (object) [
        'index'         => $class.'@index',
        'get'           => $class.'@get',
        'getByProvince' => $class.'@getByProvince',
        'create'        => $class.'@create',
        'show'          => $class.'@show',
        'store'         => $class.'@store',
        'edit'          => $class.'@edit',
        'update'        => $class.'@update',
        'destroy'       => $class.'@destroy',
    ];

    Route::get('/',                     $controllers->index)->name($name.'.index')->middleware(['role:superadministrator']);
    Route::get('/get',                  $controllers->get)->name($name.'.get')->middleware(['role:superadministrator']);
    Route::get('/get/by-province/{id}', $controllers->getByProvince)->name($name.'.get-by-province')->middleware(['role:superadministrator|admin_sekolah']);
    Route::get('/create',               $controllers->create)->name($name.'.create')->middleware(['role:superadministrator']);
    Route::get('/{id}',                 $controllers->show)->name($name.'.show')->middleware(['role:superadministrator']);
    Route::post('/',                    $controllers->store)->name($name.'.store')->middleware(['role:superadministrator']);
    Route::get('/{id}/edit',            $controllers->edit)->name($name.'.edit')->middleware(['role:superadministrator']);
    Route::put('/{id}',                 $controllers->update)->name($name.'.update')->middleware(['role:superadministrator']);
    Route::delete('/{id}',              $controllers->destroy)->name($name.'.destroy')->middleware(['role:superadministrator']);
});

Route::group(['prefix' => 'api/wilayah-indonesia/district', 'middleware' => ['auth', 'role:superadministrator|admin_sekolah']], function() {
    $class          = 'Bantenprov\WilayahIndonesia\Http\Controllers\DistrictController';
    $name           = 'wilayah-indonesia.district';
    $controllers    = (object) [
        'index'     => $class.'@index',
        'get'       => $class.'@get',
        'getByCity' => $class.'@getByCity',
        'create'    => $class.'@create',
        'show'      => $class.'@show',
        'store'     => $class.'@store',
        'edit'      => $class.'@edit',
        'update'    => $class.'@update',
        'destroy'   => $class.'@destroy',
    ];

    Route::get('/',                 $controllers->index)->name($name.'.index')->middleware(['role:superadministrator']);
    Route::get('/get',              $controllers->get)->name($name.'.get')->middleware(['role:superadministrator']);
    Route::get('/get/by-city/{id}', $controllers->getByCity)->name($name.'.get-by-city')->middleware(['role:superadministrator|admin_sekolah']);
    Route::get('/create',           $controllers->create)->name($name.'.create')->middleware(['role:superadministrator']);
    Route::get('/{id}',             $controllers->show)->name($name.'.show')->middleware(['role:superadministrator']);
    Route::post('/',                $controllers->store)->name($name.'.store')->middleware(['role:superadministrator']);
    Route::get('/{id}/edit',        $controllers->edit)->name($name.'.edit')->middleware(['role:superadministrator']);
    Route::put('/{id}',             $controllers->update)->name($name.'.update')->middleware(['role:superadministrator']);
    Route::delete('/{id}',          $controllers->destroy)->name($name.'.destroy')->middleware(['role:superadministrator']);
});

Route::group(['prefix' => 'api/wilayah-indonesia/village', 'middleware' => ['auth', 'role:superadministrator|admin_sekolah']], function() {
    $class          = 'Bantenprov\WilayahIndonesia\Http\Controllers\VillageController';
    $name           = 'wilayah-indonesia.village';
    $controllers    = (object) [
        'index'         => $class.'@index',
        'get'           => $class.'@get',
        'getByDistrict' => $class.'@getByDistrict',
        'create'        => $class.'@create',
        'show'          => $class.'@show',
        'store'         => $class.'@store',
        'edit'          => $class.'@edit',
        'update'        => $class.'@update',
        'destroy'       => $class.'@destroy',
    ];

    Route::get('/',                     $controllers->index)->name($name.'.index')->middleware(['role:superadministrator']);
    Route::get('/get',                  $controllers->get)->name($name.'.get')->middleware(['role:superadministrator']);
    Route::get('/get/by-district/{id}', $controllers->getByDistrict)->name($name.'.get-by-district')->middleware(['role:superadministrator|admin_sekolah']);
    Route::get('/create',               $controllers->create)->name($name.'.create')->middleware(['role:superadministrator']);
    Route::get('/{id}',                 $controllers->show)->name($name.'.show')->middleware(['role:superadministrator']);
    Route::post('/',                    $controllers->store)->name($name.'.store')->middleware(['role:superadministrator']);
    Route::get('/{id}/edit',            $controllers->edit)->name($name.'.edit')->middleware(['role:superadministrator']);
    Route::put('/{id}',                 $controllers->update)->name($name.'.update')->middleware(['role:superadministrator']);
    Route::delete('/{id}',              $controllers->destroy)->name($name.'.destroy')->middleware(['role:superadministrator']);
});
