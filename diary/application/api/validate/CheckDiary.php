<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 21:29
 */

namespace app\api\validate;



use app\api\model\Diary as DiaryModel;
class CheckDiary extends BaseValidate
{
    protected $rule = [
        'book_id'   =>  'require|isEmpty|mustInteger|checkBookId',
        'content'   =>  'require',
        'id'    =>'require|mustInteger|checkDiary|isEmpty',

    ];

    protected $message = [
        'book_id.require'   =>'请选择一个日记本',
        'book_id.checkBookId'=>'这不是你的日记本，请重试',
        'content'   =>'文章正文不得为空',
        'id.require'=>'id不得为空',
        'id.isEmpty'=>'id不得为空',
        'id.mustInteger'=>'id必须为正整数',
        'id.checkDiary'    =>'这不是你的日记'
    ];

    protected $scene = [
        'create'    =>['book_id','content'],
        'update'    =>['id','book_id','content'],
        'delete'    =>['id'],
        'get'       =>['id']
    ];

    protected function checkDiary($value){
        $diary_model = new DiaryModel();
        $diary = $diary_model::get($value);
        $uid = session('uid');
        if($uid == $diary['uid']){
            return true;
        }else{
            return false;
        }
    }

}