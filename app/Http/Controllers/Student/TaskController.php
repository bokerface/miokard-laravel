<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateStudentTaskRequest;
use App\Http\Services\TaskService;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userId = 1;

        $tasks = TaskService::taskIndex($userId);
        return view('student.task.index')
            ->with(compact('tasks'));
    }

    public function edit($id)
    {
        $userId = 1;
        $categories = Category::all();
        $task = TaskService::taskDetail($userId, $id, 'student')->fetch();
        return view('student.task.edit')
            ->with(compact('task', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('student.task.create')
            ->with(compact('categories'));
    }

    public function store(StoreTaskRequest $request)
    {
        $userId = 1;

        TaskService::storeTask($request, $userId);
        return redirect()->route('student.task_index');
    }

    public function update($id, UpdateStudentTaskRequest $request)
    {
        $userId = 1;
        TaskService::taskDetail($userId, $id, 'student')->updateTask($userId, $request);

        return redirect()->route('student.task_index')->with('success', 'Tugas berhasil diperbarui');
    }
}
