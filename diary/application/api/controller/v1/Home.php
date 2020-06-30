<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 23:41
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\lib\exception\DiaryException;
use app\api\lib\exception\SuccessMessage;
use app\api\model\Diary as DiaryModel;
class Home extends BaseController
{
    public function get(){
        $diary_model = new DiaryModel;
        $result = $diary_model->getAll();
        if((!$result) && (!empty($result))){
            throw new DiaryException();
        }
        return json($result,200);
    }
}