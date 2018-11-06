@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 全部分类
    </div>
    <form action="#" method="post">

        <div class="result_wrap">
            <div class="result_title">
                <h3>分类管理</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
                    <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name=""></th>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>审核状态</th>
                        <th>点击</th>
                        <th>发布人</th>
                        <th>更新时间</th>
                        <th>评论</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_order}}">
                        </td>
                        <td class="tc">{{$v->cate_id}}</td>
                        <td>
                            <a href="#">{{$v->cate_name}}</a>
                        </td>
                        <td>0</td>
                        <td>2</td>
                        <td>admin</td>
                        <td>2014-03-15 21:11:01</td>
                        <td></td>
                        <td>
                            <a href="{{url('admin/category/'.$v->cate_id.')/edit')}}">修改</a>
                            <a href="javascript:" onclick="delCate({{$v->cate_id}})">删除</a>
                        </td>
                    </tr>

                    @endforeach
                    {{--<tr>--}}
                        {{--<td class="tc"><input type="checkbox" name="id[]" value="59"></td>--}}
                        {{--<td class="tc">--}}
                            {{--<input type="text" name="ord[]" value="0">--}}
                        {{--</td>--}}
                        {{--<td class="tc">59</td>--}}
                        {{--<td>--}}
                            {{--<a href="#">三星 SM-G5308W 白色 移动4G手机 双卡双待</a>--}}
                        {{--</td>--}}
                        {{--<td>0</td>--}}
                        {{--<td>2</td>--}}
                        {{--<td>admin</td>--}}
                        {{--<td>2014-03-15 21:11:01</td>--}}
                        {{--<td></td>--}}
                        {{--<td>--}}
                            {{--<a href="#">修改</a>--}}
                            {{--<a href="#">删除</a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td class="tc"><input type="checkbox" name="id[]" value="59"></td>--}}
                        {{--<td class="tc">--}}
                            {{--<input type="text" name="ord[]" value="0">--}}
                        {{--</td>--}}
                        {{--<td class="tc">59</td>--}}
                        {{--<td>--}}
                            {{--<a href="#">荣耀 6 (H60-L11) 3GB内存增强版 白色 移动4G手机</a>--}}
                        {{--</td>--}}
                        {{--<td>0</td>--}}
                        {{--<td>2</td>--}}
                        {{--<td>admin</td>--}}
                        {{--<td>2014-03-15 21:11:01</td>--}}
                        {{--<td></td>--}}
                        {{--<td>--}}
                            {{--<a href="#">修改</a>--}}
                            {{--<a href="#">删除</a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                </table>
                <div class="page_list">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>
        function changeOrder(obj,cate_id) {
            var cate_order=$(obj).val();
            $.post('{{url('admin/cate/changeorder')}}',{'_token':'{{csrf_token()}}','cate_id':cate_id,'cate_order':cate_order},function (data) {
                if(data.status==0){
                    layer.msg(data.msg, {icon: 6});
                }else{
                    layer.msg(data.msg, {icon: 5});
                }


            })
        }
        //删除分类
        function delCate(cate_id){
            layer.confirm('您确定要删除此分类吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/category/')}}/"+cate_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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