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

use App\Constant;

// client
Route::group([], function () {
    Route::get('/', Constant::CONTROLLER_HOME . 'showHomePage');
    Route::get('/home', Constant::CONTROLLER_HOME . 'showHomePage');
    Route::get('/product/{productId}', Constant::CONTROLLER_PRODUCT . 'showProductDetailPage');
    Route::get('/category/{categoryId}/{brand_id}', Constant::CONTROLLER_CATEGORY . 'showCategoryPage');
    Route::get('/cart', Constant::CONTROLLER_CART . 'showCartPage');
    //Route::post('/cart/doAddToCart', Constant::CONTROLLER_CART . 'doAddToCart');
    Route::get('/cart/doAddToCartGet/{productId}', Constant::CONTROLLER_CART . 'doAddToCartGet');
    Route::get('/cart/doAddToCartProductDetail/{productId}', Constant::CONTROLLER_CART . 'doAddToCartProductDetail');
});

// admin
Route::group(['middleware' => 'authen.admin'], function () {

    Route::get('/admin/dashboard', Constant::CONTROLLER_HOME . 'showAdminDashboard');

    Route::group(['middleware' => 'acl'], function () {

        // brand
        Route::get('/admin/brand/read', Constant::CONTROLLER_BRAND . 'showListPage');
        Route::get('/admin/brand/delete/{brandId}', Constant::CONTROLLER_BRAND . 'deleteBrand');
        Route::get('/admin/brand/create', Constant::CONTROLLER_BRAND . 'showCreateBrandPage');
        Route::post('/admin/brand/create', Constant::CONTROLLER_BRAND . 'doCreateBrand');
        Route::get('/admin/brand/update/change-status/{brandId}/{status}', Constant::CONTROLLER_BRAND . 'changeStatus');
        Route::get('/admin/brand/read/detail/{brandId}', Constant::CONTROLLER_BRAND . 'showDetailPage');
        Route::get('/admin/brand/update/{brandId}', Constant::CONTROLLER_BRAND . 'showEditPage');
        Route::post('/admin/brand/update', Constant::CONTROLLER_BRAND . 'doEditBrand');

        // category
        Route::get('/admin/category/read', Constant::CONTROLLER_CATEGORY . 'showListPage');
        Route::get('/admin/category/delete/{categoryId}', Constant::CONTROLLER_CATEGORY . 'deleteCategory');
        Route::get('/admin/category/create', Constant::CONTROLLER_CATEGORY . 'showCreateCategoryPage');
        Route::post('/admin/category/create', Constant::CONTROLLER_CATEGORY . 'doCreateCategory');
        Route::get('/admin/category/update/change-status/{categoryId}/{status}', Constant::CONTROLLER_CATEGORY . 'changeStatus');
        Route::get('/admin/category/read/detail/{categoryId}', Constant::CONTROLLER_CATEGORY . 'showDetailPage');
        Route::get('/admin/category/update/{categoryId}', Constant::CONTROLLER_CATEGORY . 'showEditPage');
        Route::post('/admin/category/update', Constant::CONTROLLER_CATEGORY . 'doEditCategory');
    });
});

Route::get('/admin/login', Constant::CONTROLLER_ADMIN . 'showAdminLoginPage');
Route::post('/admin/login', Constant::CONTROLLER_ADMIN . 'doLogin');
Route::get('/admin/logout', Constant::CONTROLLER_ADMIN . 'doLogout');
