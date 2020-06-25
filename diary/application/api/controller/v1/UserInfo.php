<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/19
 * Time: 18:37
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\lib\exception\SuccessMessage;
use app\api\lib\exception\UserException;
use app\api\model\Province as ProvinceModel;
use app\api\model\UserBirthday as UserBirthdayModel;
use app\api\model\UserHometown as UserHometownModel;
use app\api\model\UserLocation as UserLocationModel;
use app\api\validate\CheckID;
use app\api\validate\CheckUserInfo;
use think\Db;
use think\Exception;
use think\Request;
use app\api\model\UserInfo as UserInfoModel;
use app\api\model\City as CityModel;
use app\api\model\Area as AreaModel;
class UserInfo extends BaseController
{
    public function create(Request $request){
        $this->isLogin();
        (new CheckID())->goCheck();
        (new CheckUserInfo())->goCheck();
        $params = $request->param();
        $this->checkUser($params);
        $user_info_model = new UserInfoModel();
        $user_info = $user_info_model->where('uid','=',$this->getUid())->find();
        if($user_info){
            $this->commonSave($params,1);
        }else{
            $this->commonSave($params);
        }

    }


    private function checkUser($params){
        if($params['id']==$this->getUid()){
            return true;
        }else{
            throw new UserException([
                'msg'=>'用户参数错误,没有权限'
            ]);
        }
    }

    private function commonSave($params,$type=0){
        Db::startTrans();
        try{
            $user_info_model = new UserInfoModel();
            $user_birthday_model = new UserBirthdayModel();
            $user_hometown_model = new UserHometownModel();
            $user_location_model = new UserLocationModel();
            if($type==0){
                $user_info_model->save([
                    'uid'=>$this->getUid(),
                    'sex'=>$params['sex'],
                    'age'=>$params['age'],
                    'constellation'=>$params['constellation'],
                    'marriage'=>$params['marriage'],
                    'blood'=>$params['blood'],
                ]);
                $user_birthday_model->save([
                    'uid'=>$this->getUid(),
                    'year'=>$params['birthday_year'],
                    'month'=>$params['birthday_month'],
                    'day'=>$params['birthday_day'],
                ]);
                $location_province_name = $this->getProvince($params['location_province_code']);
                $location_city_name = $this->getCity($params['location_city_code']);
                $location_area_name = $this->getArea($params['location_area_code']);
                $user_location_model->save([
                    'uid'=>$this->getUid(),
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
                    'uid'=>$this->getUid(),
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
                ],['uid'=>$this->getUid()]);
                $user_birthday_model->save([
                    'year'=>$params['birthday_year'],
                    'month'=>$params['birthday_month'],
                    'day'=>$params['birthday_day'],
                ],['uid'=>$this->getUid()]);
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
                ],['uid'=>$this->getUid()]);
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
                ],['uid'=>$this->getUid()]);
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