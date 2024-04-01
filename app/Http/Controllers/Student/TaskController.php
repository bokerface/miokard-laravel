<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Services\TaskService;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userId = 7;

        $tasks = TaskService::taskIndex($userId);
        return view('student.task.index')
            ->with(compact('tasks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('student.task.create')
            ->with(compact('categories'));
    }

    public function store(StoreTaskRequest $request)
    {
        $userId = 7;

        TaskService::storeTask($request, $userId);
        return redirect()->route('student.task_index');
    }
}
