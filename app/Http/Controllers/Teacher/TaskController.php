<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userId = 2;
        // dd(TaskService::taskIndex($userId, true));
        $tasks = TaskService::taskIndex($userId, true);
        return view('teacher.task.index')
            ->with(compact('tasks'));
    }

    public function show($id)
    {
        $userId = 2;
        $task = TaskService::taskDetail($userId, $id)->fetch();
        return view('teacher.task.detail')
            ->with(compact('task'));
    }

    public function approve($id)
    {
        $userId = 2;

        $taskApproval = TaskService::taskDetail($userId, $id)->approveTask($userId);

        if (!$taskApproval) {
            abort(403);
        }

        return redirect()->back()->with('success', 'Ilmiah telah disetujui.');
    }
}
