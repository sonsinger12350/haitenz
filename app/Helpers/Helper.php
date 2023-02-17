<?php

namespace App\Helpers;

class Helper{

    public static function slug($str) {       
        $str = mb_strtolower($str);        
        $str = str_replace(' - ',' ',$str);
        $str = str_replace('- ',' ',$str);
        $str = str_replace(' -',' ',$str);
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
        $str = preg_replace("/( )/", '-', $str);
        return trim($str,'-');
    }
    
    public static function numberFormat($num,$decimalPlace=0) {               
        return number_format($num,$decimalPlace,'.',',');
    }

    public static function dateFormat($time) {               
        return Date('Y-m-d',$time);
    }

    public static function dateTimeFormat($time) {               
        return Date('Y-m-d H:i',$time);
    }
    public function getCookie(Request $request){
        $value = $request->cookie($name);
        return $value;
    }
    public function setCookie(Request $request){
        $minutes = 60;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('name', 'MyValue', $minutes));
        return $response;
    }
}
