<?php

namespace App\Models;

use App\Models\User;
use App\Models\Materials;
use App\Models\Assignments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_students', 'course_id', 'student_id');
    }

    public function materials()
    {
        return $this->hasMany(Materials::class, 'course_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignments::class, 'course_id');
    }
}
