@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Siswa</h2>

    <!-- Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        Filter
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/students" method="GET" class="d-flex">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input class="form-control form-control-sm" name="nisn" type="text"
                                placeholder="NISN Siswa"
                                value="@if (request('nisn')) {{ request('nisn') }} @endif">
                        </div>
                        <div class="mb-3">
                            <label for="grade" class="form-label">Kelas</label>
                            <select class="form-select form-select-sm" id="grade" name="grade"
                                aria-label=".form-select-sm example">
                                <option value="" @if (!request('grade')) selected @endif>Semua Kelas
                                </option>
                                @foreach ($grades as $grade)
                                    @if (request('grade') == $grade->slug)
                                        <option value="{{ $grade->slug }}" selected>{{ $grade->name }}</option>
                                    @else
                                        <option value="{{ $grade->slug }}">{{ $grade->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-sm"><img src="/img/search.png"
                                    class="icon"></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="text-end mb-3">
        <a href="/admin/students/create" class="btn btn-success btn-sm">+ Tambah Siswa</a>
        <a href="/admin/students/export" class="btn btn-primary btn-sm">Download Data (Excel)</a>
        <a class="btn btn-info btn-sm ml-auto text-white" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-search" aria-hidden="true"></i>
            Filter
        </a>
    </div>

    @if ($students->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="/img/bg-present.svg" alt="Data Absensi Kosong" class="img-fluid w-100 mt-3">
                <h3 class="text-danger text-center mt-2">Data Masih Kosong</h3>
            </div>
        </div>
    @else
        <div class="table-responsive mt-3">
            <table class="table table-striped datatable-without-search">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Image</th>
                        <th class="action">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->nisn }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->grade->name }}</td>

                            @if ($student->profile_pic)
                                <td>
                                    <div class="profile-pic-box rounded-circle">
                                        <a href="{{ asset('storage/' . $student->profile_pic) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $student->profile_pic) }}" alt="Profile"
                                                class="img-fluid">
                                        </a>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <p class="text-danger">Tidak Ada Foto</p>
                                </td>
                            @endif

                            <td>
                                <a href="/admin/students/{{ $student->nisn }}" class="btn btn-info btn-sm my-2 btn-action">
                                    <img src="/img/eye.png" alt="Show" class="icon">
                                </a>
                                <a href="/admin/students/{{ $student->nisn }}/edit"
                                    class="btn btn-warning btn-sm my-2 btn-action">
                                    <img src="/img/edit.png" alt="Edit" class="icon">
                                </a>
                                <form action="/admin/students/{{ $student->nisn }}" method="POST" class="d-inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm my-2 btn-action btn-delete">
                                        <img src="/img/delete.png" alt="Delete" class="icon">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
