<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class AdminController extends Controller
{

    public function loadPage($pageName)
    {
        $role = session('role');
        $validPages = ['RegistrationRequest','Users', 'CourseOffer','AssignCourses']; 

        if (!in_array($pageName, $validPages)) {
            return response('Invalid page', 404);
        }
        return view($role . '.' . $pageName);
    }
    public function index()
    {
        $requests = User::where('admin_approved', 'no')
                ->where('role', '!=', 'admin')
                ->get();
        return $requests;
    }

    public function processRequest(Request $request)
    {
        $action = $request->input('action');
        $requestId = $request->input('requestId'); 

        if (!$requestId) {
            return response()->json(['error' => 'Request ID is required'], 400);
        }

        $user = User::find($requestId);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($action === 'confirm') {
            $user->admin_approved = 'confirm';
            $user->save();
            return response()->json(['message' => 'Request confirmed successfully'], 200);
        } elseif ($action === 'reject') {
            $user->admin_approved = 'reject';
            $user->save();
            return response()->json(['message' => 'Request rejected successfully'], 200);
        } else {
            return response()->json(['error' => 'Invalid action'], 400);
        }
    }

    public function showUsersStatus()
    {
        $requests = User::where('admin_approved', 'no')
                ->where('role', '!=', 'admin')
                ->get();
        return $requests;
    }

    public function UserStatus(Request $request)
    {
        $action = $request->input('action');
        $requestId = $request->input('requestId'); 

        if (!$requestId) {
            return response()->json(['error' => 'Request ID is required'], 400);
        }

        $user = User::find($requestId);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($action === 'block') {
            $user->status = 'block';
            $user->save();
            return response()->json(['message' => 'User blocked successfully'], 200);
        } elseif ($action === 'unblock') {
            $user->status = 'unblock';
            $user->save();
            return response()->json(['message' => 'User unblocked successfully'], 200);
        } else {
            return response()->json(['error' => 'Invalid action'], 400);
        }
    }
}
