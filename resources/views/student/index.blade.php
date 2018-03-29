@extends('common.layouts')

@section('content')

    @include('common.message')
    <!-- 查询区域-->
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline">
                <div class="form-group">
                    <label for="inputName">姓名:</label>
                    <input type="text" class="form-control" id="inputName" name="search_name" value="{{$search_name or ""}}" placeholder="请输入">
                </div>
                <button type="submit" class="btn btn-default">查询</button>
            </form>
            @role('admin')
            <p>This is visible to users with the admin role. Gets translated to
                \Entrust::role('admin')</p>
            @endrole

            @permission('create-post')
            <p>This is visible to users with the given permissions. Gets translated to
                \Entrust::can('manage-admins'). The @ can directive is already taken by core
                laravel authorization package, hence the @ permission directive instead.</p>
            @endpermission

            @ability('admin,owner','create-post,edit-user')
            <p>This is visible to users with the given abilities. Gets translated to
                \Entrust::ability('admin,owner', 'create-post,edit-user')</p>
            @endability
        </div>
    </div>
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">学生列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>性别</th>
                <th>添加时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                    <td>{{ $student->sexTrans($student->sex) }}</td>
                    <td>{{ date('Y-m-d',strtotime($student->created_at))}}</td>
                    <td>
                        <a href="{{ url('student/detail', ['id' => $student->id])}}">详情</a>
                        <a href="{{ url('student/update', ['id' => $student->id])}}">修改</a>
                        <a href="{{ url('student/delete', ['id' => $student->id])}}"
                                onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                    </td>
                </tr>
                @endforeach
                @include('student.empty')
            </tbody>
        </table>
    </div>

    <!-- 分页  -->
    <div>
        <div class="pull-right">
            {{ $students->render() }}
        </div>

    </div>
@stop