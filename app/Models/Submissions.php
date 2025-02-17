<?php

namespace App\Models;

use App\Models\User;
use App\Models\Assignments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submissions extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function assignment()
    {
        return $this->belongsTo(Assignments::class, 'assignment_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
