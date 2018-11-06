<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\ASP_NET;
use App\Http\Model\QaList;
use http\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ASP_NETController extends CommonController
{
    //
    //
    //get.admin/ASP_NET  问答对列表首页
    public function index()
    {
//        $ASP_NETs=(new ASP_NET)->tree();
//        return view('admin.ASP_NET.index')->with('data',$ASP_NETs);
        $data=ASP_NET::paginate(15);
//        print_r($data->links());
        return view('ASP_NET.index',compact('data'));
    }
    //get admin/ASP_NET/create 添加问答对
    public function create()
    {
        return view('ASP_NET/add');
    }
    //post.admin/ASP_NET 添加问答对提交
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
            $re=ASP_NET::create($input);
            if($re){
                return redirect('admin/ASP_NET');
            }else{
                back()->with('msg','数据填充失败，请稍后重试');
            }
        }
        else {

            return back()->withErrors($validator);
        }
    }

    //get  admin/ASP_NET/{ASP_NET} 展示问答对答案
    public function show($id)
    {
        $re=ASP_NET::find($id);
        return $re->answer;
    }
    //put  admin.ASP_NET.update
    public function update($id)
    {
        $input=Input::except('_token','_method');
        $re=ASP_NET::where('id',$id)->update($input);
        if($re){
            return redirect('admin/ASP_NET');
        }else{
            back()->with('msg','问答对更新失败，请稍后重试');
        }
    }
    //delete admin/ASP_NET/{ASP_NET}
    public function destroy($id)
    {
        $re=ASP_NET::where('id',$id)->delete();
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
    //get  admin.ASP_NET.edit
//    admin/ASP_NET/{ASP_NET}/edit
    public function edit($cate_id)
    {
        $field=ASP_NET::find($cate_id);
//        $data=ASP_NET::where('cate_pid',0)->get();
        return view('ASP_NET.edit',compact('field'));
    }

    public function ask($question)
    {

        unset($out);
        $ids="ASP_NET";
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
