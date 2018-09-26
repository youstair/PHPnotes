<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
        if(!empty($_POST))
        {
            $code=new \Code;
            $_code=$code->get();
            if(strtoupper($_POST['code'])!=$_code) return back()->with('msg','验证码错误');
//            else echo 'ok!';
            $user=User::first();
            if($user->user_name!=$_POST['user_name']||Crypt::decrypt($user->user_pass)!=$_POST['user_password'])
            {
                return back()->with('msg','用户名或密码错误');
            }
            session(['user'=>$user]);
            //print_r(session('user'));
            return redirect('admin/index');
        }
        else
        {
            return view('admin.login');
        }
//        else
//        {
//            $user=User::first();
//            print_r($user);
//        }
//        return view('admin.login');
    }

    public function code()
    {
        $code = new \Code;
        $code->make();
    }

    public function getcode()
    {
        $code = new \Code;
        echo $code->get();
    }

    public function crypt()
    {
        $str='123456';
        $str_p='eyJpdiI6IjFMdjdZdzdlbllBQnNuekUzUUJOalE9PSIsInZhbHVlIjoidVJIZHh0Wk13MU1NdGlDQTVsTXRMUT09IiwibWFjIjoiMWU0MDdkMjk1NGU1ZTlmYjMwY2Y1YTA5YzY5ZjZjM2YwOWE3NDM0NTRkZWI3ZGQ3MWY2NzIxNzYwMzE5ZDY1ZiJ9';

        echo Crypt::decrypt($str_p);
    }

    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }
}
