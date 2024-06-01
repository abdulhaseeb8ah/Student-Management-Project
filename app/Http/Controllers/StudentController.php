<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function loadPage($pageName)
    {
        $role = session('role');
        $validPages = ['ViewAttendance', 'ViewMarks', 'UpdateDetails']; 

        if (!in_array($pageName, $validPages)) {
            return response('Invalid page', 404);
        }
        return view($role . '.' . $pageName);
    }
}
