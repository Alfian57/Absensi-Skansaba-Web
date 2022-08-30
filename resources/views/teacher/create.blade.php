@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Tambah Guru</h2>

    <form action="/admin/teachers" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-3">
            <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP Guru</label>
            <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP"
                value="{{ old('nip') }}" required autofocus>
            @error('nip')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label @error('name') is-invalid @enderror">Nama Guru</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nama"
                value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label @error('email') is-invalid @enderror">Email Guru</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label for="password" class="form-label @error('password') is-invalid @enderror">Password Guru</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                value="{{ old('password') }}" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}
        <div class="mb-3">
            <label for="profile_pic" class="form-label @error('profile_pic') is-invalid @enderror">Foto Guru</label>
            <input class="form-control" type="file" name="profile_pic" id="profile_pic">
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
