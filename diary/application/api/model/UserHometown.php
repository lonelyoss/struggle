<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/20
 * Time: 15:19
 */

namespace app\api\model;


class UserHometown extends BaseModel
{
    protected $hidden = ['create_time','uid','id','update_time'];
    protected $autoWriteTimestamp = true;

    public function province(){
        return $this->belongsTo('Province','province_code','code');
    }
    public function city(){
        return $this->belongsTo('City','city_code','code');
    }
    public function area(){
        return $this->belongsTo('Area','area_code','code');
    }

    public function hometown(){
        $result = $this->with(['province','city','area']);
        return $result;
    }
}