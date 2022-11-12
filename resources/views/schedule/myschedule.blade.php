@extends('layouts.main')


@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Jadwal Mengajar</h2>

    @foreach ($schedules as $key => $schedule)
        <h3 class="text-center mt-5">{{ ucfirst($key) }}</h3>
        @if ($schedule->isEmpty())
            @include('components.empty-data')
        @else
            <div class="row justify-content-center mt-3">
                @foreach ($schedule as $item)
                    <div class="col-md-3 ms-md-4 alert alert-primary rounded-lg shadow-lg">
                        <table class="table-borderless">
                            <tr>
                                <td class="fw-bold">
                                    Hari
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    {{ ucfirst($item->day) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    Mata Pelajaran
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    {{ $item->subject->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    Kelas
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    {{ $item->grade->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    Jam Mulai
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    {{ $item->time_start }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    Jam Berakhir
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    {{ $item->time_finish }}
                                </td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
@endsection
