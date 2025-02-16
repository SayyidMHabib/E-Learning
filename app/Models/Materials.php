<?php

namespace App\Models;

use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materials extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
