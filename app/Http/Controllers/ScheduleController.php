<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Helper::addHistory('/admin/schedules', 'Jadwal Mengajar');

        $data = [
            'title' => 'Semua Jadwal Pelajaran',
            'schedules' => Schedule::latest()->with('grade', 'subject', 'teacher')->get(),
        ];

        return view('schedule.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Helper::addHistory('/admin/schedules/create', 'Tambah Jadwal Mengajar');

        $data = [
            'title' => 'Tambah Jadwal Pelajaran',
            'teachers' => Teacher::latest()->get(),
            'subjects' => Subject::latest()->get(),
            'grades' => Grade::latest()->get()
        ];

        return view('schedule.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleRequest $request)
    {
        $request->class_year = strtolower($request->class_year);
        $validatedData = $request->validate([
            'training_year' => 'required',
            'class_year' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'day' => 'required',
            'grade_id' => 'required',
            'time_start' => 'required',
            'time_finish' => 'required',
        ]);

        Schedule::create($validatedData);

        return redirect('/admin/schedules')->with('success', 'Jadwal Pelajaran Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        Helper::addHistory('/admin/schedules/' . $schedule->id . '/edit', 'Ubah Jadwal Mengajar');

        $data = [
            'title' => 'Edit Data Jadwal Pelajaran',
            'schedule' => $schedule,
            'teachers' => Teacher::latest()->get(),
            'subjects' => Subject::latest()->get(),
            'grades' => Grade::latest()->get()
        ];

        return view('schedule.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $request->class_year = strtolower($request->class_year);
        $validatedData = $request->validate([
            'training_year' => 'required',
            'class_year' => 'required|in:ganjil,genap',
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'day' => 'required',
            'grade_id' => 'required',
            'time_start' => 'required',
            'time_finish' => 'required',
        ]);

        Schedule::where('id', $schedule->id)->update($validatedData);

        return redirect('/admin/schedules')->with('success', 'Jadwal Pelajaran Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        Schedule::destroy($schedule->id);

        return redirect('/admin/schedules')->with('success', 'Jadwal Pelajaran Berhasil Dihapus');
    }

    public function mySchedule()
    {
        session()->push('history', [
            'route' => '/admin/myschedules',
            'name' => 'Jadwalku'
        ]);

        return view('schedule.myschedule', [
            'title' => 'My Schedule',
            'schedules' => Schedule::where('teacher_id', Auth::guard('teacher')->user()->id)->latest()->get(),
        ]);
    }
}