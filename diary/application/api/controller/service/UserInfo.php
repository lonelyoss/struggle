<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/30
 * Time: 15:50
 */

namespace app\api\controller\service;

use app\api\model\Province as ProvinceModel;
use app\api\model\UserBirthday as UserBirthdayModel;
use app\api\model\UserHometown as UserHometownModel;
use app\api\model\UserLocation as UserLocationModel;
use app\api\lib\exception\SuccessMessage;
use think\Db;
use think\Exception;
use app\api\model\City as CityModel;
use app\api\model\Area as AreaModel;
use app\api\model\UserInfo as UserInfoModel;
class UserInfo
{
    public function commonSave(&$params,$uid,$type=0){
        Db::startTrans();
        try{
            if(!array_key_exists('sex',$params)){
                $params['sex'] = null;
            }
            if(!array_key_exists('age',$params)){
                $params['age'] = null;
            }
            if(!array_key_exists('birthday_year',$params)){
                $params['birthday_year'] = null;
            }
            if(!array_key_exists('birthday_month',$params)){
                $params['birthday_month'] = null;
            }
            if(!array_key_exists('birthday_day',$params)){
                $params['birthday_day'] = null;
            }
            if(!array_key_exists('constellation',$params)){
                $params['constellation'] = null;
            }
            if(!array_key_exists('location_province_code',$params)){
                $params['location_province_code'] = null;
            }
            if(!array_key_exists('location_city_code',$params)){
                $params['location_city_code'] = null;
            }
            if(!array_key_exists('location_area_code',$params)){
                $params['location_area_code'] = null;
            }
            if(!array_key_exists('marriage',$params)){
                $params['marriage'] = null;
            }
            if(!array_key_exists('blood',$params)){
                $params['blood'] = null;
            }
            if(!array_key_exists('hometown_province_code',$params)){
                $params['hometown_province_code'] = null;
            }
            if(!array_key_exists('hometown_city_code',$params)){
                $params['hometown_city_code'] = null;
            }
            if(!array_key_exists('hometown_area_code',$params)){
                $params['hometown_area_code'] = null;
            }

            $user_info_model = new UserInfoModel();
            $user_birthday_model = new UserBirthdayModel();
            $user_hometown_model = new UserHometownModel();
            $user_location_model = new UserLocationModel();
            if($type==0){
                $user_info_model->save([
                    'uid'=>$uid,
                    'sex'=>$params['sex'],
                    'age'=>$params['age'],
                    'constellation'=>$params['constellation'],
                    'marriage'=>$params['marriage'],
                    'blood'=>$params['blood'],
                ]);
                $user_birthday_model->save([
                    'uid'=>$uid,
                    'year'=>$params['birthday_year'],
                    'month'=>$params['birthday_month'],
                    'day'=>$params['birthday_day'],
                ]);
                $location_province_name = $this->getProvince($params['location_province_code']);
                $location_city_name = $this->getCity($params['location_city_code']);
                $location_area_name = $this->getArea($params['location_area_code']);
                $user_location_model->save([
                    'uid'=>$uid,
                    'province_code'=>$params['location_province_code'],
                    'province_name'=>$location_province_name,
                    'city_code'=>$params['location_city_code'],
                    'city_name'=>$location_city_name,
                    'area_code'=>$params['location_area_code'],
                    'area_name'=>$location_area_name,
                ]);
                $hometown_province_name = $this->getProvince($params['hometown_province_code']);
                $hometown_city_name = $this->getCity($params['hometown_city_code']);
                $hometown_area_name = $this->getArea($params['hometown_area_code']);
                $user_hometown_model->save([
                    'uid'=>$uid,
                    'province_code'=>$params['hometown_province_code'],
                    'province_name'=>$hometown_province_name,
                    'city_code'=>$params['hometown_city_code'],
                    'city_name'=>$hometown_city_name,
                    'area_code'=>$params['hometown_area_code'],
                    'area_name'=>$hometown_area_name
                ]);
            }else{
                $user_info_model->save([
                    'sex'=>$params['sex'],
                    'age'=>$params['age'],
                    'constellation'=>$params['constellation'],
                    'marriage'=>$params['marriage'],
                    'blood'=>$params['blood'],
                ],['uid'=>$uid]);
                $user_birthday_model->save([
                    'year'=>$params['birthday_year'],
                    'month'=>$params['birthday_month'],
                    'day'=>$params['birthday_day'],
                ],['uid'=>$uid]);
                $location_province_name = $this->getProvince($params['location_province_code']);
                $location_city_name = $this->getCity($params['location_city_code']);
                $location_area_name = $this->getArea($params['location_area_code']);
                $user_location_model->save([
                    'province_code'=>$params['location_province_code'],
                    'province_name'=>$location_province_name,
                    'city_code'=>$params['location_city_code'],
                    'city_name'=>$location_city_name,
                    'area_code'=>$params['location_area_code'],
                    'area_name'=>$location_area_name,
                ],['uid'=>$uid]);
                $hometown_province_name = $this->getProvince($params['hometown_province_code']);
                $hometown_city_name = $this->getCity($params['hometown_city_code']);
                $hometown_area_name = $this->getArea($params['hometown_area_code']);
                $user_hometown_model->save([
                    'province_code'=>$params['hometown_province_code'],
                    'province_name'=>$hometown_province_name,
                    'city_code'=>$params['hometown_city_code'],
                    'city_name'=>$hometown_city_name,
                    'area_code'=>$params['hometown_area_code'],
                    'area_name'=>$hometown_area_name
                ],['uid'=>$uid]);
            }
            Db::commit();
            throw new SuccessMessage();
        }catch(Exception $exception){
            Db::rollback();
            throw $exception;
        }
    }


    private function getProvince($province_code){
        $province_model = new ProvinceModel();
        $province = $province_model->where('code','=',$province_code)
            ->field('name')->find();
        return $province['name'];
    }
    private function getCity($city_code){
        $city_model = new CityModel();
        $city  = $city_model->where('code','=',$city_code)->field('name')->find();
        return $city['name'];
    }
    private function getArea($area_code){
        $area_model = new AreaModel();
        $area = $area_model->where('code','=',$area_code)
            ->field('name')
            ->find();
        return $area['name'];
    }
}