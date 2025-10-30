@extends('layouts.app')
@section('title', 'Kelola Peranan')

@section('content')
<section class="content">

    @include('errors.message')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border ui-sortable-handle" style="cursor: move;">
                    <h3 class="box-title">
                        <i class="fa fa-key"></i>&nbsp; Daftar Peranan
                    </h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-sm btn-bpr" id="btn-add">
                            <i class="fa fa-plus"></i>&nbsp; Tambah
                        </a>
                    </div>
                </div>

                <div class="box-body" style="overflow: auto;white-space: nowrap;width: 100%;">
                    <table id="dataRoles" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">NO</th>
                                <th class="text-center">PERANAN</th>
                                <th class="text-center" width="5%">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data['roles'] as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td class="text-center">
                                    <a href="{{ route('roles.show', Crypt::encryptString($item['id'])) }}" class="btn-circle btn-sm bg-green"><i class="fa fa-lock"></i></a>
                                    <a href="javascript:void(0);" class="btn-circle btn-sm bg-yellow btn-edit" data-id="{{ Crypt::encryptString($item['id']) }}" data-name="{{ $item['name'] }}"><i class="fa fa-edit"></i></a>
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

@include('pengaturan.peranan._modal')
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/peranan_index.js') }}"></script>
@endpush