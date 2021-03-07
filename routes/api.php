<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Assets
    Route::apiResource('assets', 'AssetsApiController');

    // Donadores
    Route::apiResource('donadores', 'DonadoresApiController');

    // Donadores
    #Route::apiResource('proovedores', 'ProovedoresApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Stocks
    Route::apiResource('stocks', 'StocksApiController');

    // Transactions
    Route::apiResource('transactions', 'TransactionsApiController');

});
