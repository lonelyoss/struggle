<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/20
 * Time: 11:37
 */

namespace app\api\validate;


class CheckUserInfo extends BaseValidate
{
    protected $rule = [
        'sex'=>'mustInteger',
        'age'=>'mustInteger|between:1,120',
        'birthday_year'=>'mustInteger|between:1900,2020',
        'birthday_month'=>'mustInteger|between:1,12',
        'birthday_day'=>'mustInteger|between:1,31',
        'constellation'=>'checkConstellation',
        'location_province_code'=>'mustInteger|checkProvince',
        'location_city_code'=>'mustInteger|checkCity',
        'location_area_code'=>'mustInteger|checkArea',
        'marriage'=>'mustInteger|between:1,3',
        'blood'=>'mustInteger',
        'hometown_province_code'=>'mustInteger|checkProvince',
        'hometown_city_code'=>'mustInteger|checkCity',
        'hometown_area_code'=>'mustInteger|checkArea',
    ];
    protected $message = [
        'sex'=>'性别参数错误',
        'age'=>'年龄参数错误',
        'birthday_year'=>'年份参数错误',
        'birthday_month'=>'月份参数错误',
        'birthday_day'=>'天参数错误',
        'constellation'=>'星座参数错误',
        'location_province_code'=>'所在地省份参数错误',
        'location_city_code'=>'所在地市区参数错误',
        'location_area_code'=>'所在地县区参数错误',
        'marriage'=>'婚姻参数错误',
        'blood'=>'血型参数错误',
        'hometown_province_code'=>'故乡省份参数错误',
        'hometown_city_code'=>'故乡市区参数错误',
        'hometown_area_code'=>'故乡县区参数错误',
    ];

    protected function checkProvince($value){
        if($value>=110000){
            return true;
        }else{
            return false;
        }
    }
    protected function checkCity($value){
        if($value>=110100){
            return true;
        }else{
            return false;
        }
    }
    protected function checkArea($value){
        if($value>=110101){
            return true;
        }else{
            return false;
        }
    }

    protected function checkConstellation($value){
        switch ($value){
            case '白羊座':return true;break;
            case '双子座':return true;break;
            case '狮子座':return true;break;
            case '天秤座':return true;break;
            case '射手座':return true;break;
            case '水瓶座':return true;break;
            case '金牛座':return true;break;
            case '巨蟹座':return true;break;
            case '处女座':return true;break;
            case '天蝎座':return true;break;
            case '摩羯座':return true;break;
            case '双鱼座':return true;break;
            default:return false;break;
        }


    }
}