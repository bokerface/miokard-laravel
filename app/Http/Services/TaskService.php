<?php

namespace App\Http\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TaskService
{
    public static $task;
    public static function taskIndex($userId = null, $teacher = false)
    {
        if ($teacher) {
            return Task::with('clinicalRotation', 'category', 'user', 'user.mentor', 'user.userProfile')
                ->whereHas('user.mentor', function ($query) use ($userId) {
                    $query->where('mentors.mentor_user_id', '=', $userId);
                })
                ->get();
        }

        if ($userId) {
            return Task::with('clinicalRotation')->where('user_id', $userId)->get();
        }

        return Task::all();
    }

    public static function taskDetail($userId, $id)
    {
        static::$task = Task::with('clinicalRotation', 'category', 'user', 'user.mentor', 'user.userProfile')
            ->where('id', '=', $id)
            ->whereHas('user.mentor', function ($query) use ($userId) {
                $query->where('mentors.mentor_user_id', '=', $userId);
            })
            ->firstOrFail();

        return new static;
    }

    public static function fetch()
    {
        return static::$task;
    }

    public static function storeTask($request, $userId)
    {
        DB::transaction(function () use ($request, $userId) {
            $user = User::with('studentClinicalRotations')->where('id', '=', $userId)->first();
            $taskData = Arr::except($request->validated(), ['file', 'presentation_file']);

            $task = Task::create(array_merge($taskData, [
                'user_id' => $userId,
                'clinical_rotation_id' => $user->studentClinicalRotations->last()->clinical_rotation_id
            ]));

            // Upload Task File 
            $file = $request->validated()['file'];
            $filePath = 'ppds/' . $userId . '/' . 'tasks/' . $task->id . '/' . 'file';
            $fileName = $file->getClientOriginalName();
            Storage::putFileAs($filePath, $file, $fileName);

            // Upload Task Presentation File
            $filePresentation = $request->validated()['presentation_file'];
            $filePathPresentation = 'ppds/' . $userId . '/' . 'tasks/' . $task->id . '/' . 'presentation_file';
            $fileNamePresentation = $filePresentation->getClientOriginalName();
            Storage::putFileAs($filePathPresentation, $filePresentation, $fileNamePresentation);

            $task->update([
                'file' => $filePath . '/' . $fileName,
                'presentation_file' => $filePathPresentation . '/' . $fileNamePresentation
            ]);
        });
    }

    public static function approveTask($userId)
    {
        $task = static::$task;

        if ($task->user->mentor->mentor_user_id != $userId) {
            return false;
        }

        DB::transaction(function () use ($task) {
            $task->update(['status' => 1]);
        });

        return true;
    }
}
