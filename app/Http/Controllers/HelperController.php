<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public static function convertStdToArray($object)
    {
        return json_decode(json_encode($object), True);
    }

    public static function convertArrayToStd($array)
    {
        return json_decode(json_encode($array));
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

    public static function buildUrlWithParams($arrayParam)
    {
        $url = '?';
        foreach ($arrayParam as $key => $value) {
            $url .= $key . '=' . $value . '&';
        }
        return $url;
    }
}
