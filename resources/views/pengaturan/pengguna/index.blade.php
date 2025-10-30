@extends('layouts.app')
@section('title', 'Kelola Pengguna')

@section('content')
<section class="content">

    @include('errors.message')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border ui-sortable-handle" style="cursor: move;">
                    <h3 class="box-title">
                        <i class="fa fa-user"></i>&nbsp; Daftar Pengguna
                    </h3>

                    <div class="box-tools pull-right">
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-bpr" id="btn-add">
                            <i class="fa fa-plus"></i>&nbsp; Tambah
                        </a>

                        <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-file-excel-o"></i>&nbsp; Import
                        </a>
                    </div>
                </div>

                <div class="box-body" style="overflow: auto;white-space: nowrap;width: 100%;">
                    <table id="dataUsers" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">NO</th>
                                <th class="text-center">NAMA</th>
                                <th class="text-center">USERNAME</th>
                                <th class="text-center">EMAIL</th>
                                <th class="text-center">PERANAN</th>
                                <th class="text-center" width="5%">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data['users'] as $item)
                            <tr class="{{ $item['deleted_at'] == null ? '' : 'text-danger' }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['username'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>{{ $item['roles'][0]['name'] ?? '' }}</td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" class="btn-circle btn-sm bg-green btn-restore" data-id="{{ Crypt::encryptString($item['id']) }}" data-name="{{ $item['name'] }}"><i class="fa fa-history"></i></a>
                                    <a href="{{ route('users.show', Crypt::encryptString($item['id'])) }}" class="btn-circle btn-sm bg-yellow btn-edit"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0);" class="btn-circle btn-sm bg-red btn-delete" data-id="{{ Crypt::encryptString($item['id']) }}" data-name="{{ $item['name'] }}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header bg-green" style="border-radius: 5px 5px 0px 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">FORM IMPORT</h4>
            </div>

            <form action="{{ route('imports.users') }}" method="POST" id="form-import" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div>
                        <div class="row mb-0">
                            <div class="col-xs-8">
                                <label>Upload File</label>
                            </div>

                            <div class="col-xs-4">
                                <a href="{{ asset('excel/IMPORT_USER.xlsx') }}" class="pull-right" target="_blank">Sample.xlsx</a>
                            </div>
                        </div>

                        <input type="file" class="form-control" name="file" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>


                        @error('file')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">
                        <i class="fa fa-close"></i>&nbsp; Tutup
                    </button>

                    <button type="submit" class="btn btn-sm btn-success" id="btn-submit">
                        <i class="fa fa-file-excel-o"></i>&nbsp; Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script>
    // Select2
    $(function() {
        $('#dataUsers').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })

    // Function Restore
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-restore').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (confirm(`Apakah anda yakin ingin memulihkan pengguna "${name}"?`)) {
                    fetch(`/users/restore/${id}`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => {
                            if (response.redirected) {
                                window.location.href = response.url;
                            } else {
                                return response.json();
                            }
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                            alert('Gagal memulihkan data');
                        });
                }
            });
        });
    });

    // Function Delete
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (confirm(`Apakah anda yakin ingin menghapus pengguna "${name}"?`)) {
                    fetch(`/users/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => {
                            if (response.redirected) {
                                window.location.href = response.url;
                            } else {
                                return response.json();
                            }
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                            alert('Gagal menghapus data');
                        });
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("form-import");
        if (!form) return;

        const submitButton = form.querySelector("#btn-submit");

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