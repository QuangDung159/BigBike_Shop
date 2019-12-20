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
