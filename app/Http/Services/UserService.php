<?php

namespace App\Http\Services;

use App\Models\StudentClinicalRotation;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserService
{
    public static $user;
    public static function fetch()
    {
        return static::$user;
    }
    public static function storeUser($request, $role)
    {
        $data = Arr::add($request->validated(), 'role_id', $role);
        // dd($request->name);
        return DB::transaction(function () use ($data, $request, $role) {
            $user = User::create($data);
            UserProfile::create([
                'user_id' => $user->id,
                'name' => $request->name
            ]);

            if ($role == 2) {
                StudentClinicalRotation::create([
                    'user_id' => $user->id,
                    'start_date' => Carbon::now(),
                    'clinical_rotation_id' => 1
                ]);
            }
        });
    }

    public static function userIndex($role = null)
    {
        $q = User::where('role_id', '!=', 1);

        if ($role == 'student') {
            return $q->where('role_id', '=', 2)->get();
        } elseif ($role == 'teacher') {
            return $q->where('role_id', '=', 3)->get();
        } else {
            return $q->get();
        }
    }

    public static function userDetail($userId, $teacher = false)
    {
        if ($teacher) {
            static::$user = User::with('mentees.mentee.userProfile')->findOrFail($userId);
            return new static;
        }

        static::$user = User::findOrFail($userId);
        return new static;
    }
}
