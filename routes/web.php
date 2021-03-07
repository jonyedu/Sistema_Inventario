<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin
Route::post('camposAvanzados/Save', 'InsumosFieldsController@registrarCamposAvanzados')->name('camposAvanzados.save');
Route::post('camposAvanzados/Delete', 'InsumosFieldsController@deleteInsumosCamposAvanzados')->name('camposAvanzados.delete');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::redirect('/', '/login')->name('home');


    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Assets
    Route::delete('assets/destroy', 'AssetsController@massDestroy')->name('assets.massDestroy');
    Route::resource('assets', 'AssetsController');
    
    Route::resource('proovedores', 'ProovedoresController');
    Route::resource('ordenes_compra', 'OrdenesDeCompraController');

    Route::resource('ordenes_retiro', 'OrdenesDeRetiroController');
    Route::get('ordenes_retiro/{orden}/asset/create', 'OrdenesDeRetiroController@createAsset')->name('ordenes_retiro.createAsset');
    Route::post('ordenes_retiro/{orden}/asset/store', 'OrdenesDeRetiroController@storeAsset')->name('ordenes_retiro.storeAsset');
    Route::get('ordenes_retiro/{orden}/assets/{asset}/editCantidad', 'OrdenesDeRetiroController@editCantidad')->name('ordenes_retiro.editCantidad');
    Route::put('ordenes_retiro/{orden}/assets/{asset}/updateCantidad', 'OrdenesDeRetiroController@updateCantidad')->name('ordenes_retiro.updateCantidad');
    Route::delete('ordenes_retiro/destroy', 'OrdenesDeRetiroController@massDestroy')->name('ordenes_retiro.massDestroy');
    Route::post('ordenRetiro/SaveFile', 'OrdenesDeRetiroController@updateImage')->name('ordenImageRetiro.save');
    Route::get('serve_fileRetiro/serve', 'OrdenesDeRetiroController@serveFile')->name('serve_fileRetiro.serve.file');
    Route::get('serve_file/getFileRetiro/{id}', 'OrdenesDeRetiroController@getFileOrden')->name('serve_fileRetiro.getFile');
    

    Route::resource('cotizaciones', 'CotizacionesController');
    Route::get('cotizaciones/proovedor/{proovedor}', 'CotizacionesController@indexp') -> name('cotizaciones.indexp');
    Route::get('serve_file/serve', 'OrdenesDeCompraController@serveFile')->name('serve_file.serve.file');
    Route::get('serve_file/getFile/{id}', 'OrdenesDeCompraController@getFileOrden')->name('serve_file.getFile');
    #Route::get('serve_file/getFile/', 'OrdenesDeCompraController@getFileOrden')->name('serve_file.getFile');

    Route::get('ordenes_compra/{orden}/assets/{asset}/editCantidad', 'OrdenesDeCompraController@editCantidad')->name('ordenes_compra.editCantidad');
    Route::put('ordenes_compra/{orden}/assets/{asset}/updateCantidad', 'OrdenesDeCompraController@updateCantidad')->name('ordenes_compra.updateCantidad');
    Route::get('ordenes_compra/{orden}/asset/create', 'OrdenesDeCompraController@createAsset')->name('ordenes_compra.createAsset');
    Route::post('ordenes_compra/{orden}/asset/store', 'OrdenesDeCompraController@storeAsset')->name('ordenes_compra.storeAsset');
    Route::delete('ordenes_compra/destroy', 'OrdenesDeCompraController@massDestroy')->name('ordenes_compra.massDestroy');
    Route::post('ordenCompra/SaveFile', 'OrdenesDeCompraController@updateImage')->name('ordenImageCompra.save');


    Route::resource('ordenes_donacion', 'OrdenesDeDonacionController');
    Route::get('ordenes_donacion/{orden}/assets/{asset}/editCantidad', 'OrdenesDeDonacionController@editCantidad')->name('ordenes_donacion.editCantidad');
    Route::put('ordenes_donacion/{orden}/assets/{asset}/updateCantidad', 'OrdenesDeDonacionController@updateCantidad')->name('ordenes_donacion.updateCantidad');
    Route::get('ordenes_donacion/{orden}/asset/create', 'OrdenesDeDonacionController@createAsset')->name('ordenes_donacion.createAsset');
    Route::post('ordenes_donacion/{orden}/asset/store', 'OrdenesDeDonacionController@storeAsset')->name('ordenes_donacion.storeAsset');
    Route::post('ordenDonacion/SaveFile', 'OrdenesDeDonacionController@updateImage')->name('ordenImage.save');

    Route::get('serve_fileDonacion/serve', 'OrdenesDeDonacionController@serveFile')->name('serve_fileDonacion.serve.file');
    Route::get('serve_fileDonacion/getFile/{id}', 'OrdenesDeDonacionController@getFileOrden')->name('serve_fileDonacion.getFile');
    // Donador
    Route::delete('donadores/destroy', 'DonadoresController@massDestroy')->name('donadores.massDestroy');
    Route::resource('donadores', 'DonadoresController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Stocks
    //Route::delete('stocks/destroy', 'StocksController@massDestroy')->name('stocks.massDestroy');
    Route::resource('stocks', 'StocksController')->only(['index', 'show']);

    // Transactions
//    Route::delete('transactions/destroy', 'TransactionsController@massDestroy')->name('transactions.massDestroy');
    Route::post('transactions/{stock}/storeStock', 'TransactionsController@storeStock')->name('transactions.storeStock');
    Route::resource('transactions', 'TransactionsController')->only(['index']);
    


});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});
