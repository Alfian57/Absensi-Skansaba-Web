@extends('layouts.main')


@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Jadwal Mengajar</h2>

    @if ($schedules->isEmpty())
        <div class="alert alert-danger mt-3">Anda Tidak Memiliki Jadwal Mengajar</div>
    @else
        <div class="row mt-3">
            @foreach ($schedules as $schedule)
                <div class="col-md-4 alert alert-primary">
                    <h5 class="fw-bold">Hari : {{ $schedule->day }}</h5>
                    <h5>Mata Pelajaran : {{ $schedule->subject->name }}</h5>
                    <h5>Kelas : {{ $schedule->grade->name }}</h5>
                    <h5>Jam Mulai : {{ $schedule->time_start }}</h5>
                    <h5>Jam Berakhir : {{ $schedule->time_finish }}</h5>
                </div>
            @endforeach
        </div>
    @endif
@endsection
