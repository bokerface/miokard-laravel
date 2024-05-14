<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Services\LogbookService;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index()
    {
        $userId = 2;

        dd(LogbookService::logbookIndex($userId, 'teacher'));
    }
}
