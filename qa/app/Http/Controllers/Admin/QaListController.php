<?php

namespace App\Http\Controllers\Admin;


use App\Http\Model\QaList;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class QaListController extends CommonController
{
    //get.admin/qalist  展示分类列表
    public function index()
    {
//        $qalists=(new qalist)->tree();
//        return view('admin.qalist.index')->with('data',$qalists);
        $data=QaList::all();
//        print_r($data->links());
        return view('admin.ask',compact('data'));
    }

    //get  admin/qalist/{qalist} 展示提问结果
    public function show($qalist)
    {
        $input=Input::except('_token');
        unset($out);
        $ids=$input['table_id'];
        $idt=$input['question'];
        $c=exec("PYTHONIOENCODING=utf-8 /usr/bin/python3 /home/youstair/PycharmProjects/runoob_db/venv/core_model.py $ids $idt",$out,$res);

        var_dump($c);
        echo '</br>';

        var_dump($out);

        echo '</br>';
        var_dump($res);
    }
    //get.admin/qalist  展示分类列表
    public function AnswerList()
    {
//        $webservices=(new webservice)->tree();
//        return view('admin.webservice.index')->with('data',$webservices);
        $data=QaList::paginate(15);
//        print_r($data->links());
        return view('QaList.index',compact('data'));
    }
    public function AddList()
    {
//        $webservices=(new webservice)->tree();
//        return view('admin.webservice.index')->with('data',$webservices);
        $data=QaList::paginate(15);
//        print_r($data->links());
        return view('QaList.AddList',compact('data'));
    }
}
