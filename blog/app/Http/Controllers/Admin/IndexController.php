<?php

namespace App\Http\Controllers\Admin;

use Dotenv\Validator;
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
                'password'=>'required',
            ];
            $validator=Validator::make($_POST,$rules);
            if($validator->passes())
            {
                echo '<h1>ok!</h1>';
            }
            else
            {
                echo '<h1>no!</h1>';

            }
        }
        else
        {
            return view('admin.pass');
        }
    }
}
