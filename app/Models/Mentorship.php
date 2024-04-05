<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentorship extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_user_id',
        'mentee_user_id',
    ];

    public function mentorUser()
    {
        return $this->belongsTo(User::class, 'mentor_user_id', 'id');
    }

    public function menteeUser()
    {
        return $this->belongsTo(User::class, 'mentee_user_id', 'id');
    }
}
