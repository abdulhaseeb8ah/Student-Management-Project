<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function showUploadForm()
    {
        $courses = Course::all();
        return view('faculty.upload_attendance', compact('courses'));
    }

    public function getStudents(Request $request)
    {
        $course_id = $request->input('course_id');
        $students = User::select('users.id as student_id', 'users.username')
                        ->join('enrollments', 'users.id', '=', 'enrollments.student_id')
                        ->where('enrollments.course_id', $course_id)
                        ->get();

        $student_table = View::make('partials.students_table', compact('students'))->render();
        return response()->json(['student_table' => $student_table]);
    }

    public function uploadAttendance(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'statuses' => 'required|json',
        ]);

        $statuses = json_decode($request->input('statuses'), true);

        foreach ($statuses as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'course_id' => $request->input('course_id'),
                    'date' => $request->input('date')
                ],
                [
                    'status' => $status
                ]
            );
        }

        return response()->json("success");
    }
    public function viewAttendance()
    {
        $stdId = session('id');
        $attendances = Attendance::where('student_id', $stdId)->get();
        return $attendances;
    }
}
