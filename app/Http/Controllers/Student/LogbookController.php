<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Enums\GenderEnum;
use App\Http\Requests\StoreLogbookRequest;
use App\Http\Requests\UpdateLogbookRequest;
use App\Http\Services\LogbookService;
use App\Models\LogBook;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $logbooks = LogBook::where('user_id', $userId)->get();
        return view('student.logbook.index')
            ->with(compact('logbooks'));
    }

    public function create()
    {
        $genders = GenderEnum::cases();
        // dd($genders);
        return view('student.logbook.create')
            ->with(compact('genders'));
    }

    public function edit($id)
    {
        $userId = auth()->user()->id;

        $logbook = LogbookService::logbookDetail($id, $userId, 'student')->fetch();
        $genders = GenderEnum::cases();
        return view('student.logbook.edit')
            ->with(compact('logbook', 'genders'));
    }

    public function store(StoreLogbookRequest $request)
    {
        $userId = auth()->user()->id;

        LogbookService::storeLogbook($request, $userId);
        return redirect()->route('student.logbook_index')->with('success', 'Logbook berhasil ditambahkan');
    }

    public function update(UpdateLogbookRequest $request, $id)
    {
        $userId = auth()->user()->id;
        LogbookService::logbookDetail($id, $userId, 'student')->updateLogbook($request);

        return redirect()->route('student.logbook_index')->with('success', 'Logbook berhasil diperbarui');
    }

    public function destroy($id)
    {
        $userId = auth()->user()->id;
        LogbookService::logbookDetail($id, $userId, 'student')->deleteLogbook();
        return redirect()->route('student.logbook_index')->with('success', 'Logbook berhasil dihapus');
    }
}
