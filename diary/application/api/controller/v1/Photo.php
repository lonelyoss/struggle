<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/22
 * Time: 18:07
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\controller\service\Photo as PhotoService;
use think\Request;

class Photo extends BaseController
{
    public function update(Request $request){
        $this->isLogin();
        $photo_service = new PhotoService();
        $photo_service->onLineUpdatePhoto($request);
    }
}