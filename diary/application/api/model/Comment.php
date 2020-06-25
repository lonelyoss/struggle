<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/20
 * Time: 23:06
 */

namespace app\api\model;


use traits\model\SoftDelete;

class Comment extends BaseModel
{
    protected $hidden = ['delete_time'];
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;

    use SoftDelete;
    protected $deleteTime = 'delete_time';

    public function user(){
        return $this->belongsTo('User','uid','id')
            ->field('id,name,photo');
    }

    public function getCommentByDiaryId($parent_id,$diary_id){
        $result = $this->with('user')
            ->where('parent_id','=',$parent_id)
            ->where('diary_id','=',$diary_id)
            ->order('create_time','asc')
            ->select();
        return $result;
    }
}