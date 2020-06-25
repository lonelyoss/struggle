<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 20:52
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\lib\exception\BookException;
use app\api\lib\exception\SuccessMessage;
use app\api\model\Book as BookModel;
use app\api\validate\CheckBook;
use app\api\validate\CheckBookID;
use app\api\validate\CheckID;
use think\Request;
class Book extends BaseController
{
    public function create(Request $request){
        $this->isLogin();
        //验证数据
        (new CheckBook())->goCheck('create');
        //写入数据库
        $book_model = new BookModel();
        $params = $request->post();
        $book_name = $params['book_name'];
        $uid = $this->getUid();
        $book_model->allowField(true)->save(['uid'=>$uid,'book_name'=>$book_name]);
        //返回结果
        throw new SuccessMessage();
    }

    public function update(Request $request){
        //验证是否登录
        $this->isLogin();
        //验证
        (new CheckBook())->goCheck('update');
        //更新日记本
        $book_name = $request->param('book_name');
        $book_id = $request->param('id');
        $book_model = new BookModel();
        $book_model::update(['book_name'=>$book_name],['id'=>$book_id,'uid'=>$this->getUid()]);
        throw new SuccessMessage([
            'msg'   =>'编辑日记本成功'
        ]);
    }

    public function get(Request $request){
        (new CheckID())->goCheck();
        $book_model = new BookModel();
        $book = $book_model->getBookByUserId($request->param('id'));
        if(!$book){
            throw new BookException();
        }
        return (new SuccessMessage([
            'data'=>$book,
        ]))->success();
    }

    public function delete(Request $request){
        $this->isLogin();
        (new CheckBook())->goCheck('delete');
        $book = BookModel::get($request->param('id'));
        if(!$book){
            throw new BookException();
        }
        $book->delete();
        throw new SuccessMessage();
    }
}