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
Route::group([], function () {
    Route::get('/admin/dashboard', Constant::CONTROLLER_HOME . 'showAdminDashboard');
    Route::get('/admin/brand/list', Constant::CONTROLLER_BRAND . 'showListPage');
    Route::get('/admin/brand/delete/{brandId}', Constant::CONTROLLER_BRAND . 'deleteBrand');
    Route::get('/admin/brand/create', Constant::CONTROLLER_BRAND . 'showCreateBrandPage');
    Route::post('/admin/brand/create', Constant::CONTROLLER_BRAND . 'doCreateBrand');
    Route::get('/admin/brand/change-status/{brandId}/{status}', Constant::CONTROLLER_BRAND . 'changeStatus');
});
