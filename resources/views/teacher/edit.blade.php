@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Ubah Data Guru</h2>

    <form action="/admin/teachers/{{ $teacher->nip }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="hidden" name="password" value="{{ $teacher->password }}">
        <input type="hidden" name="old_nip" value="{{ $teacher->nip }}">
        <input type="hidden" name="old_email" value="{{ $teacher->email }}">
        <input type="hidden" name="old_profile_pic" value="{{ $teacher->profile_pic }}">
        <div class="mb-3 mt-3">
            <label for="nip" class="form-label">NIP Guru</label>
            <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip"
                placeholder="NIP" value="{{ old('nip', $teacher->nip) }}" required autofocus>
            @error('nip')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Guru</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                placeholder="Nama" value="{{ old('name', $teacher->name) }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Guru</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                placeholder="Email" value="{{ old('email', $teacher->email) }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="profile_pic" class="form-label">Foto Guru</label>
            @if ($teacher->profile_pic)
                <img src="{{ asset('storage/' . $teacher->profile_pic) }}" alt="Profile" class="preview d-block mb-2">
                <input class="form-check-input" name="deleteImage" type="checkbox" value="true" id="deleteImage">
                <label class="form-check-label mb-2" for="deleteImage">
                    <strong>Kosongkan Gambar</strong>
                </label>
            @else
                <p class="text-danger">Guru Ini Tidak Memiliki Foto Profil</p>
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
            <a href="/admin/teachers" class="btn btn-danger btn-sm mt-3">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm mt-3">Submit</button>
        </div>
    </form>
@endsection
