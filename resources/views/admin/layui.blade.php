<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('static/layui/css/layui.css')}}"  media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<table class="layui-table" lay-data="{url:'/static/layui/json/table1.json', page: true, limit: 6, limits:[6]}">
    <thead>
    <tr>
        <th lay-data="{checkbox:true}" rowspan="2"></th>
        <th lay-data="{field:'username', width:150}" rowspan="2">联系人</th>
        <th lay-data="{align:'center'}" colspan="2">地址</th>
        <th lay-data="{field:'amount', width:150}" rowspan="2">金额</th>
		<th lay-data="{width: 150, align: 'center', toolbar: '#barDemo'}" rowspan="2">操作</th>

    </tr>
    <tr>
        <th lay-data="{field:'province',align:'center',width:100}">省</th>
    </tr>
    </thead>
</table>

常用两级表头：

<table class="layui-table" lay-data="{width:800, url:'/static/layui/json/table1.json', page: true, limit: 6, limits:[6]}">
    <thead>
    <tr>
        <th lay-data="{checkbox:true, fixed:'left'}" rowspan="2"></th>
        <th lay-data="{field:'username', width:150}" rowspan="2">联系人</th>
        <th lay-data="{align:'center'}" colspan="3">地址</th>
        <th lay-data="{field:'amount', width:120}" rowspan="2">金额</th>
        <th lay-data="{fixed: 'right', width: 160, align: 'center', toolbar: '#barDemo'}" rowspan="2">操作</th>
    </tr>
    <tr>
        <th lay-data="{field:'province', width:120}">省</th>
        <th lay-data="{field:'city', width:120}">市</th>
        <th lay-data="{field:'zone', width:200}">区</th>
    </tr>
    </thead>
</table>

更多级表头（可以无限极）：

<table class="layui-table" lay-data="{url:'/static/layui/json/table2.json', cellMinWidth: 80, page: true}">
    <thead>
    <tr>
        <th lay-data="{field:'username', width:80}" rowspan="3">联系人</th>
        <th lay-data="{field:'amount', width:120}" rowspan="3">金额</th>
        <th lay-data="{align:'center'}" colspan="5">地址1</th>
        <th lay-data="{align:'center'}" colspan="2">地址2</th>
        <th lay-data="{width: 160, align: 'center', toolbar: '#barDemo'}" rowspan="3">操作</th>
    </tr>
    <tr>
        <th lay-data="{field:'province'}" rowspan="2">省</th>
        <th lay-data="{field:'city'}" rowspan="2">市</th>
        <th lay-data="{align:'center'}" colspan="3">详细</th>
        <th lay-data="{field:'province'}" rowspan="2">省</th>
        <th lay-data="{field:'city'}" rowspan="2">市</th>
    </tr>
    <tr>
        <th lay-data="{field:'street'}" rowspan="2">街道</th>
        <th lay-data="{field:'address'}">小区</th>
        <th lay-data="{field:'house'}">单元</th>
    </tr>
    </thead>
</table>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">按钮1</a>
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">按钮2</a>
</script>
<p style="color: #999">注：上述例子读取的均是静态模拟数据</p>


<script src="{{asset('static/layui/layui.all.js')}}" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use('table', function(){
        var table = layui.table;

    });
</script>

</body>
</html>