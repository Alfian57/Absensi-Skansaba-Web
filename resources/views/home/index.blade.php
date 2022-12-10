@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h1 class="text-center text-white mb-4 mt-3">Dashboard</h1>
    <div class="row justify-content-center">
        <div class="col-lg-6 border border-2 rounded bg-light shadow-lg me-lg-5 mb-5 p-3">
            <div class="text-center">
                <img src="/img/logo2.png" alt="Logo SMKN 1 Bantul" class="img-fluid w-50">
            </div>
            <h4 class="text-center mt-3">SMKN 1 Bantul</h4>
            <p class="text-center">Jl. Parangtritis No.KM.11, Dukuh, Sabdodadi, Kec. Bantul, Kabupaten Bantul, Daerah
                Istimewa Yogyakarta 55715
            </p>
            <p class="text-center">
                Email: smeanbtl@yahoo.com
                <br>
                Telp: (0274) 367156
                <br>
                NPSN: 20400416
            </p>
        </div>

        <div class="col-lg-5 border border-2 rounded bg-light mb-5 p-3 align-content-center shadow-lg">
            <div class="row">
                {{-- MURID --}}
                <div class="bg-primary rounded text-white pt-3 mb-3 w-100">
                    <div class="row">
                        <div class="col-8">
                            <h5>Total Siswa</h5>
                            <p>{{ $studentCount }} Siswa</p>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <img src="/img/student2.png" alt="Student" class="img-fluid ms-2">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Guru --}}
                <div class="bg-warning rounded text-white pt-3 mb-3 w-100">
                    <div class="row">
                        <div class="col-8">
                            <h5>Jumlah Guru</h5>
                            <p>{{ $teacherCount }} Guru</p>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <img src="/img/teacher2.png" alt="Teacher" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kelas --}}
                <div class="bg-danger rounded text-white pt-3 mb-3 w-100">
                    <div class="row">
                        <div class="col-8">
                            <h5>Jumlah Kelas</h5>
                            <p>{{ $gradeCount }} Kelas</p>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <img src="/img/class2.png" alt="Class" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (request('year') == date('Y'))
            <h1 class="ms-5 mb-3 text-primary">Data Absensi Tahun Ini</h1>
        @else
            @if (request('year'))
                <h1 class="ms-5 mb-3 text-primary">Data Absensi {{ request('year') }}</h1>
            @else
                <h1 class="ms-5 mb-3 text-primary">Data Absensi Tahun Ini</h1>
            @endif
        @endif


        <div class="row justify-content-end mb-3">
            <div class="col-lg-6">
                <form action="/admin/home" method="GET" class="d-flex">
                    <select class="form-select form-select-sm" name="year">
                        @foreach ($years as $year)
                            @if (request('year'))
                                @if (request('year') == $year->year)
                                    <option value="{{ $year->year }}" selected>{{ $year->year }}</option>
                                @else
                                    <option value="{{ $year->year }}">{{ $year->year }}</option>
                                @endif
                            @else
                                @if (date('Y') == $year->year)
                                    <option value="{{ $year->year }}" selected>{{ $year->year }}</option>
                                @else
                                    <option value="{{ $year->year }}">{{ $year->year }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    <div class="ms-2">
                        <button type="submit" class="btn btn-success btn-sm p-2">
                            <img src="/img/search.png" class="icon">
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-11 border border-2 rounded bg-light shadow-lg mb-5 p-3">
            <div id="chart-container" style="position: relative; height:60vh; width:100%">
                <canvas id="multipleLineChart"></canvas>
            </div>
        </div>
    </div>
@endsection
