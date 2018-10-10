<?php

namespace App\Http\Controllers\Admin;



//use Dotenv\Validator;
//对validator的命名空间进行修改
use Illuminate\Support\Facades\Validator;

//使用模型
use App\Http\Model\User;
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
                'password'=>'required|between:6,20|confirmed',
            ];
            $message=[
                'password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须在6到20位之间',
                'password.confirmed'=>'新密码和确认密码不一致',
            ];

            $validator=Validator::make($_POST,$rules,$message);

            if($validator->passes())
            {

                $user=User::first();
//                $_password=Crypt::decrypt($user->user_pass);
                $_password=$user->user_pass;
                if($_POST['password_o']==$_password)
                {
//                    $tempstr=Crypt::encrypt($_POST['password']);
//                    $user->user_pass=$tempstr;
                    $user->user_pass=$_POST['password'];
                    echo "<h1>ok！</h1>";
                    $user->save();
                    print_r($user->save());

//                    if($user->user_pass=$_password)
//                    {
//                        echo "<h1>密码重置成功！</h1>";
//                        echo "<h1>$_password</h1>";
//                    }
                }
                else {
                    return back()->with('errors','原密码错误！');

                }
                //echo "<h1>$_password</h1>";
            }
            else {
//                echo '<h1>no!</h1>';
//                var_dump($validator->errors()->all());
                return back()->withErrors($validator);

            }
        }
        else
        {
            return view('admin.pass');
        }
    }
    public function test1()
    {
        $user=User::first();
        $_password=$user->user_pass;
        $_pst=Crypt::encrypt($_password);
//        $_password=Crypt::decrypt($user->user_pass);
//        $_password=Crypt::decrypt('eyJpdiI6IlNQa3IyXC82WWZ2STAxOFdESGttb1NBPT0iLCJ2YWx1ZSI6IlwveGFSdU9NXC9DNFByQlJPMXNUaVNZUT09IiwibWFjIjoiMjIwODg4MGE1MzZmZDgyMWIyYTkyM2I1NWE0MDAxMjRiNDE0ZTQwYWEwZDU5MDQ0N2UyNmQ4M2ViZDlmNDU1NiJ9');
        echo "<h1>$_password</h1>";
        echo "<h1>$_pst</h1>";
    }
}
