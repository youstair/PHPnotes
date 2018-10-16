<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends CommonController
{
    //get.admin/category
    public function index()
    {
//        echo 'get.admin/category';
        $category=Category::all();
//        print_r($category);

        return view('admin.category.index')->with('data',$category);
    }
    //post.admin/category
    public function store()
    {

    }
    //get admin/category/create
    public function create()
    {

    }
    //get  admin/category/{category}
    public function show()
    {

    }
    //put  admin.category.update
    public function update()
    {

    }
    //delete admin.category.destroy
    public function destory()
    {

    }
    //get  admin.category.edit
    public function edit()
    {

    }

}
