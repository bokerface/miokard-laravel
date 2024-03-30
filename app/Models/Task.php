<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'clinical_rotation_id',
        'category_id',
        'task_type_id',
        'file',
        'presentation_file',
        'score_1',
        'score_2',
        'score_3',
        'score_4',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function clinicalRotation()
    {
        return $this->belongsTo(ClinicalRotation::class);
    }
}
