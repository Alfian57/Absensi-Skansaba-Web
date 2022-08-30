@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center">Detail Data Siswa</h2>
    <div class="row mt-5 mb-3">
        <div class="col-lg-3 ms-3">
            @if ($student->profile_pic)
                <img src="{{ asset('storage/' . $student->profile_pic) }}" alt="Profil" class="img-fluid show">
            @else
                <p class="text-danger">Siswa Ini Tidak Memiliki Foto Profil</p>
            @endif
        </div>
        <div class="col-lg-5 offset-lg-1">
            <table>
                <tr>
                    <td style="width: 30%">Nama</td>
                    <td>:</td>
                    <td>{{ $student->name }}</td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td>{{ $student->nis }}</td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td>{{ $student->nisn }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $student->date_of_birth }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>
                        @if ($student->gender == 0)
                            <p>Laki-laki</p>
                        @else
                            <p>Perempuan</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $student->address }}</td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td>{{ $student->grade->name }}</td>
                </tr>
                <tr>
                    <td>Tahun Masuk</td>
                    <td>:</td>
                    <td>{{ $student->entry_year }}</td>
                </tr>
            </table>
        </div>
        <div class="text-end">
            <a href="/admin/students" class="btn btn-danger btn-sm mt-3 me-5">Kembali</a>
        </div>
    </div>
@endsection
