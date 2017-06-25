<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// You must authenticate to get to any page on our site
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::get('/about', 'AboutController@index')->name('about');

    // Role actions are covered by a resource controller
    Route::/*middleware(['role:root'])->*/resource('roles', 'Roles\RoleController');
    // Permission section
    Route::group([/*'middleware' => 'role:root', */'prefix' => 'roles', 'namespace' => 'Roles'], function () {
        // Permissions actions aren't covered by resource controller because they are listed by role
        Route::get('{role}/permissions', 'PermissionController@index')->name('permissions.index');
        Route::get('{role}/permissions/create', 'PermissionController@create')->name('permissions.create');
        Route::post('{role}/permissions', 'PermissionController@store')->name('permissions.store');
        Route::get('{role}/permissions/{permission}', 'PermissionController@show')->name('permissions.show');
        Route::get('{role}/permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
        Route::patch('{role}/permissions/{permission}', 'PermissionController@update')->name('permissions.update');
        Route::delete('{role}/permissions/{permission}', 'PermissionController@destroy')->name('permissions.destroy');
    });

    // Finance section prefixed by /finance controllers in /Finance
    Route::group(['middleware' => 'role:root|finance', 'prefix' => 'finance', 'namespace' => 'Finance'], function () {
        Route::get('/', 'FinanceController@index')->name('financeHome');
        Route::get('/ledger', 'LedgerController@index')->name('ledger');
    });

    // Web section prefixed by /web controllers in /Web
    Route::group(['middleware' => 'role:root|web', 'prefix' => 'web', 'namespace' => 'Web'], function () {
        Route::get('/', 'WebController@index')->name('webHome');
        Route::get('/report', 'WebController@report')->name('webReport');
    });

    // Sales section prefixed by /sales controllers in /Sales
    Route::group(['middleware' => 'role:root|sales', 'prefix' => 'sales', 'namespace' => 'Sales'], function () {
        Route::get('/sales', 'SalesController@index')->name('salesHome');
        Route::get('/sales/report', 'SalesController@report')->name('salesReport');
    });

    // Warehouse section prefixed by /warehouse controllers in /Warehouse
    Route::group(['middleware' => 'role:root|warehouse', 'prefix' => 'warehouse', 'namespace' => 'Warehouse'], function () {
        Route::get('/form', 'WarehouseController@form')->name('warehouseForm');
        Route::post('/form', 'WarehouseController@formSubmit')->name('warehouseFormSubmit');
    });
});
