<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\LogbookService;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index()
    {
        $logbooks = LogbookService::logbookIndex(null, 'admin')->fetch();

        return view('admin.logbook.index')
            ->with(compact('logbooks'));
    }

    public function show($id)
    {
        $logbook = LogbookService::logbookDetail($id, null, 'admin')->fetch();
        return view('admin.logbook.detail')
            ->with(compact('logbook'));
    }
}
