<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-4">
                    @if (Auth::guard('teacher')->check())
                        @if (Auth::guard('teacher')->user()->profile_pic)
                            <div class="avatar-lg"><img
                                    src="{{ asset('storage/' . Auth::guard('teacher')->user()->profile_pic) }}"
                                    alt="image profile" class="avatar-img rounded-circle img-fluid">
                            </div>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="user-profile"
                                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        @endif
                    @endif
                    @if (Auth::guard('user')->check())
                        @if (Auth::guard('user')->user()->profile_pic)
                            <div class="avatar-lg"><img
                                    src="{{ asset('storage/' . Auth::guard('user')->user()->profile_pic) }}"
                                    alt="image profile" class="avatar-img rounded-circle img-fluid">
                            </div>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="user-profile"
                                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        @endif
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            @if (Auth::guard('teacher')->check())
                                {{ Auth::guard('teacher')->user()->name }}
                            @else
                                {{ Auth::guard('user')->user()->name }}
                            @endif
                            <span class="user-level">
                                @if (Auth::guard('user')->check())
                                    Administrator
                                @else
                                    Guru
                                @endif
                            </span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            {{-- <li>
                                <a href="#" data-toggle="modal" data-target="#pengaturanAkun"
                                    class="collapsed">
                                    <span class="link-collapse">Pengaturan Akun</span>
                                </a>
                            </li> --}}
                            <li>
                                <a href="/admin/changePassword" class="collapsed">
                                    <span class="link-collapse">Ganti Password</span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a href="/admin/changePic" class="collapsed">
                                    <span class="link-collapse">Ganti Foto Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="/admin/home" class="collapsed">
                        <img src="/img/home2.png" class="icon">
                        <p class="text-white ms-3">Dashboard</p>
                    </a>
                    {{-- <form action="/admin/home" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 collapsed">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
                            </svg>
                            Dashboard
                        </button>
                    </form> --}}
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                            fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg> --}}
                    </span>
                    <h4 class="text-section">Menu Utama</h4>
                </li>
                <li class="nav-item">
                    <a href="/admin/attendances">
                        <img src="/img/attendance.png" class="icon">
                        <p class="ms-3">Absensi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/skippingClass">
                        <img src="/img/attendance.png" class="icon">
                        <p class="ms-3">Data Siswa Bolos</p>
                    </a>
                </li>
                @if (Auth::guard('user')->check())
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <img src="/img/file.png" class="icon">
                            <p class="ms-3">Data Umum</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="/admin/grades">
                                        <img src="/img/class.png" class="icon">
                                        <span class="sub-item">Kelas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/subjects">
                                        <img src="/img/subject.png" class="icon">
                                        <span class="sub-item">Mata Pelajaran</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/homeroomTeachers">
                                        <img src="/img/teacher.png" class="icon">
                                        <span class="sub-item">Wali Kelas</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/schedules">
                            <img src="/img/schedule.png" class="icon">
                            <p class="ms-3">Jadwal Mengajar</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/teachers">
                            <img src="/img/teacher.png" class="icon">
                            <p class="ms-3">Data Guru</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/students">
                            <img src="/img/student.png" class="icon">
                            <p class="ms-3">Data Siswa</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/admins">
                            <img src="/img/admin.png" class="icon">
                            <p class="ms-3">Akun Admin</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/otherData">
                            <img src="/img/other-data.png" class="icon">
                            <p class="ms-3">Data Lain</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/admin/myschedules">
                            <img src="/img/schedule.png" class="icon">
                            <p class="ms-3">Jadwal Saya</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="/admin/attendances/rekap">
                        <img src="/img/attendance.png" alt="Rekap Siswa" class="icon">
                        <p class="sub-item ms-3">Rekap Siswa</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/attendances/gradeRekap">
                        <img src="/img/rekap.png" alt="Rekap Kelas" class="icon">
                        <p class="sub-item ms-3">Rekap Kelas</p>
                    </a>
                </li>

                @if (Auth::guard('user')->check())
                    <li class="nav-item">
                        <a href="/admin/activeAccount">
                            <img src="/img/device.png" alt="Akun Aktif" class="icon">
                            <p class="sub-item ms-3">Akun Aktif</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item active mt-3">
                    <a href="#"
                        class="btn btn-primary w-100 rounded text-start text-dark
                        collapsed mb-3 btn-submit-logout">
                        <img src="/img/logout.png" class="icon">
                        <p class="text-white ms-3">Logout</p>
                    </a>
                    <form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
