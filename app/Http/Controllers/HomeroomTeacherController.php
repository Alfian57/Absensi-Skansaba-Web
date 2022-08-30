<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\HomeroomTeacher;
use App\Http\Requests\StoreHomeroomTeacherRequest;
use App\Http\Requests\UpdateHomeroomTeacherRequest;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Support\Str;

class HomeroomTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Helper::addHistory('/admin/homeroomTeachers', 'Wali Kelas');

        $homeroomTeachers = HomeroomTeacher::latest()->with('teacher', 'grade');

        $data = [
            'title' => 'Semua Wali Kelas',
            'homeroomTeachers' => $homeroomTeachers->get(),
        ];

        return view('homeroomTeacher.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Helper::addHistory('/admin/homeroomTeachers/create', 'Tambah Wali Kelas');

        $homeroomTeachers = HomeroomTeacher::pluck('teacher_id');
        if ($homeroomTeachers->isEmpty()) {
            $homeroomTeachers = [0];
        }

        $gradesForShow = HomeroomTeacher::pluck('grade_id');
        if ($gradesForShow->isEmpty()) {
            $gradesForShow = [0];
        }

        $data = [
            'title' => 'Tambah Wali Kelas',
            'teachers' => Teacher::latest()->whereNotIn('id', $homeroomTeachers)->get(),
            'grades' => Grade::latest()->whereNotIn('id', $gradesForShow)->get(),
        ];

        return view('homeroomTeacher.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHomeroomTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeroomTeacherRequest $request)
    {
        $validatedData = $request->validate([
            'teacher_id' => 'required',
            'grade_id' => 'required'
        ]);

        HomeroomTeacher::create($validatedData);

        return redirect('/admin/homeroomTeachers')->with('success', 'Data Wali Kelas Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeroomTeacher  $homeroomTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(HomeroomTeacher $homeroomTeacher)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeroomTeacher  $homeroomTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeroomTeacher $homeroomTeacher)
    {
        Helper::addHistory('/admin/homeroomTeachers/' . $homeroomTeacher->id . '/edit', 'Ubah Wali Kelas');

        $homeroomTeachers = HomeroomTeacher::pluck('teacher_id');
        if ($homeroomTeachers->isEmpty()) {
            $homeroomTeachers = [0];
        }

        $gradesForShow = HomeroomTeacher::pluck('grade_id');
        if ($gradesForShow->isEmpty()) {
            $gradesForShow = [0];
        }

        $data = [
            'title' => 'Tambah Wali Kelas',
            'homeroomTeacher' => $homeroomTeacher,
            'teachers' => Teacher::latest()->whereNotIn('id', $homeroomTeachers)->get(),
            'grades' => Grade::latest()->whereNotIn('id', $gradesForShow)->get(),
        ];

        return view('homeroomTeacher.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHomeroomTeacherRequest  $request
     * @param  \App\Models\HomeroomTeacher  $homeroomTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeroomTeacherRequest $request, HomeroomTeacher $homeroomTeacher)
    {
        $validatedData = $request->validate([
            'teacher_id' => 'required',
            'grade_id' => 'required'
        ]);

        HomeroomTeacher::where('id', $homeroomTeacher->id)->update($validatedData);

        return redirect('/admin/homeroomTeachers')->with('success', 'Data Wali Kelas Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeroomTeacher  $homeroomTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeroomTeacher $homeroomTeacher)
    {
        HomeroomTeacher::destroy($homeroomTeacher->id);

        return redirect('/admin/homeroomTeachers')->with('success', 'Data Wali Kelas ' . $homeroomTeacher->teacher->name . ' Berhasil Dihapus');
    }
}