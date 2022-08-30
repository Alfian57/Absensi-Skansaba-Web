<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Yinka Enoch Adedokun">
    <title>Absensi Siswa | Login</title>
    <link rel="icon" href="/img/icon.ico" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row main-content bg-success text-center">

            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row">
                        <h2 class="mt-3">LOGIN</h2>
                    </div>
                    <div class="row">
                        <form action="/admin/login" method="POST" class="form-group">
                            @csrf

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-transparent border-0">
                                    <img src="/img/email.png" alt="Email" class="icon">
                                </span>
                                <input type="email" name="email" class="form-control custom-form-input"
                                    placeholder="Email"
                                    value="@if (session()->has('email')) {{ session('email') }} @endif" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-transparent border-0">
                                    <img src="/img/pass.png" alt="Password" class="icon">
                                </span>
                                <input type="password" name="password" class="form-control custom-form-input"
                                    placeholder="Password" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-transparent border-0">
                                    <img src="/img/role.png" alt="Password" class="icon">
                                </span>
                                <select class="form-select custom-form-input" id="role" name="role" required>
                                    <option value="guru">Guru</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <button type="submit" class="btn-login py-2 w-100">Submit</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" onclick="window.location.href='/present'"
                                        class="btn-return py-2 w-100">Halaman
                                        Utama</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center company__info">
                <h4 class="company_title">
                    <img src="/img/logo2.png" alt="Logo" class="img-fluid">
                    SMKN 1 Bantul
                </h4>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @include('sweetalert::alert')
</body>

</html>
