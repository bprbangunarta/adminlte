<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - {{ env('APP_NAME') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        .mb-0 {
            margin-bottom: 0px;
        }

        .btn-bpr {
            background: #03486f;
            color: #ffffff;
        }

        .btn-bpr:hover {
            background: #03486f;
            color: #ffffff;
            opacity: 0.8;
        }

        .btn-bpr:disabled,
        .btn-bpr[disabled] {
            background: #03486f;
            color: #ffffff;
            opacity: 0.8;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/login">
                <img src="{{ asset('logo_full.png') }}" class="img-responsive" alt="logo">
            </a>
        </div>

        <div class="login-box-body" style="border-radius: 5px;box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
            <p class="login-box-msg">Silakan masuk ke akun Anda dengan username dan kata sandi yang telah terdaftar</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label class="mb-0">USERNAME</label>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Email atau Username">
                        <i class="fa fa-user form-control-feedback"></i>

                        @error('username')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-0">KATA SANDI</label>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" id="password" placeholder="*********************">
                        <i class="fa fa-lock form-control-feedback"></i>

                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-bpr btn-block" id="btn-submit" style="border-radius: 3px;">Masuk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const emailInput = document.getElementById("username");
            if (emailInput) {
                emailInput.addEventListener("input", function() {
                    this.value = this.value.toLowerCase();
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');

            if (!passwordInput) return;

            passwordInput.addEventListener('dblclick', function() {
                this.type = this.type === 'password' ? 'text' : 'password';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitButton = document.getElementById('btn-submit');

            form.addEventListener('submit', function() {
                submitButton.disabled = true;
            });
        });
    </script>
</body>

</html>