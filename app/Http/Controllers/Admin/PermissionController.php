<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', [
            'permissions' => $permissions
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
        return view('admin.permissions.edit',[
            'permission' => $permission
        ]);
    }

    public function update(PermissionStoreRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return to_route('admin.permissions.index');
    }
}
