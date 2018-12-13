<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\JavaScript;
use App\Http\Model\QaList;
use http\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class JavaScriptController extends CommonController
{
    //
    //get.admin/JavaScript  问答对列表首页
    public function index()
    {
//        $JavaScripts=(new JavaScript)->tree();
//        return view('admin.JavaScript.index')->with('data',$JavaScripts);
        $data=JavaScript::paginate(15);
//        print_r($data->links());
        return view('JavaScript.index',compact('data'));
    }
    //get admin/JavaScript/create 添加问答对
    public function create()
    {
        return view('JavaScript/add');
    }
    //post.admin/JavaScript 添加问答对提交
    public function store()
    {
        $input=Input::except('_token');
        $rules= [
//            'cate_name'=>'required',
            'question'=>'required',
            'answer'=>'required',
            'link'=>'required'
        ];
        $message=[
//            'cate_name.required'=>'问答对名称不能为空',
            'question.required'=>'问题不能为空',
            'answer.required'=>'答案不能为空',
            'link.required'=>'链接不能为空',
        ];
        $validator=Validator::make($_POST,$rules,$message);

        if($validator->passes())
        {
            $re=JavaScript::create($input);
            if($re){
                return redirect('admin/JavaScript');
            }else{
                back()->with('msg','数据填充失败，请稍后重试');
            }
        }
        else {

            return back()->withErrors($validator);
        }
    }

    //get  admin/JavaScript/{JavaScript} 展示问答对答案
    public function show($id)
    {
        $re=JavaScript::find($id);
        return $re->answer;
    }
    //put  admin.JavaScript.update
    public function update($id)
    {
        $input=Input::except('_token','_method');
        $re=JavaScript::where('id',$id)->update($input);
        if($re){
            return redirect('admin/JavaScript');
        }else{
            back()->with('msg','问答对更新失败，请稍后重试');
        }
    }
    //delete admin/JavaScript/{JavaScript}
    public function destroy($id)
    {
        $re=JavaScript::where('id',$id)->delete();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'问答对删除成功',
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'问答对删除失败，请稍后重试',
            ];
        }
        return $data;
    }
    //get  admin.JavaScript.edit
//    admin/JavaScript/{JavaScript}/edit
    public function edit($cate_id)
    {
        $field=JavaScript::find($cate_id);
//        $data=JavaScript::where('cate_pid',0)->get();
        return view('JavaScript.edit',compact('field'));
    }
///var/www/html/youstair.com/qa
    public function ask($question)
    {

        unset($out);
        $ids="JavaScript";
        $idt=$question;
//$c=exec("/usr/bin/python3 ".$dir."/qa/core_model/core1.py {$id} {$ids}",$out,$res);
        $c=exec("PYTHONIOENCODING=utf-8 /usr/bin/python3 /home/youstair/PycharmProjects/runoob_db/venv/core_model.py $ids $idt",$out,$res);

        $ppp=($out);
        var_dump($c);
        echo '</br>';

        var_dump($out);

        echo '</br>';
        var_dump($res);
    }
}
