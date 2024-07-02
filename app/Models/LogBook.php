<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'patient_name',
        'patient_gender',
        'patient_age',
        'type_of_action'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
