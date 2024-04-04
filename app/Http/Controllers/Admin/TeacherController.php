<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenteeRequest;
use App\Http\Services\StudentService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function show($id)
    {
        $user = UserService::userDetail($id, true)->fetch();
        // dd($user);
        if ($user->role_id != 3) {
            abort(404);
        }
        return view('admin.teacher.mentees')
            ->with(compact('user'));
    }

    public function create($id)
    {
        $user = UserService::userDetail($id, true)->fetch();
        return view('admin.teacher.create-mentee')
            ->with(compact('user'));
    }

    public function storeMentee(StoreMenteeRequest $request, $id)
    {
        $mentee = StudentService::storeTeacherMentee($request, $id);

        if (!$mentee) {
            return redirect()->to(route('admin.add_teacher_mentees', $id))->with('error', 'Mahasiswa sudah memiliki pembimbing');
        }

        return redirect()->to(route('admin.teacher_mentees', $id))->with('success', 'Mahasiswa ditambahkan');
    }
}
