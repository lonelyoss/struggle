<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/24
 * Time: 11:42
 */

namespace app\api\controller\v1;


use app\api\controller\SendEmail;
use app\api\lib\exception\CodeException;
use app\api\lib\exception\EmailException;
use app\api\lib\exception\SuccessMessage;
use app\api\lib\exception\UserException;
use app\api\model\User as UserModel;
use app\api\validate\CheckCode;
use app\api\validate\CheckPassword;
use think\Cache;
use think\Request;

class GetPasswordBack
{
    /**
     * 生成验证码
     * @param Request $request
     * @throws EmailException
     * @throws SuccessMessage
     * @throws \think\Exception
     */
    public function createCode(Request $request){
        $params = $request->post();
        $to = $params['email'];
        $code = mt_rand(1000,9999);
        $subject = 'Struggle Diary 验证码';
        $body = "您的验证码为：{$code}，验证码有效期为5分钟";
        $send_email = SendEmail::send($to,$subject,$body);
        if(!$send_email){
            throw new EmailException([
                'msg'   =>'邮件发送失败，请重试',
                'errorCode'=>70001
            ]);
        }
        Cache::set($to,$code,300);
        session('email',$to);
        throw new SuccessMessage();
    }

    /**
     * 验证邮箱验证码
     * @param Request $request
     * @throws CodeException
     * @throws SuccessMessage
     * @throws \app\api\lib\exception\ParamsException
     * @throws \think\Exception
     */
    public function checkCode(Request $request){
        (new CheckCode())->goCheck();
        $params = $request->delete();
        $email = session('email');
        $code = $params['code'];
        $cache_code = Cache::get($email);
        if(!$cache_code){
            throw new CodeException();
        }
        if($cache_code!=$code){
            throw new CodeException();
        }
        Cache::rm($email);
        throw new SuccessMessage();
    }

    /**
     * 更改密码
     * @param Request $request
     * @throws SuccessMessage
     * @throws UserException
     * @throws \app\api\lib\exception\ParamsException
     * @throws \think\Exception
     */
    public function update(Request $request){
        (new CheckPassword())->goCheck('find');
        $params = $request->put();
        $email = session('email');
        $user_model = new UserModel();
        $update = $user_model->save(['password'=>md5($params['newpassword'])],['email'=>$email]);
        if(!$update){
            throw new UserException([
                'msg'=>'修改密码失败，请重试',
                'errorCode'=>80001
            ]);
        }
        throw new SuccessMessage();
    }




}