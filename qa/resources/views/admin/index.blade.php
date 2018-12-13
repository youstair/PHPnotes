@extends('layouts.admin')
		@section('content')

			<!--头部 开始-->
			<div class="top_box">
				<div class="top_left">
					<div class="logo">后台管理</div>
					<ul>
						<li><a href="#" class="active">首页</a></li>
						<li><a href="{{url('admin/qalist')}}">发起提问</a></li>
					</ul>
				</div>
				<div class="top_right">
					<ul>
						<li>管理员：admin</li>
						<li><a href="{{url('admin/pass')}}" target="main">修改密码</a></li>
						<li><a href="{{url('admin/quit')}}">退出</a></li>
					</ul>
				</div>
			</div>
			<!--头部 结束-->

			<!--左侧导航 开始-->
			<div class="menu_box">
				<ul>
					<li>
						<h3><i class="fa fa-fw fa-clipboard"></i>常用操作</h3>
						<ul class="sub_menu">
							<li><a href="{{url('admin/AddList')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加问答对</a></li>
							<li><a href="{{url('admin/AnswerList')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>问答对列表</a></li>
							{{--<li><a href="tab.html" target="main"><i class="fa fa-fw fa-list-alt"></i>tab页</a></li>--}}
							{{--<li><a href="img.html" target="main"><i class="fa fa-fw fa-image"></i>图片列表</a></li>--}}
						</ul>
					</li>
					{{--<li>--}}
						{{--<h3><i class="fa fa-fw fa-cog"></i>系统设置</h3>--}}
						{{--<ul class="sub_menu">--}}
							{{--<li><a href="#" target="main"><i class="fa fa-fw fa-cubes"></i>网站配置</a></li>--}}
							{{--<li><a href="#" target="main"><i class="fa fa-fw fa-database"></i>备份还原</a></li>--}}
						{{--</ul>--}}
					{{--</li>--}}
					<li>
						<h3><i class="fa fa-fw fa-thumb-tack"></i>问答对分类导航</h3>
						<ul class="sub_menu">
							<li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>WebService</a></li>
							<li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>ASP_NET</a></li>
							<li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>HTML_CSS</a></li>
							{{--<li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>JavaScript</a></li>--}}
							<li><a href="{{url('admin/JavaScript')}}"><i class="fa fa-fw fa-tags"></i>JavaScript</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<!--左侧导航 结束-->

			<!--主体部分 开始-->
			<div class="main_box">
				<iframe src="{{url('admin/home')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
			</div>
			<!--主体部分 结束-->

			<!--底部 开始-->
			<div class="bottom_box">
				CopyRight © 2015. Powered By <a href="http://www.houdunwang.com">http://www.houdunwang.com</a>.
			</div>
			<!--底部 结束-->

		@endsection
