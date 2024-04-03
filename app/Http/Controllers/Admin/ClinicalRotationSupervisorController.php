<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClinicalRotationSupervisorRequest;
use App\Http\Requests\UpdateClinicalRotationSupervisorRequest;
use App\Http\Services\ClinicalRotationService;
use App\Http\Services\ClinicalRotationSupervisorService;
use App\Models\User;
use Illuminate\Http\Request;

class ClinicalRotationSupervisorController extends Controller
{
    public function index()
    {
        $clinicalRotations = ClinicalRotationService::clinicalRotationIndex();
        return view('admin.supervisor.index')
            ->with(compact('clinicalRotations'));
    }

    public function changeClinicalRotationSupervisor($id)
    {
        $clinicalRotation = ClinicalRotationSupervisorService::supervisorDetail($id)->fetch();

        if ($clinicalRotation->clinicalRotationSupervisor == null) {
            abort(404);
        }

        return view('admin.supervisor.change')
            ->with(compact('clinicalRotation'));
    }

    public function updateClinicalRotationSupervisor(UpdateClinicalRotationSupervisorRequest $request, $id)
    {
        $update = ClinicalRotationSupervisorService::supervisorDetail($id)->update($request);

        if (!$update) {
            abort(403);
        }

        return redirect()->to(route('admin.supervisor_index'))->with('success', 'Supervisor berhasil diubah');
    }

    public function addClinicalRotationSupervisor($id)
    {
        $clinicalRotation = ClinicalRotationSupervisorService::supervisorDetail($id)->fetch();

        if ($clinicalRotation->clinicalRotationSupervisor != null) {
            return redirect()->to(route('admin.supervisor_index'))->with('error', 'Supervisor sudah ada, silahkan gunakan menu edit untuk mengganti supervisor');
        }

        return view('admin.supervisor.add')
            ->with(compact('clinicalRotation'));
    }

    public function storeClinicalRotationSupervisor(StoreClinicalRotationSupervisorRequest $request)
    {
        $store = ClinicalRotationSupervisorService::storeSupervisor($request);

        if (!$store) {
            return redirect()->to(route('admin.supervisor_index'))->with('error', 'Supervisor sudah ada, silahkan gunakan menu edit untuk mengganti supervisor');
        }

        return redirect()->to(route('admin.supervisor_index'))->with('success', 'Supervisor berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $destroy = ClinicalRotationSupervisorService::supervisorDetail($id)->remove();

        if (!$destroy) {
            return redirect()->to(route('admin.supervisor_index'))->with('error', 'Gagal menghapus supervisor, data tidak ditemukan');
        }

        return redirect()->to(route('admin.supervisor_index'))->with('success', 'Supervisor berhasil dihapus');
    }

    public function getSupervisorByName(Request $request)
    {
        return ClinicalRotationSupervisorService::getSupervisorByName($request);
    }
}
