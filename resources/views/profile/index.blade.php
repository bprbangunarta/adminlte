@extends('layouts.app')
@section('title', 'User Profile')

@section('content')
<section class="content">

    @include('errors.message')

    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('logo.png') }}" alt="User profile picture">

                    <h3 class="profile-username text-center">User Profile</h3>

                    <ul class="list-group list-group-unbordered" style="margin-bottom: -15px;">
                        <li class="list-group-item">
                            <b>Nama Lengkap</b> <a class="pull-right">{{ $data['user']['name'] }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Username</b> <a class="pull-right">{{ $data['user']['username'] }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Alamat Email</b> <a class="pull-right">{{ $data['user']['email'] }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Jabatan</b> <a class="pull-right">{{ $data['user']->getRoleNames()->implode(', ') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#security" data-toggle="tab" aria-expanded="true">Keamanan</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="security">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="mb-0">Kata Sandi Saat Ini</label>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="current_password" id="current_password">
                                    <i class="fa fa-lock form-control-feedback"></i>

                                    @error('current_password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="mb-0">Kata Sandi Baru</label>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="password" id="password">
                                    <i class="fa fa-lock form-control-feedback"></i>

                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="mb-0">Konfirmasi Kata Sandi</label>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                    <i class="fa fa-lock form-control-feedback"></i>

                                    @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-sm btn-warning" id="btn-submit" style="border-radius: 3px;">
                                        <i class="fa fa-save"></i>&nbsp; SIMPAN
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentPasswordInput = document.getElementById('current_password');
        if (!currentPasswordInput) return;

        currentPasswordInput.addEventListener('dblclick', function() {
            this.type = this.type === 'password' ? 'text' : 'password';
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        if (!passwordInput) return;

        passwordInput.addEventListener('dblclick', function() {
            this.type = this.type === 'password' ? 'text' : 'password';
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const confirmPasswordInput = document.getElementById('password_confirmation');
        if (!confirmPasswordInput) return;

        confirmPasswordInput.addEventListener('dblclick', function() {
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
@endpush