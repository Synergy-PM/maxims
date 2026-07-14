<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('user_view');
        $user = auth()->user();
        $trashuser = User::onlyTrashed()->count();
        $users = User::all();
        return view('user.index', compact('users', 'trashuser'));
    }

    public function create()
    {
        $this->authorize('user_create');
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'status' => 'required|in:active,inactive',
            'roles' => 'required|array',
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->syncRoles($request->roles);
            return redirect()->route('user.index')->with('success', 'User created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating user: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $this->authorize('user_edit');
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'status' => 'required|in:active,inactive',
            'roles' => 'required|array',
            'password' => 'nullable|string|min:3',
        ]);
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->status = $request->status;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $user->syncRoles($request->roles);
            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (Exception $e) {
            Log::error('User update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        } catch (Exception $e) {
            Log::error('User deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    public function trash()
    {
        $this->authorize('user_trash_view');
        $users = User::onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->with('roles')
            ->get();

        return view('user.trash', compact('users'));
    }


    public function restore($id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);
            $user->restore();
            return redirect()->route('user.index')->with('success', 'User restored successfully.');
        } catch (Exception $e) {
            Log::error('User restoration failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error restoring user: ' . $e->getMessage());
        }
    }
}
