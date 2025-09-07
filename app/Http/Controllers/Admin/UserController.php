<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [3, 5, 10];
        
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        $search = $request->get('search');
        $roleFilter = $request->get('role_filter');
        
        $query = User::query();
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        // Apply role filter
        if ($roleFilter && $roleFilter !== 'all') {
            $query->where('role', $roleFilter);
        }
        
        $users = $query->paginate($perPage);
        $users->appends($request->query());
        
        return view('admin.users.index', compact('users', 'perPage', 'search', 'roleFilter'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,pengguna',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => bcrypt('honest123_'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan dengan password default: honest123_');
    }

    public function show($id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,pengguna',
        ]);

        $user->name = $validated['name'];
        $user->role = $validated['role'];
        
        $user->save();
        
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting admin users
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus user admin');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        
        $user->password = bcrypt('honest123_');
        $user->save();
        
        return redirect()->route('admin.users.index')->with('success', 'Password user ' . $user->name . ' berhasil direset ke default: honest123_');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->get('search');
        $roleFilter = $request->get('role_filter');
        
        $query = User::query();
        
        // Apply same filters as index method
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        // Apply role filter
        if ($roleFilter && $roleFilter !== 'all') {
            $query->where('role', $roleFilter);
        }
        
        $users = $query->with('profile')->get();
        
        $pdf = PDF::loadView('admin.users.pdf', compact('users', 'search', 'roleFilter'));
        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'daftar-users-' . date('Y-m-d-H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }
}