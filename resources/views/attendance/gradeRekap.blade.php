@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Rekap Kelas</h2>

    {{-- <div class="text-end mb-3">
        <a class="btn btn-primary btn-sm" href="/admin/attendances/export">Download Data (Excel)</a>
    </div> --}}

    {{-- Table --}}
    @if ($grades->isEmpty())
        @include('components.empty-data')
    @else
        <div class="table-responsive mt-3">
            <table id="basic-datatables" class="table table-striped">
                <thead class="table-primary table-striped">
                    <tr>
                        <th>#</th>
                        <th>Kelas</th>
                        <th class="attendance-action">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grade->name }}</td>

                            <td>
                                <a href="/admin/attendances/gradeRekap/{{ $grade->slug }}"
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
