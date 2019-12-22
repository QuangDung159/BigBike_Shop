<?php

namespace App;

class Constant
{
    const TABLE_SHIPPING_STATUS = 'shipping_status';
    const TABLE_BRAND = 'brand';
    const TABLE_CATEGORY = 'category';
    const TABLE_USER = 'user';
    const TABLE_PRODUCT = 'product';
    const TABLE_REVIEW = 'review';
    const TABLE_SLIDE = 'slide';
    const TABLE_ADMIN = 'admin';
    const TABLE_ORDER = 'order';
    const TABLE_ORDER_PRODUCT = 'order_product';
    const TABLE_BRAND_CATEGORY = 'brand_category';
    const TABLE_IMAGE = 'image';
    const TABLE_GALLERY = 'gallery';
    const TABLE_ACTION = 'action';
    const TABLE_MODULE = 'module';
    const TABLE_ACTION_MODULE = 'action_module';

    const PATH_HOME = 'client.page.home';
    const PATH_PRODUCT_DETAIL = 'client.page.product_detail';
    const PATH_CATEGORY = 'client.page.category';
    const PATH_CART = 'client.page.cart';

    const CONTROLLER_HOME = 'HomeController@';
    const CONTROLLER_PRODUCT = 'ProductController@';
    const CONTROLLER_CATEGORY = 'CategoryController@';
    const CONTROLLER_CART = 'CartController@';
    const CONTROLLER_BRAND = 'BrandController@';

    const URL_PRODUCT_DETAIL = '/product/';

    const URL_ADMIN_DASHBOARD = '/admin/';
    const URL_ADMIN_BRAND = '/admin/brand';

    const PATH_TO_UPLOAD_LOGO = '/upload/logo';

    const PATH_ADMIN_DASHBOARD = 'admin.page.dashboard';
    const PATH_ADMIN_BRAND_LIST = 'admin.page.brand.list';
    const PATH_ADMIN_BRAND_CREATE = 'admin.page.brand.create';
    const PATH_ADMIN_BRAND_DETAIL = 'admin.page.brand.detail';
    const PATH_ADMIN_BRAND_EDIT = 'admin.page.brand.edit';
}
