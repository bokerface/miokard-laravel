<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getStudentByName(Request $request)
    {
        return StudentService::getStudentsByName($request);
    }
}
