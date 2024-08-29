<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view user', only: ['index']),
            new Middleware('permission:create user', only: ['create','store']),
            new Middleware('permission:update user', ['only' => ['update','edit']]),
            new Middleware('permission:delete user', ['only' => ['destroy']]),
            
        ];
    }
    

    public function index()
    {
        $users = User::get();
        return view('role-permission.user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);

        $user->syncRoles($request->roles);

        event(new Registered($user));
        return redirect('/users')->with('status','User created successfully with roles');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    // Function to handle user updates
public function update(UserRequest $request, User $user)
{

    // Prepare an associative array to store the user's name and email
    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // If a password is provided in the request, hash it and add it to the data array
    if(!empty($request->password)){
        $data += [
            'password' => Hash::make($request->password),
        ];
    }

    // Update the user's data in the database
    $user->update($data);

    // Synchronize the user's roles with the provided roles
    $user->syncRoles($request->roles);

    // Redirect the user back to the users list with a success message
    return redirect('/users')->with('status','User Updated Successfully with roles');
}

    // This function is responsible for deleting a user from the database.
// It accepts a parameter $userId, which represents the ID of the user to be deleted.
public function destroy($userId)
{
    // Retrieve the user with the given $userId.
    // If the user does not exist, a 404 error will be thrown.
    $user = User::findOrFail($userId);

    // Delete the user from the database.
    $user->delete();

    // Redirect the user back to the users list with a success message.
    return redirect('/users')->with('status','User Delete Successfully');
}
}