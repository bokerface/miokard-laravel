<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicalRotation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $clinicalRotations = ClinicalRotation::with('students.user')->get();
        dd($clinicalRotations->pluck('students'));
        return view('admin.dashboard.index')
            ->with(compact('clinicalRotations'));
    }
}
