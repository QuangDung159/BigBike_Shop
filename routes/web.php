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

        // brand - category
        Route::get('/admin/brand_category/read', Constant::CONTROLLER_BRAND_CATEGORY . 'showListPage');
        Route::get('/admin/brand_category/delete/{categoryId}', Constant::CONTROLLER_BRAND_CATEGORY . 'deleteBrandCategory');
        Route::get('/admin/brand_category/create', Constant::CONTROLLER_BRAND_CATEGORY . 'showCreateBrandCategoryPage');
        Route::post('/admin/brand_category/create', Constant::CONTROLLER_BRAND_CATEGORY . 'doCreateBrandCategory');
        Route::get('/admin/brand_category/update/change-status/{categoryId}/{status}', Constant::CONTROLLER_BRAND_CATEGORY . 'changeStatus');
        //Route::get('/admin/brand_category/read/detail/{categoryId}', Constant::CONTROLLER_BRAND_CATEGORY . 'showDetailPage');
        Route::get('/admin/brand_category/update/{categoryId}', Constant::CONTROLLER_BRAND_CATEGORY . 'showEditPage');
        Route::post('/admin/brand_category/update', Constant::CONTROLLER_BRAND_CATEGORY . 'doEditBrandCategory');

        // product
        Route::get('/admin/product/read', Constant::CONTROLLER_CATEGORY . 'showListPage');
        Route::get('/admin/product/delete/{productId}', Constant::CONTROLLER_CATEGORY . 'deleteProduct');
        Route::get('/admin/product/create', Constant::CONTROLLER_CATEGORY . 'showCreateProductPage');
        Route::post('/admin/product/create', Constant::CONTROLLER_CATEGORY . 'doCreateProduct');
        Route::get('/admin/product/update/change-status/{productId}/{status}', Constant::CONTROLLER_CATEGORY . 'changeStatus');
        Route::get('/admin/product/read/detail/{productId}', Constant::CONTROLLER_CATEGORY . 'showDetailPage');
        Route::get('/admin/product/update/{productId}', Constant::CONTROLLER_CATEGORY . 'showEditPage');
        Route::post('/admin/product/update', Constant::CONTROLLER_CATEGORY . 'doEditProduct');

        // gallery
        Route::get('/admin/gallery/read', Constant::CONTROLLER_GALLERY . 'showListPage');
        Route::get('/admin/gallery/delete/{productId}', Constant::CONTROLLER_GALLERY . 'deleteProduct');
        Route::get('/admin/gallery/create', Constant::CONTROLLER_GALLERY . 'showCreateProductPage');
        Route::post('/admin/gallery/create', Constant::CONTROLLER_GALLERY . 'doCreateProduct');
        Route::get('/admin/gallery/update/change-status/{productId}/{status}', Constant::CONTROLLER_GALLERY . 'changeStatus');
        Route::get('/admin/gallery/read/detail/{productId}', Constant::CONTROLLER_GALLERY . 'showDetailPage');
        Route::get('/admin/gallery/update/{productId}', Constant::CONTROLLER_GALLERY . 'showEditPage');
        Route::post('/admin/gallery/update', Constant::CONTROLLER_GALLERY . 'doEditProduct');
    });
});

Route::get('/admin/login', Constant::CONTROLLER_ADMIN . 'showAdminLoginPage');
Route::post('/admin/login', Constant::CONTROLLER_ADMIN . 'doLogin');
Route::get('/admin/logout', Constant::CONTROLLER_ADMIN . 'doLogout');
