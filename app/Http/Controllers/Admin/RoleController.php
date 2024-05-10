<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(RoleStoreRequest $request)
    {
        Role::create($request->validated());

        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit',[
            'role' => $role
        ]);
    }

    public function update(RoleStoreRequest $request, Role $role)
    {
        $role->update($request->validated());

        return to_route('admin.roles.index');
    }
}
