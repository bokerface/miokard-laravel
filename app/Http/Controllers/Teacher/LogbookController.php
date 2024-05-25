<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Services\LogbookService;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $logbooks = LogbookService::logbookIndex($userId, 'teacher');
        return view('teacher.logbook.index')
            ->with(compact('logbooks'));
    }

    public function show($id)
    {
        $userId = auth()->user()->id;
        $logbook = LogbookService::logbookDetail($id, $userId, 'teacher')->fetch();
        // dd($logbook);
        return view('teacher.logbook.detail')
            ->with(compact('logbook'));
    }
}
