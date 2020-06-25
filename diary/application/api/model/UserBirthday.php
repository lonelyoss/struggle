<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/20
 * Time: 15:18
 */

namespace app\api\model;


class UserBirthday extends BaseModel
{
    protected $hidden = ['create_time','uid','id','update_time'];
    protected $autoWriteTimestamp = true;
}