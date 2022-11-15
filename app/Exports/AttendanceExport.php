<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\SkippingClass;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $grade;
    protected $date;

    function __construct($grade, $date)
    {
        $this->grade = $grade;
        $this->date = $date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // $attendances = SkippingClass::leftJoin('students', 'skipping_classes.student_id', '=', 'students.id')
        //     ->join('subjects', 'subjects.id', '=', 'skipping_classes.subject_id')
        //     ->join('grades', 'students.grade_id', '=', 'grades.id')
        //     ->join('attendances', 'attendances.student_id', '=', 'students.id')
        //     ->where('grades.slug', $this->grade)
        //     ->where('attendances.present_date', $this->date)
        //     ->select('students.name as nama', 'students.nisn', 'grades.name as kelas', 'attendances.desc', 'attendances.present_date', 'subjects.name')
        //     ->orderBy('attendances.created_at', 'DESC')
        //     ->get();

        $attendances = Attendance::orderBy('attendances.created_at', 'DESC')
            ->join('students', 'students.id', '=', 'attendances.student_id')
            ->join('grades', 'students.grade_id', '=', 'grades.id')
            ->join("skipping_classes", "students.id", "=", "students.id")
            ->join('subjects', 'subjects.id', '=', 'skipping_classes.subject_id')
            ->where('grades.slug', $this->grade)
            ->where('attendances.present_date', $this->date)
            ->select('students.name as nama', 'students.nisn', 'grades.name as kelas', 'attendances.desc', 'attendances.present_date', 'subjects.name')
            ->get();

        return $attendances;
    }

    public function headings(): array
    {
        return ['Nama', 'NISN', 'Kelas', "Keterangan", "Tanggal Absensi", "Pelajaran Yang Tidak Diikuti"];
    }
}