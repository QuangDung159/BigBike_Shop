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
    const TABLE_ADMIN_ACTION_MODULE = 'admin_action_module';

    const PATH_HOME = 'client.page.home';
    const PATH_PRODUCT_DETAIL = 'client.page.product_detail';
    const PATH_CATEGORY = 'client.page.category';
    const PATH_CART = 'client.page.cart';

    const CONTROLLER_HOME = 'HomeController@';
    const CONTROLLER_PRODUCT = 'ProductController@';
    const CONTROLLER_CATEGORY = 'CategoryController@';
    const CONTROLLER_CART = 'CartController@';
    const CONTROLLER_BRAND = 'BrandController@';
    const CONTROLLER_ADMIN = 'AdminController@';
    const CONTROLLER_BRAND_CATEGORY = 'BrandCategoryController@';
    const CONTROLLER_GALLERY = 'GalleryController@';

    const URL_PRODUCT_DETAIL = '/product/';

    const URL_ADMIN_DASHBOARD = '/admin/dashboard';
    const URL_ADMIN_LOGIN = '/admin/login';
    const URL_ADMIN_BRAND = '/admin/brand';
    const URL_ADMIN_CATEGORY = '/admin/category';
    const URL_ADMIN_BRAND_CATEGORY = '/admin/brand_category';

    const PATH_TO_UPLOAD_LOGO = '/upload/logo';

    const PATH_ADMIN_ADMIN_LOGIN = 'admin.page.admin.login';

    const PATH_ADMIN_DASHBOARD = 'admin.page.dashboard';

    const PATH_ADMIN_BRAND_LIST = 'admin.page.brand.list';
    const PATH_ADMIN_BRAND_CREATE = 'admin.page.brand.create';
    const PATH_ADMIN_BRAND_DETAIL = 'admin.page.brand.detail';
    const PATH_ADMIN_BRAND_EDIT = 'admin.page.brand.edit';

    const PATH_ADMIN_CATEGORY_LIST = 'admin.page.category.list';
    const PATH_ADMIN_CATEGORY_CREATE = 'admin.page.category.create';
    const PATH_ADMIN_CATEGORY_DETAIL = 'admin.page.category.detail';
    const PATH_ADMIN_CATEGORY_EDIT = 'admin.page.category.edit';

    const PATH_ADMIN_BRAND_CATEGORY_LIST = 'admin.page.brand_category.list';
    const PATH_ADMIN_BRAND_CATEGORY_CREATE = 'admin.page.brand_category.create';
    //const PATH_ADMIN_BRAND_CATEGORY_DETAIL = 'admin.page.brand_category.detail';
    const PATH_ADMIN_BRAND_CATEGORY_EDIT = 'admin.page.brand_category.edit';

    const PATH_ADMIN_GALLERY_LIST = 'admin.page.gallery.list';
    const PATH_ADMIN_GALLERY_CREATE = 'admin.page.gallery.create';
    const PATH_ADMIN_GALLERY_DETAIL = 'admin.page.gallery.detail';
    const PATH_ADMIN_GALLERY_EDIT = 'admin.page.gallery.edit';
}
