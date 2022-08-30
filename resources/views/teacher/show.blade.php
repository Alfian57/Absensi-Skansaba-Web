@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Detail Data Guru</h2>
    <div class="row mt-5 mb-3">
        <div class="col-lg-3 ms-3">
            @if ($teacher->profile_pic)
                <img src="{{ asset('storage/' . $teacher->profile_pic) }}" alt="Profil" class="img-fluid show">
            @else
                <p class="text-danger">Guru Ini Tidak Memiliki Foto Profil</p>
            @endif
        </div>
        <div class="col-lg-5 offset-lg-1">
            <table>
                <tr>
                    <td style="width: 30%">Nama</td>
                    <td>:</td>
                    <td>{{ $teacher->name }}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{ $teacher->nip }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $teacher->email }}</td>
                </tr>
            </table>
        </div>
        <div class="text-end">
            <a href="/admin/teachers" class="btn btn-danger btn-sm mt-3 me-5">Kembali</a>
        </div>
    </div>
@endsection
