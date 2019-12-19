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

    const CONTROLLER_HOME = 'HomeController@';

    public static function convertStdToArray($object)
    {
        return json_decode(json_encode($object), True);
    }

    public static function uniqueMultiFieldArray($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}
