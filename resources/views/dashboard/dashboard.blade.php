@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('title2')
    {{ $title2 }}
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
                <i class="flaticon-home" style="color: white;font-weight: bold"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow" style="color: white"></i>
        </li>
    </ul>
@endsection
@section('content')
    <div class="mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Daftar Booking</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="min-height: 375px">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="background-color: #595857; color: white; text-align: center;">Nama
                                            Pelanggan
                                        </th>
                                        <th style="background-color: #595857; color: white; text-align: center;">Nomor Telepon
                                        </th>
                                        <th style="background-color: #595857; color: white; text-align: center;">Area Kemah
                                        </th>
                                        <th style="background-color: #595857; color: white; text-align: center;">Bukti Pembayaran
                                        </th>
                                        <th style="background-color: #595857; color: white; text-align: center;">Tanggal Kemah
                                        </th>
                                        <th style="background-color: #595857; color: white; text-align: center;">Status
                                        </th>
                                        <th style="background-color: #595857; color: white; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const renderedEvent = () => {
            $.each($('.approve'), (i, approveBtn) => {
                $(approveBtn).off('click')
                $(approveBtn).on('click', function() {
                    let {
                        approveMessage,
                        approveHref
                    } = $(this).data();
                    confirmation(approveMessage, function() {
                        ajaxSetup()
                        $.ajax({
                                url: approveHref,
                                method: 'post',
                                dataType: 'json'
                            })
                            .done(response => {
                                let {
                                    message
                                } = response
                                successNotification('Berhasil', message)
                                reloadDT();
                            })
                            .fail(error => {
                                ajaxErrorHandling(error);
                            })
                    })
                })
            })

            $.each($('.reject'), (i, rejectBtn) => {
                $(rejectBtn).off('click')
                $(rejectBtn).on('click', function() {
                    let {
                        rejectMessage,
                        rejectHref
                    } = $(this).data();
                    confirmation(rejectMessage, function() {
                        ajaxSetup()
                        $.ajax({
                                url: rejectHref,
                                method: 'post',
                                dataType: 'json'
                            })
                            .done(response => {
                                let {
                                    message
                                } = response
                                successNotification('Berhasil', message)
                                reloadDT();
                            })
                            .fail(error => {
                                ajaxErrorHandling(error);
                            })
                    })
                })
            })
        }

        $('#dataTable').DataTable({
            processing: true,
            serverside: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('dashboard') }}",
            },
            columns: [{
                    data: 'customer_name',
                },
                {
                    data: 'customer_phone',
                },
                {
                    data: 'campsite',
                },
                {
                    data: 'payment_proof',
                },
                {
                    data: 'tanggal_kemah',
                },
                {
                    data: 'status',
                },
                {
                    data: 'action',
                },
            ],
            drawCallback: settings => {
                renderedEvent();
            },
        })

        const reloadDT = () => {
            $('#dataTable').DataTable().ajax.reload();
        }

    </script>
@endsection
