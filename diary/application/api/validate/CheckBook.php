<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 20:54
 */

namespace app\api\validate;


use app\api\model\Book;

class CheckBook extends BaseValidate
{
    protected $rule = [
        'book_name' => 'require|max:12|checkBook',
        'id'    =>'require|mustInteger|checkBookId|isEmpty'
    ];
    protected $message = [
        'book_name.require'=>'日记本名称不得为空',
        'book_name.max'=>'日记本名称不得超过12个字符',
        'book_name.checkBook'=>'日记本名称已存在',
        'id'    =>'这不是你的日记本'
    ];

    protected $scene = [
        'create'    =>['book_name'],
        'update'    =>['book_name'=>'require|max:12','id'],
        'delete'    =>['id']
    ];
    protected function checkBook($value){
        $book_model = new Book();
        $book = $book_model->where('book_name','=',$value)->find();
        if($book){
            return false;
        }else{
            return true;
        }
    }
}