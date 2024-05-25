<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Services\TaskService;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        // dd(TaskService::taskIndex($userId, true));
        $tasks = TaskService::taskIndex($userId, true);
        return view('teacher.task.index')
            ->with(compact('tasks'));
    }

    public function show($id)
    {
        $userId = auth()->user()->id;
        $task = TaskService::taskDetail($userId, $id, 'teacher')->fetch();

        $isSupervisor = User::with('clinicalRotationSupervisor')
            ->where('id', '=', $userId)->first()
            ->clinicalRotationSupervisor == null ? false : true;

        return view('teacher.task.detail')
            ->with(compact('task', 'isSupervisor'));
    }

    public function approve($id)
    {
        $userId = auth()->user()->id;

        $taskApproval = TaskService::taskDetail($userId, $id)->approveTask($userId);

        if (!$taskApproval) {
            abort(403);
        }

        return redirect()->back()->with('success', 'Ilmiah telah disetujui.');
    }
}
