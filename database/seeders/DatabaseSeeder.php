<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\OtherData;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(100)->create();
        // Grade::factory(100)->create();
        // Teacher::factory(100)->create();
        // Student::factory(50)->create();
        // Subject::factory(100)->create();
        // Schedule::factory(100)->create();
        // HomeroomTeacher::factory(100)->create();
        // Attendance::factory(100)->create();

        // OtherData::factory()->create([
        //     'name' => 'Present Key',
        //     'value' => Str::random(20),
        // ]);

        User::factory(3)->create();
        Grade::factory(10)->create();
        Teacher::factory(10)->create();
        Student::factory(50)->create();

        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $now = $now->toTimeString();

        $studentsId = Student::pluck('id');
        foreach ($studentsId as $id) {
            Attendance::create([
                'student_id' => $id,
                'desc' => 'alpha',
                'present_date' => date("Y-m-d"),
                'present_time' => $now
            ]);
        }

        OtherData::factory()->create([
            'name' => 'Kunci Absensi',
            'value' => Str::random(20),
        ]);

        OtherData::factory()->create([
            'name' => 'Waktu Mulai',
            'value' => '07:00',
        ]);

        OtherData::factory()->create([
            'name' => 'Waktu Terlambat',
            'value' => '07:30',
        ]);

        OtherData::factory()->create([
            'name' => 'Waktu Berakhir',
            'value' => '07:45',
        ]);

        OtherData::factory()->create([
            'name' => 'Hari Masuk',
            'value' => 'Senin, Selasa, Rabu, Kamis, Jumat',
        ]);
    }
}