<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 17:24
 */

namespace app\api\model;


use traits\model\SoftDelete;

class Book extends BaseModel
{
    protected $hidden = ['uid','create_time','update_time','delete_time'];
    protected $autoWriteTimestamp = true;
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    public function getBookByUserId($user_id){
        $result = $this->where('uid','=',$user_id)
            ->field('id,book_name,create_time')
            ->select();
        return $result;
    }
}