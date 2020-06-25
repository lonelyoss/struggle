<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 21:47
 */

namespace app\api\model;


use traits\model\SoftDelete;

class Diary extends BaseModel
{
    protected $hidden = ['uid','book_id','update_time','delete_time',];
    protected $autoWriteTimestamp = true;
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    public function user(){
        return $this->belongsTo('User','uid','id')->field('id,name username,photo');
    }
    public function book(){
        return $this->belongsTo('Book','book_id','id')->field('id,book_name');
    }

    public function getAll(){
        $result = $this->with(['user','book'])
            ->field('id,uid,book_id,content,create_time')
            ->select();
        return $result;
    }

    public function getOne($id){
        $result = $this->with(['user','book'])
            ->where('id','=',$id)
            ->find();
        return $result;
    }
}