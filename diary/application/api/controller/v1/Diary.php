<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 21:25
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\lib\exception\DiaryException;
use app\api\lib\exception\ParamsException;
use app\api\lib\exception\SuccessMessage;
use app\api\model\Diary as DiaryModel;
use app\api\validate\CheckDiary;
use app\api\validate\CheckDiaryID;
use think\Request;
use xss\HtmlXss;

class Diary extends BaseController
{
    public function create(Request $request){
        $this->isLogin();
        (new CheckDiary())->goCheck('create');
        $params = $request->post();
        $this->commonAdd($params);
    }

    public function update(){
        $this->isLogin();
        (new CheckDiary())->goCheck('update');
        $request = Request::instance();
        $params = $request->put();
        $this->commonAdd($params,$request->param('id'));
    }

    public function delete(Request $request){
        $this->isLogin();
        (new CheckDiary())->goCheck('delete');
        $diary_id = $request->param('id');
        $diary_model = new DiaryModel();
        $diary = $diary_model->get($diary_id);
        $diary->delete();
        throw new SuccessMessage();
    }

    public function get(Request $request){
        $this->isLogin();
        (new CheckDiary())->goCheck('get');
        $diary_model = new DiaryModel();
        $diary = $diary_model->with('book')
            ->where('id','=',$request->param('id'))->find();
        if(!$diary){
            throw new DiaryException();
        }
        return json($diary,200);
    }

    private function commonAdd($params,$id=0){

        $uid = $this->getUid();
        $params['content'] = htmlspecialchars(HtmlXss::xssClear($params['content']));
        if($params['content']==''){
            throw new ParamsException([
                'msg'   => '正文内容不得为空'
            ]);
        }
        $diary_model = new DiaryModel();
        if($id == 0){
            $diary_model->save(['uid'=>$uid,'book_id'=>$params['book_id'],'content'=>$params['content']]);
        }else{
            $diary_model->save(['uid'=>$uid,'book_id'=>$params['book_id'],'content'=>$params['content']],['id'=>$id]);
        }
        throw new SuccessMessage();

    }


}