<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

// 引入 laravel-permission 模型
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); // isAdmin 中间件让具备指定权限的用户才能访问该资源

    }

    /**
     * 显示权限列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $permissions = Permission::all(); // 获取所有权限

        return view('admin.permissions.index')->with('permissions', $permissions);
    }

    /**
     * 显示创建权限表单
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::get(); // 获取所有角色

        return view('admin.permissions.create')->with('roles', $roles);
    }

    /**
     * 保存新创建的权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { // 如果选择了角色
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); // 将输入角色和数据库记录进行匹配

                $permission = Permission::where('name', '=', $name)->first(); // 将输入权限与数据库记录进行匹配
                $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'Permission'. $permission->name.' added!');

    }

    /**
     * 显示给定权限
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect('permissions');
    }

    /**
     * 显示编辑权限表单
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * 更新指定权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $permission->fill($input)->save();

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'Permission'. $permission->name.' updated!');

    }

    /**
     * 删除给定权限
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $permission = Permission::findOrFail($id);

        // 让特定权限无法删除
        if ($permission->name == "Administer roles & permissions") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'Permission deleted!');

    }
}