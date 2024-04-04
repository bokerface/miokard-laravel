<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mentee_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_user_id', 'id');
    }
}
