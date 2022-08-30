<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $attendances = Attendance::orderBy('attendances.created_at', 'DESC')
            ->join('students', 'students.id', '=', 'attendances.student_id')
            ->join('grades', 'students.grade_id', '=', 'grades.id')
            ->select('students.name as nama', 'students.nisn', 'grades.name as kelas', 'attendances.desc', 'attendances.present_date');

        return $attendances->get();
    }

    public function headings(): array
    {
        return ['Nama', 'NISN', 'Kelas', "Keterangan", "Tanggal Absensi"];
    }
}