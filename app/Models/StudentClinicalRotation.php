<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClinicalRotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'clinical_rotation_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clinicalRotation()
    {
        return $this->belongsTo(ClinicalRotation::class);
    }
}
