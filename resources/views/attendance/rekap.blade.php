@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Rekap Siswa</h2>

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
                <form action="/admin/attendances/rekap" method="GET" class="d-flex">
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
        <a class="btn btn-primary btn-sm" href="/admin/attendances/export">Download Data (Excel)</a>
        <a class="btn btn-info btn-sm ml-auto text-white" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-search" aria-hidden="true"></i>
            Filter
        </a>
    </div>

    {{-- Table --}}
    @if ($attendances->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="/img/bg-present.svg" alt="Data Absensi Kosong" class="img-fluid w-100 mt-3">
                <h3 class="text-danger text-center mt-2">Data Masih Kosong</h3>
            </div>
        </div>
    @else
        <div class="table-responsive mt-3">
            <table class="table table-striped datatable-without-search">
                <thead class="table-primary table-striped">
                    <tr>
                        <th>#</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th class="attendance-action">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attendance->student->nisn }}</td>
                            <td>{{ $attendance->student->name }}</td>
                            <td>{{ $attendance->student->grade->name }}</td>


                            <td>
                                <a href="/admin/attendances/rekap/{{ $attendance->student->nisn }}"
                                    class="btn btn-primary btn-sm my-2 btn-action">
                                    <img src="/img/eye.png" alt="Show" class="icon">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
