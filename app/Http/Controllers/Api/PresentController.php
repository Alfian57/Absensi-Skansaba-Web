<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\OtherData;
use App\Models\Student;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\LaravelIgnition\Support\LivewireComponentParser;

class PresentController extends Controller
{
    public function store(Request $request)
    {
        //Validasi (Start)
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'key' => 'required'
        ]);

        if ($validator->fails()) {
            $response   = [
                'message'       => 'Validasi Error',
                'errors'    => $validator->errors(),
                'data'      => null
            ];

            return response()->json($response);
        }
        //Validasi (End)

        $waktuMulai = OtherData::where('name', 'Waktu Mulai')->first();
        $waktuMulai = $waktuMulai->value;

        $waktuBerakhir = OtherData::where('name', 'Waktu Berakhir')->first();
        $waktuBerakhir = $waktuBerakhir->value;

        $waktuTerlambat = OtherData::where('name', 'Waktu Terlambat')->first();
        $waktuTerlambat = $waktuTerlambat->value;

        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $now = $now->toTimeString();

        $key = OtherData::where('name', "Kunci Absensi")->first();

        try {
            if ($request->key == $key->value) {
                $student = Student::where('id', $request->id)->get();
                if (!$student->isEmpty()) {
                    $attendances = Attendance::where('student_id', $student[0]->id)
                        ->where('present_date', date("Y-m-d"))
                        ->first();

                    if ($attendances->desc != 'masuk' && $attendances->desc != 'terlambat') {
                        if (strtotime($now) < strtotime($waktuMulai) || strtotime($now) > strtotime($waktuBerakhir)) {
                            $response   = [
                                'message'       => 'Sesi Absensi Berakhir',
                                'errors'    => null,
                                'data'      => null
                            ];

                            return response()->json($response);
                        }

                        $data['student_id'] = $student[0]->id;
                        $data['present_date'] = date("Y-m-d");
                        $data['present_time'] = $now;

                        if (strtotime($waktuTerlambat) > strtotime($now)) {
                            $data['desc'] = 'masuk';
                        } else {
                            $data['desc'] = 'terlambat';
                        }


                        $id = Attendance::where('student_id', $data['student_id'])->where('present_date', date("Y-m-d"))->first();
                        $id = $id->id;
                        Attendance::where('id', $id)->update($data);

                        $studentResponse = Student::where('id', $student[0]->id)
                            ->select('id', 'nisn', 'nis', 'name', 'date_of_birth', 'gender', 'address', 'grade_id as grade', 'entry_year', 'profile_pic')
                            ->first();

                        $grade = Grade::where('id', $studentResponse->grade)->first();

                        $studentResponse->grade = $grade->name;

                        if ($data['desc'] == 'masuk') {
                            $response = [
                                'message'       => 'Berhasil Melakukan Absensi',
                                'errors'    => null,
                                'data'    => [
                                    'student' => $studentResponse
                                ],
                            ];
                        } else {
                            $response = [
                                'message'       => 'Terlambat Melakukan Absensi',
                                'errors'    => null,
                                'data'    => [
                                    'student' => $studentResponse
                                ],
                            ];
                            return response()->json($response, 200);
                        }
                    } else {
                        $response = [
                            'message'       => 'Anda Sudah Melakukan Absensi',
                            'errors'    => null,
                            'data'      => null
                        ];
                        return response()->json($response);
                    }
                } else {
                    $response = [
                        'message'       => 'ID Tidak Ditemukan',
                        'errors'    => null,
                        'data'      => null
                    ];
                    return response()->json($response);
                }
            } else {
                $response = [
                    'message'       => 'QR Code Tidak Valid',
                    'errors'    => null,
                    'data'      => null
                ];
                return response()->json($response);
            }
        } catch (Exception $e) {
            $response = [
                'message'       => 'Tidak Bisa Melakukan Absensi Saat Ini',
                'errors'    => null,
                'data'    => null,
            ];
            return response()->json($response);
        }
    }

    public function getAttendances()
    {
        $attendances = Attendance::latest()->where('present_date', date("Y-m-d"))
            ->where('desc', '!=', 'alpha')->get();

        $response = [];

        foreach ($attendances as $attendance) {
            $photo = null;
            if ($attendance->student->profile_pic != null) {
                $photo = asset('storage/' . $attendance->student->profile_pic);
            }
            $response[] = [
                'name' => $attendance->student->name,
                'grade' => $attendance->student->grade->name,
                'photo' => $photo,
                'desc' => $attendance->desc
            ];
        }

        return response()->json($response);
    }

    public function getAttendancesWithGrade($grade)
    {
        $attendances = Attendance::latest()->where('present_date', date("Y-m-d"))
            ->where('desc', '!=', 'alpha')->get();

        $grade = Grade::where('slug', request('grade'))->first();

        $students = Student::where('grade_id', $grade->id)->pluck('id');

        $attendances->whereIn('student_id', $students);

        $response = [];

        foreach ($attendances as $attendance) {
            $photo = null;
            if ($attendance->student->profile_pic != null) {
                $photo = asset('storage/' . $attendance->student->profile_pic);
            }
            $response[] = [
                'name' => $attendance->student->name,
                'grade' => $attendance->student->grade->name,
                'photo' => $photo,
                'desc' => $attendance->desc
            ];
        }

        return response()->json($response);
    }
}