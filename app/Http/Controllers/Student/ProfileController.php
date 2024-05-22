<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Enums\GenderEnum;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $userId = auth()->user()->id;

        $user = UserService::getAuthenticatedUser($userId)->fetch();
        $genders = GenderEnum::cases();

        return view('student.profile.edit')
            ->with(compact('user', 'genders'));
    }

    public function changePassword()
    {
        $userId = auth()->user()->id;
        $user = UserService::getAuthenticatedUser($userId)->fetch();

        return view('student.profile.change-password')
            ->with(compact('user'));
    }

    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $userId = auth()->user()->id;
        UserService::getAuthenticatedUser($userId)->updatePassword($request);
        return redirect()->back()->with('success', 'Password berhasil diubah');
    }

    public function update(UpdateStudentRequest $request)
    {
        $userId = auth()->user()->id;

        UserService::userDetail($userId)->updateUser($request);

        return redirect()->back()->with('success', 'Informasi akun mahasiswa berhasil diperbarui');
    }
}
