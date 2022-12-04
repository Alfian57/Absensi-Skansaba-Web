<?php

namespace App\Exports;

use App\Models\Attendance;
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
        return Attendance::where('attendances.present_date', $this->date)
            ->join('students', 'attendances.student_id', "=", 'students.id')
            ->join('grades', 'grades.id', '=', 'students.grade_id')
            ->leftJoin('skipping_classes', 'skipping_classes.student_id', "=", 'students.id')
            ->join('subjects', 'subjects.id', '=', 'skipping_classes.subject_id')
            ->where('grades.slug', $this->grade)
            ->select('students.name as nama', 'students.nisn', 'grades.name as kelas', 'attendances.desc', 'attendances.present_date', 'subjects.name')
            ->orderBy('attendances.created_at', 'DESC')
            ->get();


        // return $attendances;
    }

    public function headings(): array
    {
        return ['Nama', 'NISN', 'Kelas', "Keterangan", "Tanggal Absensi", "Pelajaran Yang Tidak Diikuti"];
    }
}