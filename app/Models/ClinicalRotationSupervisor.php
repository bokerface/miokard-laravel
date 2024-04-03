<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalRotationSupervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clinical_rotation_id',
    ];

    public function clinicalRotation()
    {
        return $this->belongsTo(ClinicalRotation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
