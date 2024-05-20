<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Enums\GenderEnum;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $userId = auth()->user()->id;

        $user = UserService::getAuthenticatedUser($userId)->fetch();
        $genders = GenderEnum::cases();

        return view('teacher.profile.edit')
            ->with(compact('user', 'genders'));
    }

    public function update(UpdateTeacherRequest $request)
    {
        $userId = auth()->user()->id;

        UserService::userDetail($userId)->updateUser($request);

        return redirect()->back()->with('success', 'Informasi akun mahasiswa berhasil diperbarui');
    }
}
