<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 17:24
 */

namespace app\api\model;


class User extends BaseModel
{
    protected $hidden = ['password','email','update_time','delete_time','id'];

    protected $autoWriteTimestamp =true;

    protected function getPhotoAttr($value){
        $imgUrl = config('setting.photo_prefix').$value;
        return $imgUrl;
    }

    public function todayDiaries(){
        return $this->hasMany('Diary','uid','id')
            ->whereTime('create_time','today');
    }

    public function info(){
        return $this->hasOne('UserInfo','uid','id');
    }

    public function birthday(){
        return $this->hasOne('UserBirthday','uid','id');
    }

    public function location(){
        return $this->hasOne('UserLocation','uid','id');
    }

    public function hometown(){
        return $this->hasOne('UserHometown','uid','id');
    }

    public function getAll($usr_code){
        $result = $this->with(['todayDiaries'])
            ->where('user_code','=',$usr_code)
            ->find();
        return $result;
    }

    public function getUserInfo($user_code){
        $result = $this->with(['birthday','info','location','hometown'])
        ->where('user_code','=',$user_code)->find();
        if($result->birthday == null){
            $result->birthday = [];
        }
        if($result->info == null){
            $result->info = [];
        }
        if($result->location == null){
            $result->location = [];
        }
        if($result->hometown == null){
            $result->hometown = [];
        }
        return $result;
    }
}