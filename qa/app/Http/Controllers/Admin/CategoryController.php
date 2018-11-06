<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use http\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CategoryController extends CommonController
{
    //get.admin/category
    public function index()
    {
//        $categorys=(new Category)->tree();
//        return view('admin.category.index')->with('data',$categorys);
        $data=Category::paginate(5);
//        print_r($data->links());
        return view('admin.category.index',compact('data'));
    }
    //get admin/category/create 添加分类
    public function create()
    {
        $data=Category::where('cate_pid',0)->get();
        return view('admin/category/add',compact('data'));
    }
    //post.admin/category 添加分类提交
    public function store()
    {
        $input=Input::except('_token');
        $rules= [
            'cate_name'=>'required',
        ];
        $message=[
            'cate_name.required'=>'分类名称不能为空',
        ];
        $validator=Validator::make($_POST,$rules,$message);

        if($validator->passes())
        {
            $re=Category::create($input);
            if($re){
                return redirect('admin/category');
            }else{
                back()->with('msg','数据填充失败，请稍后重试');
            }
        }
        else {

            return back()->withErrors($validator);

        }
    }

    //get  admin/category/{category}
    public function show()
    {

    }
    //put  admin.category.update
    public function update($cate_id)
    {
        $input=Input::except('_token','_method');
        $re=Category::where('cate_id',$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }else{
            back()->with('msg','数据分类更新失败，请稍后重试');
        }
    }
    //delete admin/category/{category}
    public function destroy($cate_id)
    {
        $re=Category::where('cate_id',$cate_id)->delete();
       if($re){
           $data=[
               'status'=>0,
               'msg'=>'分类删除成功',
           ];
       }else{
           $data=[
               'status'=>1,
               'msg'=>'分类删除失败，请稍后重试',
           ];
       }
       return $data;
    }
    //get  admin.category.edit
//    admin/category/{category}/edit
    public function edit($cate_id)
    {
        $field=Category::find($cate_id);
        $data=Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','data'));
    }

    public function changeOrder()
    {
        $cate=Category::find($_POST['cate_id']);
        $cate->cate_order=$_POST['cate_order'];
        $re=$cate->save();
        if($re){
            $data=[
              'status'=>0,
                'msg'=>'分类排序更新成功'
            ];
        } else{
            $data=[
                'status'=>1,
                'msg'=>'分类排序更新失败，请稍后重试'
            ];
        }
        return $data;
    }
}
