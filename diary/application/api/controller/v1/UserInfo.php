<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/19
 * Time: 18:37
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\lib\exception\UserException;
use app\api\validate\CheckUserCode;
use app\api\validate\CheckUserInfo;
use think\Request;
use app\api\model\UserInfo as UserInfoModel;
use app\api\model\User as UserModel;
use app\api\controller\service\UserInfo as UserInfoService;
class UserInfo extends BaseController
{
    public function create(Request $request){
        $this->isLogin();
        (new CheckUserInfo())->goCheck();
        $params = $request->param();
        $user_info_model = new UserInfoModel();
        $user_info = $user_info_model->where('uid','=',$this->getUid())->find();
        $user_info_service = new UserInfoService();
        if($user_info){
            $user_info_service->commonSave($params,$this->getUid(),1);
        }else{
            $user_info_service->commonSave($params,$this->getUid());
        }

    }

    public function get(Request $request){
        (new CheckUserCode())->goCheck();
        $uid = $request->param('id');
        $user_model = new UserModel;
        $result = $user_model->getUserInfo($uid);
        if(!$result && empty($request)){
            throw new UserException();
        }
        return json($result,200);
    }



}