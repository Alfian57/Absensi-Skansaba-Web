<?php

namespace App\Http\Controllers\Api;

use App\Models\Schedule;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\SkippingClass;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        if (!request('day')) {
            $response = [
                'message'       => "Masukan Field 'day'",
                'errors'    => null,
                'data'      => null
            ];
            return response()->json($response);
        }

        $day = request('day');
        $student = Auth::guard('sanctum')->user();

        if ($student == null) {
            $response = [
                'message'       => 'Murid Tidak Ditemukan',
                'errors'    => null,
                'data'      => null
            ];
            return response()->json($response);
        }

        $schedules = Schedule::where('grade_id', $student->grade->id)
            ->where('day', $day)
            ->orderBy('time_start', 'ASC')
            ->join('grades', 'schedules.grade_id', '=', 'grades.id')
            ->join('subjects', 'schedules.subject_id', '=', 'subjects.id')
            ->select('schedules.time_start', 'schedules.time_finish', 'grades.name as gradeName', 'subjects.name as subjectName')
            ->get();

        $response = [
            'message'       => 'Jadwal Ditemukan',
            'errors'    => null,
            'data'      => [
                'schedules' => $schedules
            ]
        ];
        return response()->json($response);
    }

    public function getClassSchedules($studentId)
    {
        $response = [];
        $student = Student::where('id', $studentId)->first();
        if ($student == null) {
            return response()->json($response);
        }

        $grade = Grade::where('id', $student->grade_id)->first();
        if ($grade == null) {
            return response()->json($response);
        }

        //HARI

        $pickedSubject = SkippingClass::where('student_id', $student->id)
            ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))
            ->pluck('subject_id');

        $schedules = Schedule::where('grade_id', $grade->id)
            ->whereNotIn('subject_id', $pickedSubject)
            ->with('subject')
            ->get();

        foreach ($schedules as $schedule) {
            $response[] = [
                'id' => $schedule->subject->id,
                'name' => $schedule->subject->name,
                'time_start' => $schedule->time_start,
                'time_finish' => $schedule->time_finish,
            ];
        }

        return response()->json($response);
    }
}