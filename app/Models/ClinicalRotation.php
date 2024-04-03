<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalRotation extends Model
{
    use HasFactory;

    public function clinicalRotationSupervisor()
    {
        return $this->hasOne(ClinicalRotationSupervisor::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
