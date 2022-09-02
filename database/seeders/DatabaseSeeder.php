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

        //User::factory(3)->create();
        Grade::factory(48)->create();
        Teacher::factory(50)->create();
        Student::factory(2000)->create();

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

        User::factory()->create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'username' => "Admin",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        User::factory()->create([
            'name' => "Alfian Gading Saputra",
            'email' => "gading@gmail.com",
            'username' => "Gading",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        User::factory()->create([
            'name' => "Fajar Maulana",
            'email' => "fajar@gmail.com",
            'username' => "Fajar",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        User::factory()->create([
            'name' => "Rasyid Prayogo",
            'email' => "rasyid@gmail.com",
            'username' => "Rasyid",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

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