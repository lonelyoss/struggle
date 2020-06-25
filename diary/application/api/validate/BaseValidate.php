<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 17:27
 */

namespace app\api\validate;


use app\api\lib\exception\ParamsException;
use think\Request;
use think\Validate;
use app\api\model\Book;
use app\api\model\User as UserModel;
class BaseValidate extends Validate
{

    public function goCheck($scene = ''){
        //获取参数
        $request = Request::instance();
        $params = $request->param();
        //验证参数
        if($scene == ''){
            $validate = $this->batch()->check($params);
        }else{
            $validate = $this->batch()->scene($scene)->check($params);
        }

        if(!$validate){
            throw new ParamsException([
                'status'=>200,
                'msg'   => $this->error
            ]);
        }else{
            return true;
        }
    }


    protected function mustInteger($value){
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
            return true;
        }else{
            return false;
        }
    }

    protected function isEmpty($value){
        if(empty($value)){
            return false;
        }else{
            return true;
        }
    }

    protected function checkBookId($value){
        //获取日记本的ID
        $book_model = new Book();
        $book = $book_model->where('id','=',$value)->find();
        $uid = $book['uid'];
        $login_id = session('uid');
        if($uid!==$login_id){
            return false;
        }else{
            return true;
        }
    }


    protected function checkEmail($value){
        $user_model = new UserModel();
        $email = $user_model->where('email','=',$value)->find();
        if($email){
            return false;
        }else{
            return true;
        }
    }

    protected function checkNewPassword($value){
        $user_model = new UserModel();
        $password = $user_model->where('password','=',md5($value))->field('password')->find();
        if($password['password']==md5($value)){
            return false;
        }else{
            return true;
        }
    }
}