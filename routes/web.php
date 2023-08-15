<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api/kendaraan/pengajuanpembelians'], function() use($router){

    $router->get('/', 'PengajuanPembelianController@index');
    $router->post('/', 'PengajuanPembelianController@create');
    $router->get('/{id_pengajuanpembelian}', 'PengajuanPembelianController@show');
    $router->put('/{id_pengajuanpembelian}', 'PengajuanPembelianController@update');
    $router->delete('/{id_pengajuanpembelian}', 'PengajuanPembelianController@destroy');
    $router->put('/{id_pengajuanpembelian}/approve', 'PengajuanPembelianController@approved');
    $router->put('/{id_pengajuanpembelian}/reject', 'PengajuanPembelianController@rejected');
});

$router->group(['prefix'=>'api/kendaraan/transaksipembelians'], function() use($router){
    $router->get('/', 'TransaksiPembelianController@index');
    $router->post('/', 'TransaksiPembelianController@create');
    $router->get('/{id_transaksipembelian}', 'TransaksiPembelianController@show');
    $router->put('/{id_transaksipembelian}', 'TransaksiPembelianController@update');
    $router->delete('/{id_transaksipembelian}', 'TransaksiPembelianController@destroy');
    $router->put('/{id_transaksipembelian}/approve', 'TransaksiPembelianController@approved');
    $router->put('/{id_transaksipembelian}/reject', 'TransaksiPembelianController@rejected');
});

$router->group(['prefix'=>'api/kendaraan/stdealertowahanas'], function() use($router){
    $router->get('/', 'STDealertoWahanaController@index');
    $router->post('/', 'STDealertoWahanaController@create');
    $router->get('/{no_polisi}', 'STDealertoWahanaController@show');
    $router->put('/{no_polisi}', 'STDealertoWahanaController@update');
    $router->put('/{no_polisi}/approve', 'STDealertoWahanaController@approved');
    $router->put('/{no_polisi}/reject', 'STDealertoWahanaController@rejected');
});

$router->group(['prefix'=>'api/kendaraan/kendaraans'], function() use($router){
    $router->get('/', 'KendaraanController@index');
    $router->get('/{no_polisi}', 'KendaraanController@show');
    $router->put('/{no_polisi}/updatestatusproses', 'KendaraanController@updatestatusproses');
    $router->put('/{no_polisi}/updatestatusdisewa', 'KendaraanController@updatestatusdisewa');
});