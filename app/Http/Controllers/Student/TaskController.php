<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateStudentTaskRequest;
use App\Http\Services\TaskService;
use App\Models\Category;
use Illuminate\Http\Request;
// use Yaza\LaravelGoogleDriveStorage\Gdrive;

class TaskController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $tasks = TaskService::taskIndex($userId);
        return view('student.task.index')
            ->with(compact('tasks'));
    }

    public function edit($id)
    {
        $userId = auth()->user()->id;
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
        $userId = auth()->user()->id;

        TaskService::storeTask($request, $userId);

        // dd($task);
        return redirect()->route('student.task_index');
    }

    public function update($id, UpdateStudentTaskRequest $request)
    {
        $userId = auth()->user()->id;
        TaskService::taskDetail($userId, $id, 'student')->updateTask($userId, $request);

        return redirect()->route('student.task_index')->with('success', 'Tugas berhasil diperbarui');
    }
}
