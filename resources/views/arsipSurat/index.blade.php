@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('style')
    <style>
        /* Ukuran font untuk seluruh DataTable */
        #dataTable,
        #dataTable thead th,
        #dataTable tbody td {
            font-size: 10px !important;
        }

        /* Ukuran font tombol, pagination, search, info, length menu */
        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate a {
            font-size: 10px !important;
        }

        /* Dropdown DataTables (page length) */
        .dataTables_length select {
            font-size: 10px !important;
            padding: 2px 4px !important;
        }

        /* Search input */
        .dataTables_filter input {
            font-size: 10px !important;
            padding: 2px 4px !important;
        }
    </style>
@endsection
@section('breadcrumbs')
    <ul class="breadcrumbs" style="color: white">
        <li class="nav-home">
            <a href="/admin/dashboard">
                <i class="flaticon-home" style="color: white"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow" style="color: white"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pengajuanSurat.indexArsip') }}" style="color: white">{{ $title }}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="" style="height: 35px"></div>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="" style="display: flex;justify-content: space-between;align-items: center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="background-color: #007bff; color: white; text-align: center;">No</th>
                            <th style="background-color: #007bff; color: white; text-align: center;">Nama Lengkap</th>
                            <th style="background-color: #007bff; color: white; text-align: center;">NIK</th>
                            <th style="background-color: #007bff; color: white; text-align: center;">Foto KK</th>
                            <th style="background-color: #007bff; color: white; text-align: center;">Tipe Surat</th>
                            <th style="background-color: #007bff; color: white; text-align: center;">No Surat</th>
                            <th style="background-color: #007bff; color: white; text-align: center;">File Surat</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#dataTable').DataTable({
                processing: true,
                serverside: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.pengajuanSurat.indexArsip') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                    }, {
                        data: 'nama_lengkap',
                    },
                    {
                        data: 'nik',
                    },
                    {
                        data: 'keterangan',
                    },
                    {
                        data: 'surat_type',
                    },
                    {
                        data: 'nomor_surat',
                    },
                    {
                        data: 'file_surat',
                    },
                ],
                drawCallback: function() {
                    $('#dataTable tbody td, #dataTable thead th').css({
                        'padding': '1px 2px'
                    });
                }
            })

            const reloadDT = () => {
                $('#dataTable').DataTable().ajax.reload();
            }

        });
    </script>
@endsection
