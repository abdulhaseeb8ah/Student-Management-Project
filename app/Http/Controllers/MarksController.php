<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('upload_marks', compact('courses'));
    }

    public function getStudents(Request $request)
    {
        $courseId = $request->input('course_id');

        $students = User::where('role', 'student')
                        ->whereIn('id', function ($query) use ($courseId) {
                            $query->select('student_id')
                                ->from('enrollments')
                                ->where('course_id', $courseId);
                        })
                        ->get(['id', 'username']);

        return response()->json($students);
    }
    public function uploadMarks(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:users,id',
            'assignment_marks' => 'required|numeric',
            'quiz_marks' => 'required|numeric',
            'mid1_marks' => 'required|numeric',
            'mid2_marks' => 'required|numeric',
            'final_marks' => 'required|numeric',
        ]);

        $mark = Mark::where('student_id', $request->student_id)
                    ->where('course_id', $request->course_id)
                    ->first();

        if ($mark) {
            $mark->update($request->only([
                'assignment_marks', 'quiz_marks', 'mid1_marks', 'mid2_marks', 'final_marks'
            ]));
        } else {
            Mark::create($request->only([
                'student_id', 'course_id', 'assignment_marks', 'quiz_marks', 'mid1_marks', 'mid2_marks', 'final_marks'
            ]));
        }

        return response()->json(['message' => 'Marks uploaded successfully']);
    }
    public function viewMarks()
    {
        $username = session('username');
        $studentId =session('id');

        $marks = DB::table('courses')
            ->join('marks', 'courses.id', '=', 'marks.course_id')
            ->where('marks.student_id', $studentId)
            ->select(
                'courses.course_name',
                'marks.assignment_marks',
                'marks.quiz_marks',
                'marks.mid1_marks',
                'marks.mid2_marks',
                'marks.final_marks',
                DB::raw('(marks.assignment_marks + marks.quiz_marks + marks.mid1_marks + marks.mid2_marks + marks.final_marks) AS total_marks')
            )
            ->get();

        return $marks;
    }
}
