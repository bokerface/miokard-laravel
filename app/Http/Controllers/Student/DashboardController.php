<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $user = UserService::getAuthenticatedUser($userId)->fetch();
        // dd($user);
        // dd($user);
        return view('student.dashboard', compact('user'));
    }
}
