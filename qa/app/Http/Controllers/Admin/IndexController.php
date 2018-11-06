<?php

namespace App\Http\Controllers\Admin;



//use Dotenv\Validator;
//对validator的命名空间进行修改
use Illuminate\Support\Facades\Validator;


//使用模型
use App\Http\Model\User;
use Illuminate\Database\Eloquent\Model ;
//使用crypt加密
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Psy\TabCompletion\Matcher\CommandsMatcher;

class IndexController extends CommonController
{
    public function index()
    {
//        $pdo=DB::connection()->getPdo();
//        var_dump($pdo);
//        $user=DB::table('user')->get();
//        var_dump($user);
        return view('admin.index');
    }
    public function info()
    {
        return view('admin.info');
    }
    //更改超级管理员密码
    public function pass()
    {

        if(!empty($_POST))
        {
            $rules= [
                'password_n'=>'required|between:6,20|confirmed',
            ];
            $message=[
                'password_n.required'=>'新密码不能为空',
                'password_n.between'=>'新密码必须在6到20位之间',
                'password_n.confirmed'=>'新密码和确认密码不一致',
            ];

            $validator=Validator::make($_POST,$rules,$message);

            if($validator->passes())
            {

                $user=User::first();
                $_password=Crypt::decrypt($user->user_pass);
//                $_password=$user->user_pass;
                if($_POST['password_o']==$_password)
                {
                    $tempstr=Crypt::encrypt($_POST['password_n']);

                    $user->user_pass=$tempstr;
                    $user->save();
                    return back()->with('errors','原密码修改成功');
//                    $tmpdestr=Crypt::decrypt($user->user_pass);
//                    echo "<h1>ok！</h1>";
//                    echo "<h1>$user->user_pass</h1>";
//                    echo "<h1>$tmpdestr</h1>";

                }
                else {
                    return back()->with('errors','原密码错误！');

                }
            }
            else {

                return back()->withErrors($validator);

            }
        }
        else
        {
            return view('admin.pass');
        }
    }
    //测试数据库内容
    public function test1()
    {
        $table='JavaScript';
        $re=DB::select("select question from $table where id=?",[2]);
        print_r($re);
    }

    public function home()
    {
        return view('homepage');
    }
}
