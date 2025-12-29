<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminActivity;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:admin,staff,user',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'is_admin' => $data['role'] === 'admin',
        ]);

        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'create_user', 'details' => 'Created user '.$user->email, 'ip' => request()->ip()]);

        return redirect()->route('admin.users.index')->with('status', 'User created');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string|in:admin,staff,user',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->role = $data['role'];
        $user->is_admin = $data['role'] === 'admin';
        $user->save();

        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'update_user', 'details' => 'Updated user '.$user->email, 'ip' => request()->ip()]);

        return redirect()->route('admin.users.index')->with('status', 'User updated');
    }

    public function destroy(User $user)
    {
        $email = $user->email;
        $user->delete();
        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'delete_user', 'details' => 'Deleted user '.$email, 'ip' => request()->ip()]);
        return redirect()->route('admin.users.index')->with('status', 'User deleted');
    }
}
