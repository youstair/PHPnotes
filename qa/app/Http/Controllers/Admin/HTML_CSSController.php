<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\HTML_CSS;
use App\Http\Model\QaList;
use http\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class HTML_CSSController extends CommonController
{
    //
    //
    //get.admin/HTML_CSS  问答对列表首页
    public function index()
    {
//        $HTML_CSSs=(new HTML_CSS)->tree();
//        return view('admin.HTML_CSS.index')->with('data',$HTML_CSSs);
        $data=HTML_CSS::paginate(15);
//        print_r($data->links());
        return view('HTML_CSS.index',compact('data'));
    }
    //get admin/HTML_CSS/create 添加问答对
    public function create()
    {
        return view('HTML_CSS/add');
    }
    //post.admin/HTML_CSS 添加问答对提交
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
            $re=HTML_CSS::create($input);
            if($re){
                return redirect('admin/HTML_CSS');
            }else{
                back()->with('msg','数据填充失败，请稍后重试');
            }
        }
        else {

            return back()->withErrors($validator);
        }
    }

    //get  admin/HTML_CSS/{HTML_CSS} 展示问答对答案
    public function show($id)
    {
        $re=HTML_CSS::find($id);
        return $re->answer;
    }
    //put  admin.HTML_CSS.update
    public function update($id)
    {
        $input=Input::except('_token','_method');
        $re=HTML_CSS::where('id',$id)->update($input);
        if($re){
            return redirect('admin/HTML_CSS');
        }else{
            back()->with('msg','问答对更新失败，请稍后重试');
        }
    }
    //delete admin/HTML_CSS/{HTML_CSS}
    public function destroy($id)
    {
        $re=HTML_CSS::where('id',$id)->delete();
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
    //get  admin.HTML_CSS.edit
//    admin/HTML_CSS/{HTML_CSS}/edit
    public function edit($cate_id)
    {
        $field=HTML_CSS::find($cate_id);
//        $data=HTML_CSS::where('cate_pid',0)->get();
        return view('HTML_CSS.edit',compact('field'));
    }

    public function ask($question)
    {

        unset($out);
        $ids="HTML_CSS";
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
