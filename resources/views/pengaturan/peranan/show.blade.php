@extends('layouts.app')
@section('title', 'Kelola Peranan')

@section('content')
<section class="content">

    @include('errors.message')

    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <form action="{{ route('roles.permission', Crypt::encryptString($data['role']['id'])) }}" method="POST" id="form-permission">
                @csrf
                <div class="box box-primary">
                    <div class="box-header with-border ui-sortable-handle" style="cursor: move;">
                        <h3 class="box-title">
                            <i class="fa fa-lock"></i>&nbsp; Kelola Perizinan
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-sm btn-default" id="btn-add">
                                <i class="fa fa-print"></i>&nbsp; Cetak
                            </a>
                        </div>
                    </div>

                    <div class="box-body" id="box-perizinan" style="overflow: auto;white-space: nowrap;width: 100%;">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>PERANAN</th>
                                    <th class="text-center" width="5%">AKSI</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($data['permissions'] as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td class="text-center">
                                        <input type="checkbox" name="permissions[]" value="{{ $item['name'] }}" {{ $data['role']->hasPermissionTo($item['name']) ? 'checked' : '' }} />
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">No matching records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-default">
                            <i class="fa fa-arrow-left"></i>&nbsp; Kembali
                        </a>

                        <button type="submit" class="btn btn-sm btn-success pull-right" id="btn-submit">
                            <i class="fa fa-save"></i>&nbsp; Simpan
                        </button>
                    </div>
                </div>
            </form>

            <p>Cara menggunakan middleware perizinan: <br><code><a href="https://spatie.be/docs/laravel-permission/v6/basic-usage/middleware" class="text-danger" target="_blank">https://spatie.be/docs/laravel-permission/v6/basic-usage/middleware</a></code></p>
        </section>
    </div>
</section>
@endsection

@push('js')
<script src="{{ asset('components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- <script src="{{ asset('js/peranan_show.js') }}"></script> -->

<script>
    // slim scroll
    $('#box-perizinan').slimScroll({
        height: '300px'
    });

    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("form-permission");
        if (!form) return;

        const submitButton = form.querySelector("#btn-submit");

        // Event: Disable Botton on Submit
        if (submitButton) {
            form.addEventListener("submit", function() {
                submitButton.disabled = true;
                submitButton.classList.add("opacity-70", "cursor-not-allowed");
            });
        }
    });
</script>
@endpush