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
    protected $hidden = ['uid','update_time','delete_time',];
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
        /*$result = $this->with(['user','book'])
            ->field('id,uid,book_id,content,create_time')
            ->order('create_time','desc')
            ->select();*/
        $result = $this->alias('diary')
            ->join('user','user.id = diary.uid')
            ->join('book','book.uid = user.id')
            ->field('user.name username,user.photo photo,diary.content,diary.create_time,book.book_name')
            ->order('diary.create_time','desc')
            ->select();
        return $result;
    }

    public function getOne($id){
        /*$result = $this->with(['user','book'])
            ->where('id','=',$id)
            ->find();*/
        $result = $this->alias('diary')
            ->join('user','user.id = diary.uid')
            ->join('book','book.uid = user.id')
            ->where('diary.id','=',$id)
            ->field('user.name username,user.photo photo,user.user_code,diary.content,diary.create_time,book.id book_id,book.book_name')
            ->order('diary.create_time','desc')
            ->find();
        return $result;
    }
}