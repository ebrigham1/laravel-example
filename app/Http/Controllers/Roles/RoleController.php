<?php

namespace App\Http\Controllers\Roles;

use App\Events\UsersAttachedToRole;
use App\Events\UserDetachedFromRole;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Auth;
use Config;
use Illuminate\Http\Request;
use Response;
use Session;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('display_name')->paginate(Config::get('app.perPage'));
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the new role
        $this->validate($request, [
            'name' => 'required|unique:roles|max:255',
        ]);
        // Store the new role
        $role = Role::create($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully created role "' . $role->display_name . '"');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified role.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // Validate the new role
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);
        // Update the role
        $role->update($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully updated role "' . $role->display_name . '"');
        return redirect()->route('roles.show', ['role' => $role]);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // Delete the role
        $role->delete();
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully deleted role "' . $role->display_name . '"');
        return redirect()->route('roles.index');
    }

    /**
     * Show the users added to this role
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users(Role $role)
    {
        $users = $role->users()->orderBy('name')->paginate(Config::get('app.perPage'));
        return view('roles.users', compact('role', 'users'));
    }

    /**
     * Get users not in a role that match the term given
     *
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function usersNotInRoleAjax(Request $request, Role $role)
    {
        // Hardcoding 30 for pagination here as we are using endless scrolling on the other end
        // in app.js
        $users = User::whereNotIn('id', $request->input('notUsers', []))
            ->whereDoesntHave('roles', function ($query) use ($role) {
                $query->where('id', '=', $role->id);
            })->where('name', 'like', '%' . $request->input('term') . '%')->orderBy('name')->paginate(30);
        return Response::json($users);
    }

    /**
     * Attach a user to a role
     *
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRoleUsers(Request $request, Role $role)
    {
        // Validate the new user_role
        $this->validate($request, [
            'users' => 'required|array|min:1',
        ]);
        // Attach the new users to the role
        $role->users()->attach($request->input('users'));
        // Get usernames to report back
        $users = User::whereIn('id', $request->input('users'))->orderBy('name', 'asc')->get();
        // Redirect and let the user know of the success
        Session::flash(
            'success',
            'Successfully attached user(s) "'
            . $users->implode('name', ', ') . '" to role "' . $role->display_name . '"'
        );
        // Fire event
        event(new UsersAttachedToRole(Auth::user(), $users, $role));
        return redirect()->route('roles.users', ['role' => $role]);
    }

    /**
     * Remove the user from the role
     *
     * @param Request $request
     * @param Role $role
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyRoleUser(Request $request, Role $role, User $user)
    {
        // Delete the role user
        $role->users()->detach($user);
        // Redirect and let the user know of the success
        Session::flash(
            'success',
            'Successfully removed user "' . $user->name . '" from role "' . $role->display_name . '"'
        );
        // Fire event
        event(new UserDetachedFromRole(Auth::user(), $user, $role));
        return redirect()->route('roles.users', ['role' => $role]);
    }
}
