<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Grade;
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
        $attendances = Attendance::orderBy('attendances.created_at', 'DESC')
            ->join('students', 'students.id', '=', 'attendances.student_id')
            ->join('grades', 'students.grade_id', '=', 'grades.id')
            ->leftJoin("skipping_classes", "students.id", "=", "skipping_classes.student_id")
            ->join('subjects', 'subjects.id', '=', 'skipping_classes.subject_id')
            ->where('grades.slug', $this->grade)
            ->where('attendances.present_date', $this->date)
            ->select('students.name as nama', 'students.nisn', 'grades.name as kelas', 'attendances.desc', 'attendances.present_date', 'subjects.name');

        return $attendances->get();
    }

    public function headings(): array
    {
        return ['Nama', 'NISN', 'Kelas', "Keterangan", "Tanggal Absensi", "Pelajaran Yang Tidak Diikuti"];
    }
}