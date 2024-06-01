<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Log out the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('/login');
    }

    /**
     * Display the view attendance page.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_attendance()
    {
        $studentCourses = auth()->user()->courses;
        Log::info('Student courses: ' . $studentCourses);   
        return view('view_attendance', ['studentCourses' => $studentCourses]);
    }
}
