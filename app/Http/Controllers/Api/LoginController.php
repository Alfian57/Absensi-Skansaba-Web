<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nis' => 'required',
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            $data = [
                'message'    => 'Validasi Gagal',
                'error'       => $validate->errors(),
                'data'      => null
            ];

            return response()->json($data, 402);
        } else {
            $credential   = request(['nis', 'password']);
            if (Auth::guard('student')->attempt($credential)) {
                $grade = Student::where('nis', $request->nis)->select('grade_id')->first();
                $grade = Grade::where('id', $grade->grade_id)->first();

                $student = Student::where('nis', $request->nis)
                    ->select('id', 'nisn', 'nis', 'name', 'date_of_birth', 'gender', 'address', 'grade_id as grade', 'entry_year', 'profile_pic')
                    ->first();

                $student->grade = $grade->name;

                $token = $student->createToken('token')->plainTextToken;

                $data = [
                    'message' => 'Login Berhasil',
                    'errors' => null,
                    'data' => [
                        'student' => $student,
                        'access_token' => $token,
                        'token_type' => 'Bearer'
                    ]
                ];
                return response()->json($data, 200);
            } else {
                $data  = [
                    'message'   => 'NIS atau Password Salah',
                    'errors'    => null,
                    'data'      => null
                ];
                return response()->json($data, 401);
            }
        }
    }

    public function logout(Request $request)
    {
        // Auth::guard('student')->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        $request->user()->currentAccessToken()->delete();
        // Auth::guard('student')->user()->tokens()->delete();
        $data   = [
            'message'       => 'Logout Berhasil',
            'errors'    => null,
            'data'      => null
        ];
        return response()->json($data, 200);
    }

    public function profile()
    {
        $id = Auth::guard('sanctum')->user()->id;
        $student = Student::where('id', $id)
            ->select('id', 'nisn', 'nis', 'name', 'date_of_birth', 'gender', 'address', 'grade_id as grade', 'entry_year', 'profile_pic')
            ->first();

        $grade = Grade::where('id', $student->grade)->first();

        $student->grade = $grade->name;

        $data = [
            'message'       => 'Berhasil Mendapatkan Data Siswa',
            'errors'    => null,
            'data'    => [
                'student' => $student,
            ],
        ];

        return response()->json($data, 200);
    }

    public function changePassword(Request $request)
    {
        $id = Auth::guard('sanctum')->user()->id;
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message'       => 'Ada Data yang Masih Kosong',
                'errors'    => $validator->errors(),
                'data'    => null,
            ];

            return response()->json($data);
        }

        $student = Student::where('id', $id)->first();

        if ($student == null) {
            $data = [
                'message'       => 'ID Siswa Tidak Ditemukan',
                'errors'    => null,
                'data'    =>  null,
            ];

            return response()->json($data);
        }

        if (!Hash::check($request->oldPassword, $student->password)) {
            $data = [
                'message' => 'Password Lama Salah',
                'errors' => null,
                'data' =>  null,
            ];

            return response()->json($data);
        }

        Student::where('id', $id)
            ->update([
                'password' => Hash::make($request->newPassword)
            ]);


        $student = Student::where('id', $id)
            ->select('id', 'nisn', 'nis', 'name', 'date_of_birth', 'gender', 'address', 'grade_id as grade', 'entry_year', 'profile_pic')
            ->first();

        $grade = Grade::where('id', $student->grade)->first();

        $student->grade = $grade->name;

        $data = [
            'message'       => 'Password Berhasil Diganti',
            'errors'    => null,
            'data'    => [
                'student' => $student
            ],
        ];

        return response()->json($data, 200);
    }

    // public function edit(Request $request, $id)
    // {
    //     $validate = Validator::make($request->all(), [
    //         'name'      => 'required',
    //         'email'      => 'required|email',
    //         'username'  => 'required',
    //         'password'  => 'required',
    //     ]);

    //     if ($validate->fails()) {
    //         $data = [
    //             'success'    => false,
    //             'msg'       => 'Validation error',
    //             'errors'    => $validate->errors(),
    //             'data'      => null
    //         ];

    //         return response()->json($data, 422);
    //     } else {
    //         $user = User::where('id', $id)->update([
    //             'name' => $request['name'],
    //             'email' => $request['email'],
    //             'username' => $request['username'],
    //             'password' => Hash::make($request['password']),
    //         ]);

    //         if ($user) {
    //             $data = [
    //                 'success'    => true,
    //                 'msg'       => 'Edit Admin Berhasil',
    //                 'errors'    => null,
    //                 'data'      => null
    //             ];

    //             return response()->json($data, 200);
    //         } else {
    //             $data = [
    //                 'success'    => false,
    //                 'msg'       => 'Edit Admin Gagal',
    //                 'errors'    => null,
    //                 'data'      => null
    //             ];

    //             return response()->json($data, 200);
    //         }
    //     }
    // }
}