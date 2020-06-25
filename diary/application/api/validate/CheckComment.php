<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/20
 * Time: 22:41
 */

namespace app\api\validate;

use app\api\model\Comment as CommentModel;
class CheckComment extends BaseValidate
{
    protected $rule = [
        'id'=>'require|mustInteger|checkCommentId',
        'parent_id'=>'mustIntegerParentId|isEmpty',
        'content'=>'require|max:50',
    ];
    protected $message = [
        'id.require'=>'Id不得为空',
        'id.mustInteger'=>'Id必须为正整数',
        'id.checkCommentId'=>'这条评论不属于你',
        'parent_id'=>'parent_id参数错误',
        'content.require'=>'评论内容不得为空',
        'content.max'=>'评论内容不得超过50个字符'
    ];

    protected $scene = [
        'create'        =>['parent_id','content'],
        'delete'        =>['id']
    ];

    protected function mustIntegerParentId($value){
        if(is_numeric($value) && is_int($value + 0)){
            return true;
        }else{
            return false;
        }
    }

    protected function checkCommentId($value){
        $comment_model = new CommentModel();
        $comment = $comment_model::get($value);
        $user_id = session('uid');
        if($comment['uid']==$user_id){
            return true;
        }else{
            return false;
        }
    }

}