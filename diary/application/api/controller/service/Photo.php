<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/22
 * Time: 18:08
 */

namespace app\api\controller\service;


use app\api\lib\exception\PhotoException;
use app\api\lib\exception\SuccessMessage;
use app\api\lib\exception\UserException;
use app\api\model\User as UserModel;
use app\api\validate\CheckPhoto;
use xss\HtmlXss;

class Photo
{
    public function onLineUpdatePhoto($request){
        (new CheckPhoto())->goCheck();
        $user_model = new UserModel();
        $user = $user_model::get(session('uid'));
        if($user['id']!=session('uid')){
            throw new UserException([
                'msg'=>'你没有权限'
            ]);
        }
        $photo_url = HtmlXss::xssClear($request->param('photo_url'));
        if($photo_url == ''){
            throw new PhotoException();
        }
        $user->save(['photo'=>$photo_url],['id'=>session('uid')]);
        throw new SuccessMessage();
    }
}