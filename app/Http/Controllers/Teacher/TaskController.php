<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userId = 6;
        // dd(TaskService::taskIndex($userId, true));
        $tasks = TaskService::taskIndex($userId, true);
        return view('teacher.task.index')
            ->with(compact('tasks'));
    }
}
