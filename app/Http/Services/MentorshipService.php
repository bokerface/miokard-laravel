<?php

namespace App\Http\Services;

use App\Models\Mentorship;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MentorshipService
{
    public static function storeMentorship($request, $userId)
    {
        $q = User::with('mentor')->find($request->validated()['mentee_user_id']);

        if ($q->role_id != 2 || $q->mentor != null) {
            return false;
        }

        DB::transaction(function () use ($request, $userId) {
            Mentorship::create([
                'mentor_user_id' => $userId,
                'mentee_user_id' => $request->validated()['mentee_user_id']
            ]);
        });

        return true;
    }

    public static function deleteMentorship($id)
    {
        return DB::transaction(function () use ($id) {
            return Mentorship::findOrFail($id)->delete();
        });

        return false;
    }
}
