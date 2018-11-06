@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/index')}}">首页</a> &raquo; HTML_CSS全部问答对
    </div>
    <form action="#" method="post">

        <div class="result_wrap">
            <div class="result_title">
                <h3>问答对管理</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/HTML_CSS/create')}}"><i class="fa fa-plus"></i>添加问答对</a>
                    <a href="{{url('admin/HTML_CSS')}}"><i class="fa fa-recycle"></i>全部问答对</a>
                </div>
            </div>
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
                        <th>问题</th>
                        <th>具有格式的答案</th>
                        <th>来源</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        {{--<td class="tc"><input type="checkbox" name="id[]" value="59"></td>--}}
                        {{--<td class="tc">--}}
                            {{--<input type="text" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_order}}">--}}
                        {{--</td>--}}
                        <td class="tc">{{$v->id}}</td>
                        {{--<td>--}}
                            {{--<a href="#">{{$v->question}}</a>--}}
                        {{--</td>--}}
                        <td>{{$v->question}}</td>
                        <td>
                            <a href="{{url('admin/HTML_CSS/')}}/{{$v->id}}">点击获取答案</a>
                        </td>
                        {{--<td>--}}
                            {{--<a href="#">{{$v->link}}</a>--}}
                        {{--</td>--}}
                        <td>{{$v->link}}</td>
                        <td>
                            <a href="{{url('admin/HTML_CSS/'.$v->id.')/edit')}}">修改</a>
                            <a href="javascript:" onclick="delCate({{$v->id}})">删除</a>
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
    <!--搜索结果页面 列表 结束-->
    <script>
        //删除问答对
        function delCate(id){
            layer.confirm('您确定要删除此问答对吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/HTML_CSS/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if(data.status==0){
                        layer.msg(data.msg, {icon: 6});
                        location.href=location.href;

                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });

                // layer.msg('的确很重要', {icon: 1});
            }
            );

        }

    </script>
    <style>
        .result_content ul li span {
            padding: 6px 12px;
            font-size: 15px;
        }
    </style>
@endsection