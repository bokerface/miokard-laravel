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

        $students = User::with('userProfile')->where('role_id', 2);

        $totalStudents = $students->count();

        if (request()->ajax()) {
            $barChartData = [];

            $data = $students->distinct()->get()->groupBy('userProfile.entry_year')->toArray();
            ksort($data);

            foreach ($data as $key => $value) {
                $barChartData['entryYear'][] = [
                    'year' => $key,
                    'count' => count($value)
                ];
            }

            foreach ($clinicalRotations as $clinicalRotation) {
                $barChartData['clinicalRotation'][] = [
                    'clinicalRotation' => $clinicalRotation->name,
                    'count' => $clinicalRotation->students->count()
                ];
            }


            return response()->json($barChartData);
        }

        // die();


        // dd($barChartData);
        // dd($students->get());
        // dd($clinicalRotations);


        return view('admin.dashboard.index')
            ->with(compact('clinicalRotations', 'totalStudents'));
    }
}
