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
    protected $hidden = ['password','email','update_time','delete_time'];

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

    public function getAll($user_id){
        $result = $this->with(['todayDiaries'])
            ->where('id','=',$user_id)
            ->find();
        return $result;
    }

    public function getUserInfo($user_id){
        $result = $this->with(['birthday','info','location','hometown'])
        ->where('id','=',$user_id)->find();
        return $result;
    }
}