<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_code', 'course_name'
    ];
    public function facultyAssignments()
    {
        return $this->hasMany(Course_faculty_assignment::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
