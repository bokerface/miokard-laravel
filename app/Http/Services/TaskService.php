<?php

namespace App\Http\Services;

use App\Mail\TaskSubmitted;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TaskService
{
    public static $task;
    public static function taskIndex($userId = null, $teacher = false)
    {
        if ($userId && $teacher) {
            $supervisor = User::with('clinicalRotationSupervisor')
                ->where('id', '=', $userId)->first()
                ->clinicalRotationSupervisor;

            if ($supervisor != null) {
                return Task::with('clinicalRotation', 'category', 'user', 'user.mentor', 'user.userProfile')
                    ->whereHas('clinicalRotation', function ($query) use ($supervisor) {
                        $query->where('clinical_rotations.id', '=', $supervisor->clinical_rotation_id);
                    })
                    ->get();
            }

            return Task::with('clinicalRotation', 'category', 'user', 'user.mentor', 'user.userProfile')
                ->whereHas('user.mentor', function ($query) use ($userId) {
                    $query->where('mentorships.mentor_user_id', '=', $userId);
                })
                ->get();
        }

        if ($userId) {
            return Task::with('clinicalRotation')->where('user_id', $userId)->get();
        }

        return Task::all();
    }

    public static function taskDetail($userId = null, $id, $for = null)
    {

        if ($for == 'student') {
            static::$task = Task::with('clinicalRotation', 'category', 'user', 'user.mentor', 'user.userProfile')
                ->where([
                    ['id', '=', $id],
                    ['user_id', '=', $userId]
                ])
                ->firstOrFail();
        }

        if ($for == 'teacher') {
            static::$task = Task::with('clinicalRotation', 'category', 'user', 'user.mentor', 'user.userProfile')
                ->where('id', '=', $id)
                ->whereHas('user.mentor', function ($query) use ($userId) {
                    $query->where('mentorships.mentor_user_id', '=', $userId);
                })
                ->firstOrFail();
        }

        if ($for == 'admin') {
            static::$task = Task::with('clinicalRotation', 'category', 'user', 'user.userProfile')
                ->where('id', '=', $id)
                ->firstOrFail();
        }

        return new static;
    }

    public static function fetch()
    {
        return static::$task;
    }

    public static function storeTask($request, $userId)
    {
        DB::transaction(function () use ($request, $userId) {
            $user = User::with('activeClinicalRotation', 'activeClinicalRotation.clinicalRotation.clinicalRotationSupervisor.user', 'mentor.mentorUser.userProfile')->where('id', '=', $userId)->first();
            $taskData = Arr::except($request->validated(), ['file', 'presentation_file']);

            $task = Task::create(array_merge($taskData, [
                'user_id' => $userId,
                'student_clinical_rotation_id' => $user->activeClinicalRotation->id,
                'clinical_rotation_id' => $user->activeClinicalRotation->clinical_rotation_id
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


            Mail::to("waskitodamar51@gmail.com")->send(new TaskSubmitted(route('teacher.detail_task', $task->id)));

            Mail::to(User::where('role_id', 1)->first()->email)->send(new TaskSubmitted(route('admin.task_detail', $task->id)));

            if ($user->activeClinicalRotation->clinicalRotation->clinicalRotationSupervisor != null) {
                Mail::to($user->activeClinicalRotation->clinicalRotation->clinicalRotationSupervisor->user->email)->send(new TaskSubmitted(route('teacher.detail_task', $task->id)));
            }
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

    public static function updateTask($userId, $request)
    {
        $task = static::$task;

        $data = Arr::except($request->validated(), ['file', 'presentation_file']);

        DB::transaction(function () use ($task, $data, $userId, $request) {
            // If has Task File
            if ($request->hasFile('file')) {
                // upload task file start
                $file = $request->validated()['file'];
                $filePath = 'ppds/' . $userId . '/' . 'tasks/' . $task->id . '/' . 'file';
                $fileName = $file->getClientOriginalName();
                Storage::putFileAs($filePath, $file, $fileName);
                // upload task file end

                // delete task file start
                $filePath = decrypt($task->file);
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
                // delete task file end

                // set new file path
                $data['file'] = $filePath . '/' . $fileName;
            }

            // IF has Task Presentation File
            if ($request->hasFile('presentation_file')) {
                // upload task presentation file start
                $filePresentation = $request->validated()['presentation_file'];
                $filePathPresentation = 'ppds/' . $userId . '/' . 'tasks/' . $task->id . '/' . 'presentation_file';
                $fileNamePresentation = $filePresentation->getClientOriginalName();
                Storage::putFileAs($filePathPresentation, $filePresentation, $fileNamePresentation);
                // delete task presentation file end

                // delete task presentation file start
                $filePresentationPath = decrypt($task->file);
                if (Storage::exists($filePresentationPath)) {
                    Storage::delete($filePresentationPath);
                }
                // delete task presentation file end

                // set new presentation file path
                $data['presentation_file'] = $filePathPresentation . '/' . $fileNamePresentation;
            }

            $task->update($data);
        });
    }
}
