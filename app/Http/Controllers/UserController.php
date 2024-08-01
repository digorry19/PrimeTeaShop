<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Hiển thị danh sách tất cả người dùng có role là 'user'.
     */
    public function index()
    {
        $users = User::where('role', 'user')->paginate(5);
        return view('admin.users.index', compact('users'));
    }
    public function activate(User $user)
    {
        $user->update(['active' => 1]);
        return redirect()->route('users.index')->with('success', 'User activated successfully.');
    }

    public function deactivate(User $user)
    {
        $user->update(['active' => 0]);
        return redirect()->route('users.index')->with('success', 'User deactivated successfully.');
    }
}
