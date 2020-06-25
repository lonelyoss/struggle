<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/18
 * Time: 11:26
 */

namespace app\api\controller\v1;


use app\api\lib\exception\SuccessMessage;
use app\api\validate\CheckID;
use app\api\model\Diary as DiaryModel;
use think\Request;
use app\api\lib\exception\DiaryException;
class Show
{
    public function get(Request $request){
        //验证数据
        (new CheckID())->goCHeck();
        //查询数据库
        $id = $request->param('id');
        $diary_model = new DiaryModel();
        $result = $diary_model->getOne($id);
        if(!$result){
            throw new DiaryException();
        }
        //返回结果
        return (new SuccessMessage([
            'data'  =>  $result
        ]))->success();

    }
}