<?php

namespace App\Http\Services;

use App\Models\ClinicalRotationSupervisor;
use App\Models\LogBook;
use Illuminate\Support\Facades\DB;

class LogbookService
{

    public static $logbook;

    public static function fetch()
    {
        return static::$logbook;
    }

    public static function logbookIndex($userId, $forRole)
    {
        if ($forRole == 'teacher') {
            $supervisor = ClinicalRotationSupervisor::where('user_id', '=', $userId)->first();
            if ($supervisor) {
                $logbooks = LogBook::with('user.userProfile', 'user.activeClinicalRotation', 'user.mentor')
                    ->whereHas('user.activeClinicalRotation', function ($query) use ($supervisor) {
                        $query->where('student_clinical_rotations.clinical_rotation_id', '=', $supervisor->clinical_rotation_id);
                    })
                    ->whereHas('user.mentor', function ($query) use ($userId) {
                        $query->where('mentorships.mentor_user_id', '=', $userId);
                    })
                    ->get();
                return $logbooks;
            }
            $logbooks = LogBook::with('user', 'user.activeClinicalRotation', 'user.mentor')
                ->whereHas('user.mentor', function ($query) use ($userId) {
                    $query->where('mentorships.mentor_user_id', '=', $userId);
                })
                ->get();
            return $logbooks;
        }
    }

    public static function logbookDetail($id, $userId, $forRole)
    {
        if ($forRole == 'student') {
            $logbook = LogBook::where([
                ['id', '=', $id],
                ['user_id', '=', $userId],
            ])
                ->firstOrFail();
        }

        if ($forRole == 'admin') {
            $logbook = LogBook::where([
                ['id', '=', $id],
            ])
                ->firstOrFail();
        }

        static::$logbook = $logbook;

        return new static;
    }

    public static function StoreLogbook($request, $userId)
    {
        $data = $request->validated();
        $data['user_id'] = $userId;

        DB::transaction(function () use ($data) {
            LogBook::create($data);
        });
    }

    public static function updateLogbook($request)
    {
        $data = $request->validated();

        // dd($data);

        DB::transaction(function () use ($data) {
            static::$logbook->update($data);
        });
    }

    public static function deleteLogbook()
    {
        DB::transaction(function () {
            static::$logbook->delete();
        });
    }
}
