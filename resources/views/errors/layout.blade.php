<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style type="text/css">
        body {
            background-image: url(/img/bg.jpg);
            background-size: cover;
        }

        .main-content {
            width: 50%;
            border-radius: 20px;
            box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
            margin: 20vh auto;
            display: flex;
        }

        .company__info {
            background-color: #0275d8;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
        }

        @media screen and (max-width: 640px) {
            .main-content {
                width: 90%;
            }

            .company__info {
                display: none;
            }

            .login_form {
                border-top-right-radius: 20px;
                border-bottom-right-radius: 20px;
            }
        }

        @media screen and (min-width: 642px) and (max-width:800px) {
            .main-content {
                width: 70%;
            }
        }

        .row>h2 {
            color: #0275d8;
        }

        .login_form {
            background-color: #fff;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            border-top: 1px solid #ccc;
            border-right: 1px solid #ccc;
        }

        form {
            padding: 0 2em;
        }

        .custom-form-input {
            width: 100%;
            padding: .5em .5em .5em;
            border: 0px solid transparent;
            border-bottom: 1px solid #aaa;
            transition: all .5s ease;
            outline: none;
        }

        .custom-form-input:focus {
            border-bottom-color: #0275d8;
            box-shadow: 0 0 5px rgba(0, 80, 80, .4);
            border-radius: 4px;
        }

        .btn-login {
            transition: all .5s ease;
            width: 70%;
            border-radius: 30px;
            color: #0275d8;
            font-weight: 600;
            background-color: #fff;
            border: 1px solid #0275d8;
            margin-top: 1.5em;
            margin-bottom: 1em;
        }

        .btn-login:hover,
        .btn-login:focus {
            background-color: #0275d8;
            color: #fff;
        }

        .btn-return {
            transition: all .5s ease;
            width: 70%;
            border-radius: 30px;
            color: #5cb85c;
            font-weight: 600;
            background-color: #fff;
            border: 1px solid #5cb85c;
            margin-top: 1.5em;
            margin-bottom: 1em;
        }

        .btn-return:hover,
        .btn-return:focus {
            background-color: #5cb85c;
            color: #fff;
        }

        .error-main {
            /* background-color: #eee; */
            box-shadow: 0px 10px 10px -10px #5D6572;
        }

        .error-main h1 {
            font-weight: bold;
            color: #444444;
            font-size: 100px;
            text-shadow: 2px 4px 5px #6E6E6E;
        }

        .error-main h6 {
            color: #42494F;
        }

        .error-main p {
            color: #9897A0;
            font-size: 14px;
        }

        .btn-danger {
            transition: all .5s ease;
            border-radius: 30px;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row main-content bg-success text-center">

            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row">
                        <h2 class="mt-3">ERROR</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1 error-main">
                            <h1 class="m-0">@yield('code')</h1>
                            <h6>@yield('message1')</h6>
                            <p>@yield('message2')</p>
                            <a href="/present" class="btn btn-danger btn-sm mb-3 px-3">Kembali Ke Halaman Absensi</a>
                        </div>
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
    {{-- <div class="container">
        <div class="row text-center">
            <div
                class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 border border-2 border-dark rounded error-main">
                <div class="row">
                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">
                        <img src="/img/logo.png" alt="Logo" class="img-fluid ms-5 my-3">
                        <h1 class="m-0">@yield('code')</h1>
                        <h6>@yield('message1')</h6>
                        <p>@yield('message2')</p>
                        <a href="/present" class="btn btn-danger btn-sm">Kembali Ke Halaman Absensi</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</body>

</html>
