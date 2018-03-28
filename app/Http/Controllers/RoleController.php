<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Permission;
use Entrust;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('name', '=', 'chaishuliang')->first();

        dump("角色列表");
        dump(Auth::user());

        //如果用户拥有以上任意一个角色或权限都会返回true，如果你想检查用户是否拥有所有角色及权限，可以传递true作为第二个参数到相应方法
        dump($user->hasRole(['owner', 'admin'],true));

        dump(Entrust::hasRole('owner'));//Entrust门面检查当前登录用户是否拥有指定角色和权限
        dump(Entrust::hasRole('admin'));

        dump(Entrust::can('create-post'));
        dump(Entrust::can('edit-user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owner = new Role();
        $owner->name         = 'owner';
        $owner->display_name = 'Project Owner'; // optional
        $owner->description  = 'User is the owner of a given project'; // optional
        $owner->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description  = 'User is allowed to manage and edit other users'; // optional
        $admin->save();

        $user = User::where('name', '=', 'chaishuliang')->first();

        //角色
        //调用EntrustUserTrait提供的attachRole方法
        $user->attachRole($admin); // parameter can be an Role object, array, or id

        //权限
        $createPost = new Permission();
        $createPost->name = 'create-post';
        $createPost->display_name = 'Create Posts';
        $createPost->description = 'create new blog posts';
        $createPost->save();

        $editUser = new Permission();
        $editUser->name = 'edit-user';
        $editUser->display_name = 'Edit Users';
        $editUser->description = 'edit existing users';
        $editUser->save();

        $owner->attachPermission($createPost);
        //等价于 $owner->perms()->sync(array($createPost->id));

        $admin->attachPermissions(array($createPost, $editUser));
        //等价于 $admin->perms()->sync(array($createPost->id, $editUser->id));

        Log::info([$user->hasRole('owner'),$user->hasRole('admin'),$user->can('edit-user'),$user->can('create-post')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
