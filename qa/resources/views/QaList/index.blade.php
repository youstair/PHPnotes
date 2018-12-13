@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    {{--<div class="crumb_warp">--}}
        {{--<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->--}}
        {{--<i class="fa fa-home"></i> <a href="{{url('admin/index')}}">首页</a> &raquo; WebService全部问答对--}}
    {{--</div>--}}
    <form action="#" method="post">

        <div class="result_wrap">
            <div class="result_title">
                <h3>问答对管理</h3>
            </div>
            <!--快捷导航 开始-->
            {{--<div class="result_content">--}}
                {{--<div class="short_wrap">--}}
                    {{--<a href="{{url('admin/webservice/create')}}"><i class="fa fa-plus"></i>添加问答对</a>--}}
                    {{--<a href="{{url('admin/webservice')}}"><i class="fa fa-recycle"></i>全部问答对</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            <!--快捷导航 结束-->
        </div>
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        {{--<th class="tc" width="5%"><input type="checkbox" name=""></th>--}}
                        {{--<th class="tc">排序</th>--}}
                        {{--<th class="tc">ID</th>--}}
                        {{--<th>标题</th>--}}
                        {{--<th>审核状态</th>--}}
                        <th class="tc">ID</th>
                        <th>问题类型</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        {{--<td class="tc"><input type="checkbox" name="id[]" value="59"></td>--}}
                        {{--<td class="tc">--}}
                            {{--<input type="text" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_order}}">--}}
                        {{--</td>--}}
                        <td class="tc">{{$v->cate_id}}</td>
                        <td>
                            <a href="{{url('admin/')}}/{{$v->cate_name}}">{{$v->cate_name}}  点击跳转</a>
                        </td>
                    </tr>

                    @endforeach

                </table>
                <div class="page_list">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <style>
        .result_content ul li span {
            padding: 6px 12px;
            font-size: 15px;
        }
    </style>
@endsection