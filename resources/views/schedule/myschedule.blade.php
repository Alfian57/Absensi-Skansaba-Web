@extends('layouts.main')


@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Jadwal Mengajar</h2>

    @if ($schedules->isEmpty())
        <div class="alert alert-danger mt-3">Anda Tidak Memiliki Jadwal Mengajar</div>
    @else
        <div class="row justify-content-center mt-3">
            @foreach ($schedules as $schedule)
                <div class="col-md-3 ms-md-4 alert alert-primary rounded-lg shadow-lg">
                    <table class="table-borderless">
                        <tr>
                            <td class="fw-bold">
                                Hari :
                            </td>
                            <td>
                                {{ $schedule->day }}
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">
                                Mata Pelajaran :
                            </td>
                            <td>
                                {{ $schedule->subject->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">
                                Kelas :
                            </td>
                            <td>
                                {{ $schedule->grade->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">
                                Jam Mulai :
                            </td>
                            <td>
                                {{ $schedule->time_start }}
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">
                                Jam Berakhir :
                            </td>
                            <td>
                                {{ $schedule->time_finish }}
                            </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    @endif
@endsection
