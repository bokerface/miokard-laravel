<?php

namespace App\Http\Services;

use App\Models\ClinicalRotation;
use App\Models\ClinicalRotationSupervisor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClinicalRotationSupervisorService
{
    private static $supervisor;
    public static function fetch()
    {
        return static::$supervisor;
    }

    public static function supervisorDetail($id)
    {
        $clinicalRotation = ClinicalRotation::with('clinicalRotationSupervisor', 'clinicalRotationSupervisor.user', 'clinicalRotationSupervisor.user.userProfile')
            ->where('id', '=', $id)
            ->first();

        static::$supervisor = $clinicalRotation;
        return new static;
    }

    public function update($request)
    {
        $clinicalRotationSupervisor = ClinicalRotationSupervisor::find(static::$supervisor->clinicalRotationSupervisor->id);

        if ($clinicalRotationSupervisor == null) {
            return false;
        }

        DB::transaction(function () use ($clinicalRotationSupervisor, $request) {
            $clinicalRotationSupervisor->update([
                'user_id' => $request->validated()['user_id']
            ]);
        });

        return true;
    }

    public static function remove()
    {
        $clinicalRotationSupervisor = ClinicalRotationSupervisor::find(static::$supervisor->clinicalRotationSupervisor->id);

        if ($clinicalRotationSupervisor == null) {
            return false;
        }

        DB::transaction(function () use ($clinicalRotationSupervisor) {
            $clinicalRotationSupervisor->delete();
        });

        return true;
    }

    public static function storeSupervisor($request)
    {
        $clinicalRotationSupervisor = ClinicalRotationSupervisor::where('clinical_rotation_id', '=', $request->validated()['clinical_rotation_id'])->first();

        if ($clinicalRotationSupervisor != null) {
            return false;
        }

        DB::transaction(function () use ($request) {
            ClinicalRotationSupervisor::create([
                'user_id' => $request->validated()['user_id'],
                'clinical_rotation_id' => $request->validated()['clinical_rotation_id']
            ]);
        });

        return true;
    }

    public static function getSupervisorByName($request)
    {
        if ($request->f == 'supervisor') {
            $q = ClinicalRotationSupervisor::all();
            $employedSupervisor = $q->pluck('user_id');

            return User::with('userProfile')
                ->whereHas('userProfile', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->where('role_id', '=', 3)
                ->whereNotIn('id', $employedSupervisor)
                ->limit(10)
                ->get();
        }

        $q = ClinicalRotationSupervisor::all();
        $employedSupervisor = $q->pluck('user_id');

        return User::with('userProfile')
            ->whereHas('userProfile', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->where('role_id', '=', 3)
            ->whereNotIn('id', $employedSupervisor)
            ->limit(10)
            ->get();
    }
}
