<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function loadPage($pageName)
    {
        $role = session('role');
        $validPages = ['AddMarks', 'MarkAttendance']; 

        if (!in_array($pageName, $validPages)) {
            return response('Invalid page', 404);
        }
        return view($role . '.' . $pageName);
    }
}
