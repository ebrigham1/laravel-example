<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Config;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of permissions.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        $permissions = $role->perms()->paginate(Config::get('perPage'));
        return view('roles.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        return view('roles.permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {
        //
    }

    /**
     * Display the specified permission.
     *
     * @param \App\Models\Role $role
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role, Permission $permission)
    {
        return view('roles.permissions.show', compact('role', 'permission'));
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param \App\Models\Role $role
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, Permission $permission)
    {
        return view('roles.permissions.edit', compact('role', 'permission'));
    }

    /**
     * Update the specified permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Role $role
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param \App\Models\Role $role
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, Permission $permission)
    {
        //
    }
}
