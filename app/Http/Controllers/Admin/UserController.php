<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Enums\GenderEnum;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Services\UserService;
use App\Models\ClinicalRotation;
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

    public function show($id)
    {
        $user = UserService::userDetail($id)->fetch();
        if ($user->role_id == 3) {
            $genders = GenderEnum::cases();
            return view('admin.users.edit-teacher')
                ->with(compact('user', 'genders'));
        }

        if ($user->role_id == 2) {
            $genders = GenderEnum::cases();
            $clinicalRotations = ClinicalRotation::whereNotIn('id', $user->studentClinicalRotations->pluck('clinical_rotation_id'))->get();
            return view('admin.users.edit-student')
                ->with(compact('user', 'clinicalRotations', 'genders'));
        }
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

    public function destroy($id)
    {
        $destroy = UserService::userDetail($id)->delete();

        if (!$destroy) {
            return redirect()->to(route('admin.user_index'))->with('error', 'Gagal menghapus user, data tidak ditemukan');
        }

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }

    public function updateStudent(UpdateStudentRequest $request, $id)
    {
        UserService::userDetail($id)->updateUser($request);

        return redirect()->back()->with('success', 'Informasi akun mahasiswa berhasil diperbarui');
    }

    public function updateTeacher(UpdateTeacherRequest $request, $id)
    {
        UserService::userDetail($id)->updateUser($request);

        return redirect()->back()->with('success', 'Informasi akun dosen berhasil diperbarui');
    }

    public function changeStudentClinicalRotation(Request $request, $id)
    {
        UserService::userDetail($id)->changeClinicalRotation($request);
        return redirect()->back()->with('success', 'Stase PPDS berhasil dirubah');
    }

    public function changeStudentMentor(Request $request, $id)
    {
        $request = $request->validate([
            'mentor_user_id' => ['required', 'exists:users,id']
        ]);

        $update = UserService::userDetail($id)->changeMentor($request);

        if (!$update) {
            return redirect()->to(route('admin.user_index'))->with('error', 'Anda hanya dapat mengubah pembimbing dari akun ppds');
        }

        return redirect()->back()->with('success', 'Pembimbing PPDS berhasil diganti');
    }
}
