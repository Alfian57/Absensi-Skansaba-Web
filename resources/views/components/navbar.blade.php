<div class="main-header">
    <div class="logo-header" data-background-color="blue">

        <a href="#" class="logo">
            <img src="/img/logo2.png" alt="navbar brand" class="navbar-brand pb-2" width="30">
            <b class="text-white me-3">SMKN 1 BANTUL</b>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </span>
        </button>
        <button class="topbar-toggler more">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                <path
                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
            </svg>
        </button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item" style="margin-right: 70px; padding-bottom: 5px">
                    <a href="/present">
                        <img src="/img/qr.png" alt="QR" title="Halaman Absensi" class="qr-icon">
                    </a>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm" style="margin-left: -50px; margin-bottom: 20px;">
                            @if (Auth::guard('teacher')->check())
                                <div class="pt-2">
                                    @if (Auth::guard('teacher')->user()->profile_pic)
                                        <div class="avatar-lg"><img
                                                src="{{ asset('storage/' . Auth::guard('teacher')->user()->profile_pic) }}"
                                                alt="image profile" class="avatar-img-nav rounded-circle img-fluid">
                                        </div>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37"
                                            class="user-profile" fill="currentColor" class="bi bi-person-circle"
                                            viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path fill-rule="evenodd"
                                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                        </svg>
                                    @endif
                                </div>
                            @endif
                            @if (Auth::guard('user')->check())
                                <div class="pt-2">
                                    @if (Auth::guard('user')->user()->profile_pic)
                                        <div class="avatar"><img
                                                src="{{ asset('storage/' . Auth::guard('user')->user()->profile_pic) }}"
                                                alt="image profile" class="avatar-img-nav rounded-circle img-fluid">
                                        </div>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37"
                                            class="user-profile" fill="currentColor" class="bi bi-person-circle"
                                            viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path fill-rule="evenodd"
                                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                        </svg>
                                    @endif
                                </div>
                                {{-- <div class="avatar-lg">
                                    <img src="/img/account.png" alt="image profile"
                                        class="avatar-img rounded-circle img-fluid">
                                </div> --}}
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    @if (Auth::guard('teacher')->check())
                                        @if (Auth::guard('teacher')->user()->profile_pic)
                                            <div class="avatar-lg"><img
                                                    src="{{ asset('storage/' . Auth::guard('teacher')->user()->profile_pic) }}"
                                                    alt="image profile" class="avatar-img-nav rounded-circle img-fluid">
                                            </div>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                class="user-profile" fill="currentColor" class="bi bi-person-circle"
                                                viewBox="0 0 16 16">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                class="user-profile" fill="currentColor" class="bi bi-person-circle"
                                                viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                            </svg>
                                        @endif
                                    @endif

                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/changePassword" class="collapsed">Ganti
                                    Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/changePic" class="collapsed">Ganti
                                    Foto Profile</a>
                                <div class="dropdown-divider"></div>
                                <form action="/admin/logout" method="POST" class="dropdown-item">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-primary btn-sm w-100 rounded collapsed btn-logout">Logout</button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
