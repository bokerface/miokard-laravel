<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'photo',
        'gender',
        'origin_address',
        'residence_address',
        'phone',
        'emergency_phone',
        'student_id',
        'entry_year',
        'status',
        'sip_id',
        'str_id',
        'bpjs_id',
        'bank_account',
        'age',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function photo(): Attribute
    {
        return  Attribute::make(
            get: fn ($value) =>  $value ? encrypt($value) : null,
        );
    }
}
