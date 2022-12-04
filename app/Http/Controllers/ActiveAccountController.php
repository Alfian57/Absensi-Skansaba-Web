<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ActiveAccountController extends Controller
{
    public function index()
    {
        Helper::addHistory('/admin/activeAccount', 'Akun Aktif');

        $students = Student::where('already_login', true);

        if (request('grade')) {
            $grade = Grade::where('slug', request('grade'))->first();
            $students->where('grade_id', $grade->id);
        }

        if (request('nisn')) {
            $students->where('grade_id', request('nisn'));
        }

        return view('activeAccount.index', [
            'title' => "Akun Aktif",
            'students' => $students->take(500)
                ->latest()
                ->get(),
            'grades' => Grade::latest()->get()
        ]);
    }

    public function delete($nisn)
    {
        Student::where('nisn', $nisn)->update([
            'already_login' => false
        ]);

        return redirect('/admin/activeAccount')->with('success', 'Data Berhasil Dihapus');
    }
}