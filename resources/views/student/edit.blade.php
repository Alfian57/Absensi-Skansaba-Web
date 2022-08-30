@extends('layouts.main')


@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Ubah Data Siswa</h2>

    <form action="/admin/students/{{ $student->nisn }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="hidden" name="old_profile_pic" value="{{ $student->profile_pic }}">
        <input type="hidden" name="old_nisn" value="{{ $student->nisn }}">
        <input type="hidden" name="old_nis" value="{{ $student->nis }}">
        <div class="mb-3 mt-3">
            <label for="nisn" class="form-label">NISN Siswa</label>
            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn"
                placeholder="NISN" value="{{ old('nisn', $student->nisn) }}" required autofocus>
            @error('nisn')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="nis" class="form-label">NIS Siswa</label>
            <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis"
                placeholder="NIS" value="{{ old('nis', $student->nis) }}" required>
            @error('nis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                placeholder="Nama" value="{{ old('name', $student->name) }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="date_of_birth" class="form-label">Tanggal Lahir
                Siswa</label>
            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                id="date_of_birth" placeholder="Tanggal Lahir Siswa"
                value="{{ old('date_of_birth', $student->date_of_birth) }}" required>
            @error('date_of_birth')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Jenis Kelamin Siswa</label>
            <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender" required>
                <option value="0">Laki-laki</option>
                @if (old('gender', $student->gender) == 1)
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
            <label for="address" class="form-label">Alamat Siswa</label>
            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3"
                placeholder="Alamat" required>{{ old('address', $student->address) }}</textarea>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="grade_id" class="form-label">Kelas Siswa</label>
            <select class="form-select @error('grade_id') is-invalid @enderror" name="grade_id" id="grade_id" required>
                @foreach ($grades as $grade)
                    @if (old('grade_id', $student->grade_id) == $grade->id)
                        <option value="{{ $grade->id }}" selected>{{ $grade->name }}</option>
                    @else
                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endif
                @endforeach
            </select>
            @error('grade_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="year" class="form-label">Tahun Masuk Siswa</label>
            <input type="number" class="form-control @error('entry_year') is-invalid @enderror" name="entry_year"
                value="{{ old('entry_year', $student->entry_year) }}" id="year"
                placeholder="Tahun Masuk (Contoh: 2019)" size="4" required>
            @error('entry_year')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="profile_pic" class="form-label">Foto Siswa</label>
            @if ($student->profile_pic)
                <img src="{{ asset('storage/' . $student->profile_pic) }}" alt="Profile" class="preview d-block mb-2">
                <input class="form-check-input" name="deleteImage" type="checkbox" value="true" id="deleteImage">
                <label class="form-check-label mb-2" for="deleteImage">
                    <strong>Kosongkan Gambar</strong>
                </label>
            @else
                <p class="text-danger">Siswa Ini Tidak Memiliki Foto Profil</p>
            @endif
            <input class="form-control @error('profile_pic') is-invalid @enderror" name="profile_pic" type="file"
                id="profile_pic">
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
