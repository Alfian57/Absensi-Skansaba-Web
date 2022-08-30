<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\UpdateOtherDataRequest;
use App\Models\OtherData;
use Illuminate\Support\Str;
use App\Models\Grade;

class OtherDataController extends Controller
{
    public function index()
    {
        Helper::addHistory('/admin/otherData', 'Data Lain');

        $data = [
            'title' => 'Lain-lain',
            'otherDatas' => OtherData::orderBy('id', "ASC")->get(),
        ];
        return view('otherData.index', $data);
    }

    public function edit($id)
    {
        Helper::addHistory('/admin/otherData' . $id . "/edit", 'Ubah Data Lain');

        $otherData = OtherData::where('id', $id)->first();
        if ($otherData == null) {
            return redirect('/admin/otherData');
        }

        if ($otherData->name == "Kunci Absensi") {
            OtherData::where('name', 'Kunci Absensi')->update([
                'value' => Str::random(20)
            ]);

            return redirect('/admin/otherData')->with('success', 'Data Berhasil Diperbarui');
        }

        $data = [
            'title' => 'Edit Data',
            'otherData' => $otherData,
        ];
        return view('otherData.edit', $data);
    }

    public function update(UpdateOtherDataRequest $request)
    {
        $waktuMulai = OtherData::where('name', 'Waktu Mulai')->first();
        $waktuMulai = $waktuMulai->value;

        $waktuBerakhir = OtherData::where('name', 'Waktu Berakhir')->first();
        $waktuBerakhir = $waktuBerakhir->value;

        $validatedData = $request->validate([
            'name' => 'required',
            'value' => 'required'
        ]);

        if ($request->name == "Kunci Absensi") {
            $request->validate([
                'value' => 'size:20'
            ]);
        } else if ($request->name == "Waktu Mulai") {
            if (strtotime($waktuBerakhir) < strtotime($request->value)) {
                return back()->with('errorMessage', 'Value must be less than "Waktu Berakhir"')
                    ->with('oldValue', $request->value);
            }
        } else if ($request->name == "Waktu Berakhir") {
            if (strtotime($waktuMulai) > strtotime($request->value)) {
                return back()->with('errorMessage', 'Value must be grather than "Waktu Mulai"')
                    ->with('oldValue', $request->value);
            }
        } else if ($request->name == "Waktu Terlambat") {
            if (strtotime($waktuMulai) > strtotime($request->value) || strtotime($waktuBerakhir) < strtotime($request->value)) {
                return back()->with('errorMessage', 'Value must be grather than "Waktu Mulai" and less than "Waktu Berakhir"')
                    ->with('oldValue', $request->value);
            }
        } else if ($request->name == "Hari Masuk") {
            $days = [];
            if ($request->Senin) {
                $days[] = 'Senin';
            }
            if ($request->Selasa) {
                $days[] = 'Selasa';
            }
            if ($request->Rabu) {
                $days[] = 'Rabu';
            }
            if ($request->Kamis) {
                $days[] = 'Kamis';
            }
            if ($request->Jumat) {
                $days[] = 'Jumat';
            }
            if ($request->Sabtu) {
                $days[] = 'Sabtu';
            }
            if ($request->Minggu) {
                $days[] = 'Minggu';
            }

            $validatedData['value'] = implode(", ", $days);
        }

        OtherData::where('id', $request->id)->update($validatedData);

        return redirect('/admin/otherData')->with('success', 'Data Berhasil Diperbarui');
    }
}