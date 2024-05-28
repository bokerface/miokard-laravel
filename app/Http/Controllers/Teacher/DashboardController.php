<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        $user = UserService::getAuthenticatedUser($userId)->fetch();



        return view('teacher.dashboard.index')
            ->with(compact('user'));
    }
}
