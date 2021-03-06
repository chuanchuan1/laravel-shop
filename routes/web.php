<?php

Route::redirect('/', '/products')->name('root');
Route::get('products', "ProductsController@index")->name('products.index');

Auth::routes(["verify" => true]);

Route::group(["middleware" => ["auth", "verified"]], function () {
    Route::get("user_addresses", "UserAddressesController@index")->name("user_addresses.index");
    Route::get("user_addresses/create", "UserAddressesController@create")->name("user_addresses.create");
    Route::post("user_addresses", "UserAddressesController@store")->name("user_addresses.store");
    Route::delete("user_addresses/{user_address}", "UserAddressesController@destroy")->name("user_addresses.destroy");
    Route::get("user_addresses/{user_address}", "UserAddressesController@edit")->name("user_addresses.edit");
    Route::put("user_addresses/{user_address}", "UserAddressesController@update")->name("user_addresses.update");
});
