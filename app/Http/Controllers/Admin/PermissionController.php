<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(PermissionStoreRequest $request)
    {
        Permission::create($request->validated());

        return to_route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();

        return view('admin.permissions.edit', [
            'permission' => $permission,
            'roles' => $roles,
        ]);
    }

    public function update(PermissionStoreRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return to_route('admin.permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('message', 'Permission deleted successfully');
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $permission->assignRole($request->role);

        return back()->with('message', 'Role Assigned');
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);

            return back()->with('message', 'role removed');
        }

        return back()->with('message', 'role exists');
    }
}
