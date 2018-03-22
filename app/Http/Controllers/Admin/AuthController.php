<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/admin';//登录成功后跳转路由
    protected $guard = 'admin';//看守
    protected $loginView = 'admin.login';//登录页面
    protected $registerView = 'admin.register';//注册页面
    protected $redirectAfterLogout = '/admin/login';//退出后跳转路由


    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|confirmed|min:6',
        ]);

    }

    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }

}