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
    Route::middleware(['role:root'])->get('/switch/user', 'Auth\SwitchUserController@index')->name('auth.switchUser');
    Route::middleware(['role:root'])->post('/switch/user', 'Auth\SwitchUserController@switch')
        ->name('auth.switchUserSwitch');
    Route::get('/users/ajax', 'Users\UserController@indexAjax')->name('users.getUsers.ajax');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::get('/about', 'AboutController@index')->name('about');
    Route::get('/most_recent_activities', 'ActivityLogController@mostRecent')->name('mostRecentActivities');
    Route::get('/ajax/most_recent_activities', 'ActivityLogController@mostRecentAjax')
        ->name('mostRecentActivitiesAjax');

    // Users Section
    Route::middleware(['role:root'])->resource('users', 'Users\UserController');

    // Role actions are covered by a resource controller...mostly
    Route::middleware(['role:root'])->post('/roles/{role}/users', 'Roles\RoleController@storeRoleUsers')
        ->name('roles.users.store');
    Route::middleware(['role:root'])->delete('/roles/{role}/users/{user}', 'Roles\RoleController@destroyRoleUser')
        ->name('roles.users.destroy');
    Route::middleware(['role:root'])
        ->get('/ajax/roles/{role}/usersnotinrole', 'Roles\RoleController@usersNotInRoleAjax')
        ->name('roles.usersNotInRole.ajax');
    Route::middleware(['role:root'])->get('roles/{role}/users', 'Roles\RoleController@users')
        ->name('roles.users');
    Route::middleware(['role:root'])->resource('roles', 'Roles\RoleController');

    // Product Section
    Route::middleware(['role:root'])
        ->post('/products/{product}/labels', 'Products\ProductController@storeProductLabels')
        ->name('products.productLabels.store');
    Route::middleware(['role:root'])->get('products/{product}/locations', 'Products\ProductController@locations')
        ->name('products.locations');
    Route::middleware(['role:root'])->resource('products', 'Products\ProductController');

    // Location Section
    Route::middleware(['role:root'])
        ->get('/ajax/locations', 'Locations\LocationController@indexAjax')
        ->name('locations.index.ajax');
    Route::middleware(['role:root'])->resource('locations', 'Locations\LocationController');

    // Permission section
    Route::group(
        [
            'middleware' => 'role:root',
            'prefix' => 'roles',
            'namespace' => 'Roles'
        ],
        function () {
            // Permissions actions aren't covered by resource controller because they are listed by role
            Route::get('{role}/permissions', 'PermissionController@index')->name('permissions.index');
            Route::get('{role}/permissions/create', 'PermissionController@create')
                ->name('permissions.create');
            Route::post('{role}/permissions', 'PermissionController@store')->name('permissions.store');
            Route::get('{role}/permissions/{permission}', 'PermissionController@show')
                ->name('permissions.show');
            Route::get('{role}/permissions/{permission}/edit', 'PermissionController@edit')
                ->name('permissions.edit');
            Route::match(['put', 'patch'], '{role}/permissions/{permission}', 'PermissionController@update')
                ->name('permissions.update');
            Route::delete('{role}/permissions/{permission}', 'PermissionController@destroy')
                ->name('permissions.destroy');
        }
    );

    // Web section prefixed by /web controllers in /Web
    Route::group(
        [
            'middleware' => 'role:root|web_project_manager|web_developer',
            'prefix' => 'web', 'namespace' => 'Web'
        ],
        function () {
            Route::get('/', 'WebController@index')->name('webHome');
            Route::middleware(['role:root|web_project_manager'])
                ->get('/report', 'WebController@report')
                ->name('webReport');
        }
    );

    // Sales section prefixed by /sales controllers in /Sales
    Route::group(
        [
            'middleware' => 'role:root|sales_manager|sales_associate',
            'prefix' => 'sales',
            'namespace' => 'Sales'
        ],
        function () {
            Route::get('/', 'SalesController@index')->name('salesHome');
            Route::middleware(['role:root|sales_manager'])
                ->get('/report', 'SalesController@report')
                ->name('salesReport');
        }
    );

    // Finance section prefixed by /finance controllers in /Finance
    Route::group(
        [
            'middleware' => 'role:root|finance_manager|finance_associate',
            'prefix' => 'finance',
            'namespace' => 'Finance'
        ],
        function () {
            Route::get('/', 'FinanceController@index')->name('financeHome');
            Route::middleware(['role:root|finance_manager'])
                ->get('/ledger', 'LedgerController@index')
                ->name('ledger');
        }
    );

    // Warehouse section prefixed by /warehouse controllers in /Warehouse
    Route::group(
        [
            'middleware' => 'role:root|warehouse_manager|warehouse_associate',
            'prefix' => 'warehouse',
            'namespace' => 'Warehouse'
        ],
        function () {
            Route::get('/form', 'WarehouseController@form')->name('warehouseForm');
            Route::post('/form', 'WarehouseController@formSubmit')->name('warehouseFormSubmit');
        }
    );
});
