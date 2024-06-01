<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Mark;
use App\Models\Course_faculty_assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function getCourses()
    {
        $courses = Course::all();
        return $courses;
    }
    public function getFaculties()
    {
        $faculties = User::all()->where('role','faculty');
        return $faculties;
    }

    public function index()
    {
        $user = Auth::user();
        $courses = [];

        $studentId = session('id');
        $courses = DB::table('courses')
            ->join('course_faculty_assignments', 'courses.id', '=', 'course_faculty_assignments.course_id')
            ->join('users', 'course_faculty_assignments.faculty_id', '=', 'users.id')
            ->where('users.role', 'faculty')
            ->whereNotExists(function ($query) use ($studentId) {
                $query->select(DB::raw(1))
                    ->from('enrollments')
                    ->whereColumn('enrollments.course_id', 'courses.id')
                    ->where('enrollments.student_id', $studentId);
            })
            ->select('courses.*', 'users.username as faculty_username')
            ->get();


        $enrolledCourses = Enrollment::where('student_id', $studentId)
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('course_faculty_assignments', 'courses.id', '=', 'course_faculty_assignments.course_id')
            ->join('users', 'course_faculty_assignments.faculty_id', '=', 'users.id')
            ->select('enrollments.*', 'courses.*', 'users.username as faculty_username')
            ->get();
        

        return [
            'courses' => $courses,
            'enrolledCourses' => $enrolledCourses
        ];
    }

    public function registerCourse(Request $request)
    {
        $studentId = auth()->user()->id;
        $courseId = $request->input('course_id');

        $existingEnrollment = Enrollment::where('student_id', $studentId)
                                        ->where('course_id', $courseId)
                                        ->exists();

        if ($existingEnrollment) {
            return 'Already registered';
        }

        Enrollment::create([
            'student_id' => $studentId,
            'course_id' => $courseId
        ]);
        Mark::create([
            'student_id' => $studentId,
            'course_id' => $courseId,
            'assignment_marks' => 0,
            'quiz_marks' => 0,
            'mid1_marks' => 0,
            'mid2_marks' => 0,
            'final_marks' => 0
        ]);

        return 'Registration successful.';
    }

    public function register(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->input('course_id');

        if ($user->role == 'Student') {
            $studentId = $user->student->id;

            $existingEnrollment = Enrollment::where('student_id', $studentId)
                ->where('course_id', $courseId)
                ->first();

            if ($existingEnrollment) {
                return response()->json('already_registered');
            }

            Enrollment::create([
                'student_id' => $studentId,
                'course_id' => $courseId,
            ]);

            return response()->json('success');
        }

        return response()->json('error');
    }

    public function assign(Request $request)
    {
        $courseFaculty = Course_faculty_assignment::where('course_id', $request->course_id)
            ->where('faculty_id', $request->faculty_id)
            ->first();

        if ($courseFaculty) {
            return "Course already assigned";
        }

        Course_faculty_assignment::create([
            'course_id' => $request->course_id,
            'faculty_id' => $request->faculty_id,
        ]);

        return "Course assigned successfully";
    }

    public function store(Request $request)
    {
        Log::info('Coming inside the store file'); 
        Course::create([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
        ]);

        return response()->json(['message' => 'Course added successfully.'], 200);
    }
}
