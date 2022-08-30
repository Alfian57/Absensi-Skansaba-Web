@extends('layouts.main')


@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Tambah Siswa</h2>

    <form action="/admin/students" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-3">
            <label for="nisn" class="form-label @error('nisn') is-invalid @enderror">NISN Siswa</label>
            <input type="text" class="form-control" name="nisn" id="nisn" placeholder="NISN"
                value="{{ old('nisn') }}" required autofocus>
            @error('nisn')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="nis" class="form-label @error('nis') is-invalid @enderror">NIS Siswa</label>
            <input type="text" class="form-control" name="nis" id="nis" placeholder="NIS"
                value="{{ old('nis') }}" required>
            @error('nis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label @error('name') is-invalid @enderror">Nama Siswa</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nama"
                value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="date_of_birth" class="form-label @error('date_of_birth') is-invalid @enderror">Tanggal Lahir
                Siswa</label>
            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                placeholder="Tanggal Lahir Siswa" value="{{ old('date_of_birth') }}" required>
            @error('date_of_birth')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label @error('gender') is-invalid @enderror">Jenis Kelamin Siswa</label>
            <select class="form-select" name="gender" id="gender" required>
                <option value="0">Laki-laki</option>
                @if (old('gender') == 1)
                    <option value="1" selected>Perempuan</option>
                @else
                    <option value="1">Perempuan</option>
                @endif
            </select>
            @error('gender')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label @error('address') is-invalid @enderror">Alamat Siswa</label>
            <textarea class="form-control" name="address" id="address" rows="3" placeholder="Alamat"
                value="{{ old('address') }}" required>{{ old('address') }}</textarea>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="grade_id" class="form-label @error('grade_id') is-invalid @enderror">Kelas Siswa</label>
            <select class="form-select" name="grade_id" id="grade_id" required>
                @foreach ($grades as $grade)
                    @if (old('grade_id') == $grade->id)
                        <option value="{{ $grade->id }}" selected>{{ $grade->name }}</option>
                    @else
                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endif
                @endforeach
            </select>
            @if ($grades->isEmpty())
                <p class="text-danger">Data Kelas Masih Kosong</p>
            @endif
            @error('grade_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="year" class="form-label @error('entry_year') is-invalid @enderror">Tahun Masuk Siswa</label>
            <input type="number" class="form-control" name="entry_year" value="{{ old('entry_year') }}" id="year"
                placeholder="Tahun Masuk (Contoh: 2019)" size="4" required>
            @error('entry_year')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="profile_pic" class="form-label @error('profile_pic') is-invalid @enderror">Foto Siswa</label>
            <input class="form-control" name="profile_pic" type="file" id="profile_pic">
            @error('profile_pic')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="text-end">
            <a href="/admin/students" class="btn btn-danger btn-sm mt-3">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm mt-3">Submit</button>
        </div>
    </form>
@endsection
