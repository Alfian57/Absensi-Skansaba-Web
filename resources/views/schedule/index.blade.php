@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Jadwal Mengajar</h2>

    <div class="text-end mb-3">
        <a href="/admin/schedules/create" class="btn btn-success btn-sm">+ Tambah Jadwal</a>
    </div>

    @if ($schedules->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="/img/bg-present.svg" alt="Data Absensi Kosong" class="img-fluid w-100 mt-3">
                <h3 class="text-danger text-center mt-2">Data Masih Kosong</h3>
            </div>
        </div>
    @else
        <div class="table-responsive mt-3">
            <table id="basic-datatables" class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Guru</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th class="action">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $schedule->teacher->name }}</td>
                            <td>{{ $schedule->subject->name }}</td>
                            <td>{{ $schedule->grade->name }}</td>
                            <td>{{ $schedule->time_start }}</td>
                            <td>{{ $schedule->time_finish }}</td>
                            <td>
                                <a href="/admin/schedules/{{ $schedule->id }}/edit"
                                    class="btn btn-warning btn-sm my-2 btn-action">
                                    <img src="/img/edit.png" alt="Edit" class="icon">
                                </a>
                                <form action="/admin/schedules/{{ $schedule->id }}" method="POST" class="d-inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm my-2 btn-action btn-delete">
                                        <img src="/img/delete.png" alt="Delete" class="icon"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
