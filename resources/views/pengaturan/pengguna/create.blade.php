@extends('layouts.app')
@section('title', 'Kelola Pengguna')

@section('content')
<section class="content">

    @include('errors.message')

    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <form action="{{ route('users.store') }}" method="POST" id="form-add">
                @csrf
                <div class="box box-primary">
                    <div class="box-header with-border ui-sortable-handle" style="cursor: move;">
                        <h3 class="box-title">
                            <i class="fa fa-user"></i>&nbsp; FORM TAMBAH
                        </h3>
                    </div>

                    <div class="box-body" id="box-perizinan" style="overflow: auto;white-space: nowrap;width: 100%;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-10">
                                    <label class="mb-0">NAMA LENGKAP</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}">

                                    @error('nama_lengkap')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-10">
                                    <label class="mb-0">USERNAME</label>
                                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">

                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-10">
                                    <label class="mb-0">ALAMAT EMAIL</label>
                                    <input type="email" class="form-control" name="alamat_email" id="alamat_email" value="{{ old('alamat_email') }}">

                                    @error('alamat_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-10">
                                    <label class="mb-0">PERANAN</label><br>
                                    <select class="form-control input-sm" name="peranan" id="peranan" style="width: 100%;">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($data['roles'] as $item)
                                        <option value="{{ $item['name'] }}" {{ old('peranan') == $item['name'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>

                                    <br>
                                    @error('peranan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-default">
                            <i class="fa fa-arrow-left"></i>&nbsp; Kembali
                        </a>

                        <button type="submit" class="btn btn-sm btn-bpr pull-right" id="btn-submit">
                            <i class="fa fa-plus"></i>&nbsp; Tambah
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</section>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('components/select2/dist/css/select2.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    // select2
    $(function() {
        $('#peranan').select2();
    });

    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("form-add");
        if (!form) return;

        const namaLengkap = form.querySelector("#nama_lengkap");
        const username = form.querySelector("#username");
        const alamatEmail = form.querySelector("#alamat_email");
        const submitButton = form.querySelector("#btn-submit");

        // Function Capitalize
        function capitalizeWords(str) {
            return str.replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });
        }

        // Event: Capitalize
        if (namaLengkap) {
            namaLengkap.addEventListener("input", function() {
                this.value = capitalizeWords(this.value.toLowerCase());
            });
        }

        // Event: Lowercase
        if (username) {
            username.addEventListener("input", function() {
                this.value = this.value.toLowerCase().replace(/\s+/g, '');
            });
        }

        // Event: Lowercase and Delete Space
        if (alamatEmail) {
            alamatEmail.addEventListener("input", function() {
                this.value = this.value.toLowerCase().replace(/\s+/g, '');
            });
        }

        // Event: Disable Botton on Submit
        if (submitButton) {
            form.addEventListener("submit", function() {
                submitButton.disabled = true;
                // submitButton.innerText = "Menyimpan...";
                submitButton.classList.add("opacity-70", "cursor-not-allowed");
            });
        }
    });
</script>
@endpush