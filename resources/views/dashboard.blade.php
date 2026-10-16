@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Ringkasan')

@section('content')
    <div class="row">
        @foreach ([['aqua', 'ion-ios-gear-outline', 'Pengaturan', '12'], ['red', 'fa fa-google-plus', 'Suka', '41'], ['green', 'ion-ios-cart-outline', 'Penjualan', '760'], ['yellow', 'ion-ios-people-outline', 'Anggota', '2,000']] as [$color, $icon, $label, $value])
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-{{ $color }}"><i class="{{ $icon }}"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ $label }}</span>
                        <span class="info-box-number">{{ $value }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Selamat datang</h3>
        </div>
        <div class="box-body">
            Template AdminLTE siap dipakai. Ubah menu di <code>config/adminlte.php</code> dan buat halaman baru dengan
            <code>@@extends('layouts.app')</code>.
        </div>
    </div>
@endsection
