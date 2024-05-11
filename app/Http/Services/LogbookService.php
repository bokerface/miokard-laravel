<?php

namespace App\Http\Services;

use App\Models\LogBook;
use Illuminate\Support\Facades\DB;

class LogbookService
{

    public static $logbook;

    public static function fetch()
    {
        return static::$logbook;
    }

    public static function logbookDetail($id, $userId, $forRole)
    {
        if ($forRole == 'student') {
            $logbook = LogBook::where([
                ['id', '=', $id],
                ['user_id', '=', $userId],
            ])
                ->firstOrFail();
        }

        if ($forRole == 'admin') {
            $logbook = LogBook::where([
                ['id', '=', $id],
            ])
                ->firstOrFail();
        }

        static::$logbook = $logbook;

        return new static;
    }

    public static function StoreLogbook($request, $userId)
    {
        $data = $request->validated();
        $data['user_id'] = $userId;

        DB::transaction(function () use ($data) {
            LogBook::create($data);
        });
    }

    public static function updateLogbook($request)
    {
        $data = $request->validated();

        // dd($data);

        DB::transaction(function () use ($data) {
            static::$logbook->update($data);
        });
    }

    public static function deleteLogbook()
    {
        DB::transaction(function () {
            static::$logbook->delete();
        });
    }
}
