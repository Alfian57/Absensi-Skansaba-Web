@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Ubah Data Mata Pelajaran</h2>
    <form action="/admin/subjects/{{ $subject->slug }}" method="POST">
        @method('put')
        @csrf
        <input type="hidden" name="oldName" value="{{ $subject->name }}">
        <div class="mb-3 mt-3">
            <label for="name"
                class="form-label @error('name') is-invalid @enderror @if (session()->has('nameError')) is-invalid @endif">Nama
                Mata Pelajaran</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Mata Pelajaran"
                value="{{ old('name', $subject->name) }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            @if (session()->has('nameError'))
                <div class="invalid-feedback">
                    {{ session('nameError') }}
                </div>
            @endif
        </div>

        <div class="text-end">
            <a href="/admin/subjects" class="btn btn-danger btn-sm mt-3">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm mt-3">Submit</button>
        </div>
    </form>
@endsection
