<?php

namespace App\Http\Services;

use App\Models\ClinicalRotation;

class ClinicalRotationService
{
    private static $clinicalRotation;

    public static function fetch()
    {
        return static::$clinicalRotation;
    }

    public static function clinicalRotationIndex()
    {
        return ClinicalRotation::with('clinicalRotationSupervisor')->get();
    }
}
