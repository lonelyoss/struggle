<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 17:24
 */

namespace app\api\model;


class UserInfo extends BaseModel
{
    protected $hidden = ['delete_time','update_time','id','uid','create_time'];

    protected $autoWriteTimestamp = true;


}