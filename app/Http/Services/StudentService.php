<?php

namespace App\Http\Services;

use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\Mentorship;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentService
{
    public static $student;
    public static function fetch()
    {
        return static::$student;
    }

    public static function getStudentsByName($request)
    {
        $q = Mentorship::all();
        $mentoredStudents = $q->pluck('mentee_user_id');

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
