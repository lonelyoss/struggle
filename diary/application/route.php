<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];*/
//
//
use think\Route;
//登录
Route::post('api/:version/register','app/api/:version.Register/create');
//注册
Route::post('api/:version/login','app/api/:version.Login/login');

//日记本
Route::get('api/:version/book/:id','app/api/:version.Book/get');

Route::post('api/:version/book','app/api/:version.Book/create');

Route::put('api/:version/book/:id','app/api/:version.Book/update');

Route::delete('api/:version/book/:id','app/api/:version.Book/delete');
//写日记
Route::post('api/:version/diary','app/api/:version.Diary/create');

Route::put('api/:version/diary/:id','app/api/:version.Diary/update');

Route::delete('api/:version/diary/:id','app/api/:version.Diary/delete');

Route::get('api/:version/diary/:id','app/api/:version.Diary/get');

//首页
Route::get('api/:version/home','app/api/:version.Home/get');

//日记文章展示
Route::get('api/:version/show/:id','app/api/:version.Show/get');

//用户中心
Route::get('api/:version/user/:id','app/api/:version.User/get');

//用户信息
Route::put('api/:version/userInfo','app/api/:version.UserInfo/create');

Route::get('api/:version/userInfo/:id','app/api/:version.UserInfo/get');

//日记评论
Route::get('api/:version/comment/:id','app/api/:version.Comment/get');

Route::post('api/:version/comment/:id','app/api/:version.Comment/create');

Route::delete('api/:version/comment/:id','app/api/:version.Comment/delete');

//用户头像更新

Route::put('api/:version/photo','app/api/:version.Photo/update');

//电子邮箱
Route::put('api/:version/email','app/api/:version.Email/update');

//修改密码
Route::put('api/:version/passwordModify','app/api/:version.PasswordModify/update');

//找回密码
Route::delete('api/:version/passwordFind','app/api/:version.GetPasswordBack/checkCode');

Route::post('api/:version/passwordFind','app/api/:version.GetPasswordBack/createCode');

Route::put('api/:version/passwordFind','app/api/:version.GetPasswordBack/update');