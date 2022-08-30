@extends('layouts.main')

@section('content')
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="/admin/home">
                <img src="/img/home.png" alt="Home" class="icon">
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Ganti Foto Profile</a>
        </li>
    </ul>

    <h2 class="text-center mt-3">Ganti Foto Profile</h2>
    <form action="/admin/changePic" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf

        <input type="hidden" name="old_profile_pic" value="{{ $user->profile_pic }}">

        <div class="mb-3">
            <label for="profile_pic" class="form-label">Foto Guru</label>
            @if ($user->profile_pic)
                <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile" class="preview d-block mb-2">
                <input class="form-check-input" name="deleteImage" type="checkbox" value="true" id="deleteImage">
                <label class="form-check-label mb-2" for="deleteImage">
                    <strong>Kosongkan Gambar</strong>
                </label>
            @else
                <p class="text-danger">User Ini Tidak Memiliki Foto Profil</p>
            @endif

            <input class="form-control @error('profile_pic') is-invalid @enderror" name="profile_pic" type="file"
                id="profile_pic" value="{{ old('oldPassword') }}">
            @error('profile_pic')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="text-end">
            <a href="/admin/home" class="btn btn-danger btn-sm">Kembali</a>
            <button class="btn btn-primary btn-sm">Submit</button>
        </div>
    </form>
@endsection
