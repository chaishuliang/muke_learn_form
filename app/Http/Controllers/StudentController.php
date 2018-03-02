<?php

namespace App\Http\Controllers;


use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    // 学生列表页
    public function index(Request $request)
    {
        $students = Student::where('name','like','%'.$request->input('search_name').'%')->paginate(10);

        if($students->lastPage() <  $request->input('page')){
            return redirect('student/index')->with(['students' => $students]);
        }

        if($request->has('search_name')){
            $students->appends(['search_name'=>$request->input('search_name')]);
        }

        return view('student.index', [
            'students' => $students,
            'search_name' => $request->input('search_name')
        ]);
    }

    // 添加页面
    public function create(Request $request)
    {
        $student = new Student();
        if ($request->isMethod('POST')) {

            // 1. 控制器验证

            /*$this->validate($request, [
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);*/

            // 2. Validator类验证
            $validator = Validator::make($request->input(), [
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            if ($validator->fails()) {
                //withErrors 是传递验证错误信息,存一次性session
                //withInput 是传递输入的信息
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $data = $request->input('Student');

            if (Student::create($data) ) {
                return redirect('student/index')->with('success', '添加成功!');
            } else {
                return redirect()->back();
            }
        }

        return view('student.create', [
            'student' => $student
        ]);
    }

    // 保存添加
    public function save(Request $request)
    {
        $data = $request->input('Student');

        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if ($student->save()) {
            return redirect('student/index');
        } else {
            return redirect()->back();
        }

    }



    public function update(Request $request, $id)
    {
        //修改成功后返回当前数据页
        if($request->isMethod('GET')){
           Session::put('_preUrl',strpos(Session::get('_previous.url'),'student/index')!==false ? Session::get('_previous.url') : 'student/index');
        }

        $student = Student::find($id);

        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            $data = $request->input('Student');
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];
            if ($student->save()) {
                return redirect(Session::get('_preUrl'))->with('success','修改成功-' . $id);
            }
        }
        return view('student.update', [
            'student' => $student
        ]);
    }



    public function detail($id)
    {
        $student = Student::find($id);

        return view('student.detail', [
            'student' => $student
        ]);
    }


    public function delete(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student->delete()) {
            return redirect('student/index')->with('success', '删除成功-' . $id);
        } else {
            return redirect('student/index')->with('error', '删除失败-' . $id);
        }
    }


}