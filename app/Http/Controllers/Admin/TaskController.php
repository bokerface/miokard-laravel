<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = TaskService::taskIndex();
        return view('admin.task.index')
            ->with(compact('tasks'));
    }

    public function show($id)
    {
        // $userId = 1;
        $task = TaskService::taskDetail(null, $id, 'admin')->fetch();
        return view('admin.task.detail')
            ->with(compact('task'));
        // dd($task);
    }
}
