<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->r;
        $users = UserService::userIndex($role);
        return view('admin.users.index')
            ->with(
                compact('users', 'role')
            );
    }

    public function createStudentAccount()
    {
        return view('admin.users.create-student');
    }

    public function createTeacherAccount()
    {
        return view('admin.users.create-teacher');
    }

    public function storeStudent(StoreStudentRequest $request)
    {
        UserService::storeUser($request, 2);
        return redirect()->to(route('admin.user_index') . '?r=student')->with('success', 'Akun mahasiswa berhasil ditambahkan');
    }

    public function storeTeacher(StoreTeacherRequest $request)
    {
        UserService::storeUser($request, 3);
        return redirect()->to(route('admin.user_index') . '?r=teacher')->with('success', 'Akun dosen berhasil ditambahkan');
    }
}
