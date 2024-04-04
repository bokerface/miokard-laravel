<?php

namespace App\Http\Services;

use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentService
{
    public static $student;
    public static function fetch()
    {
        return static::$student;
    }

    public static function storeTeacherMentee($request, $userId)
    {
        $q = User::with('mentor')->find($request->validated()['mentee_user_id']);

        if ($q->role_id != 2 || $q->mentor != null) {
            return false;
        }

        DB::transaction(function () use ($request, $userId) {
            Mentee::create([
                'user_id' => $userId,
                'mentee_user_id' => $request->validated()['mentee_user_id']
            ]);

            Mentor::create([
                'user_id' => $request->validated()['mentee_user_id'],
                'mentor_user_id' => $userId
            ]);
        });

        return true;
    }

    public static function getStudentsByName($request)
    {
        $q = Mentor::all();
        $mentoredStudents = $q->pluck('user_id');

        return User::with('userProfile')
            ->whereHas('userProfile', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->whereNotIn('id', $mentoredStudents)
            ->where('role_id', '=', 2)
            ->limit(10)
            ->get();
    }
}
