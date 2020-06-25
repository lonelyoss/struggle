<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/20
 * Time: 22:28
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\lib\exception\CommentException;
use app\api\lib\exception\DiaryException;
use app\api\lib\exception\SuccessMessage;
use app\api\model\Comment as CommentModel;
use app\api\model\Diary as DiaryModel;
use app\api\validate\CheckComment;
use app\api\validate\CheckCommentId;
use app\api\validate\CheckID;
use think\Request;
use xss\HtmlXss;
class Comment extends BaseController
{
    public function create(Request $request){
        $this->isLogin();
        $params = $request->param();
        $diary_model = new DiaryModel();
        $diary = $diary_model::get($params['id']);
        if(!$diary){
            throw new DiaryException([
                'msg'=>'日记不存在',
            ]);
        }
        (new CheckComment())->goCheck('create');
        if(!array_key_exists('parent_id',$params)){
            $parent_id = 0;
        }else{
            $parent_id = $params['parent_id'];
        }
        $diary_id = $params['id'];
        $user_id = $this->getUid();
        $content = htmlspecialchars(HtmlXss::xssClear($params['content']));
        $comment_model = new CommentModel();
        $comment_model->save(['uid'=>$user_id,'diary_id'=>$diary_id,'parent_id'=>$parent_id,'content'=>$content]);
        throw new SuccessMessage();
    }

    public function delete(Request $request){
        $this->isLogin();
        (new CheckComment())->goCheck('delete');
        $comment_id = $request->param('id');
        $comment_model = new CommentModel();
        $comment = $comment_model::get($comment_id);
        $comment->delete();
        throw new SuccessMessage();
    }

    public function get(){
        (new CheckID())->goCheck();
        $comment = $this->getComment();
        if(!$comment){
            throw new CommentException();
        }
        return (new SuccessMessage([
            'data'=>$comment
        ]))->success();
    }

    private function getComment($parent_id = 0,&$result = []){
        $request = Request::instance();
        $params = $request->param();
        $comment_model = new CommentModel();
        $comment = $comment_model->getCommentByDiaryId($parent_id,$params['id']);
        if(!$comment){
            return [];
        }

        foreach($comment as $cm){
            $thisArr = &$result[];
            $comment_list = $this->getComment($cm['id'],$thisArr);
            $cm['children'] = $comment_list;
            $thisArr = $cm;
        }
        return $result;
    }



}