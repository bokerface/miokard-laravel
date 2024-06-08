<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicalRotation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $clinicalRotations = ClinicalRotation::with('students.user')->get();

        $flat = $clinicalRotations->pluck('name')->toArray();

        $totalStudents = User::where('role_id', 2)->count();

        // dd($clinicalRotations);


        return view('admin.dashboard.index')
            ->with(compact('clinicalRotations', 'totalStudents'));
    }
}
