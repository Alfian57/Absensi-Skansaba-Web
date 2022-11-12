@extends('layouts.main')

@section('content')
    @include('components.breadcrumb')

    <h2 class="text-center mt-3">Kelas</h2>

    <div class="text-end mb-3">
        <a href="/admin/grades/create" class="btn btn-success btn-sm">+ Tambah Kelas</a>
    </div>

    @if ($grades->isEmpty())
        @include('components.empty-data')
    @else
        <div class="table-responsive mt-3">
            <table id="basic-datatables" class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Kelas</th>
                        <th class="action">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grade->name }}</td>
                            <td>
                                <a href="/admin/grades/{{ $grade->slug }}/edit"
                                    class="btn btn-warning btn-sm my-2 btn-action">
                                    <img src="/img/edit.png" alt="Edit" class="icon">
                                </a>
                                <form action="/admin/grades/{{ $grade->slug }}" method="POST" class="d-inline-block">
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

    @if (session()->has('sAError'))
        @php
            Alert::error('Peringatan', session('sAError'));
        @endphp
    @endif
@endsection
