@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('dashboard') }}">{!! config('adminlte.logo_lg') !!}</a>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>

            @include('layouts.partials.alerts')

            <form action="#" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Kata sandi">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label><input type="checkbox" name="remember"> Ingat saya</label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('input').iCheck({ checkboxClass: 'icheckbox_square-blue', radioClass: 'iradio_square-blue', increaseArea: '20%' });
    </script>
@endpush
