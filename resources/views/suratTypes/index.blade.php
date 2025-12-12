@extends('layouts.app')
@section('title')
    {{ $title }}
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
            <a href="{{ route('master.suratType.index') }}" style="color: white">{{ $title }}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#modalCreate">
            <i class="fa fa-plus"></i>Tambah</a>
        </button>
    </div>

    <div class="" style="height: 35px"></div>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="" style="display: flex;justify-content: space-between;align-items: center">
                <h6 class="m-0 font-weight-bold text-primary">Master Tipe Surat</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="background-color: #007bff; color: white; text-align: center;">No</th>
                            <th style="background-color: #007bff; color: white; text-align: center;">Nama Tipe Surat</th>
                            <th style="background-color: #007bff; color: white; text-align: center;">Template View</th>
                            {{-- <th style="background-color: #007bff; color: white; text-align: center;">Aksi</th> --}}
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modalCreate" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formCreate">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus"></i> Tambah
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        {!! Template::requiredBanner() !!}
                        <div class="" style="height: 1rem"></div>

                        <div class="form-group">
                            <label> Nama {!! Template::required() !!} </label>
                            <input type="text" name="name" placeholder="Masukan Nama Tipe Surat" class="form-control"
                                required>
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label> Template View {!! Template::required() !!} </label>
                            <input type="text" name="template_view" placeholder="Masukan Template View"
                                class="form-control" required>
                            <span class="invalid-feedback"></span>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>

                </form>
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
                    url: "{{ route('master.suratType.index') }}",
                },
                columns: [{
                    data: 'DT_RowIndex',
                }, {
                    data: 'name',
                }, {
                    data: 'template_view',
                }],
            })

            const reloadDT = () => {
                $('#dataTable').DataTable().ajax.reload();
            }

            const $modalCreate = $('#modalCreate');
            const $formCreate = $('#formCreate');
            const $formCreateSubmitBtn = $formCreate.find(`[type="submit"]`).ladda();

            const clearFormCreate = () => {
                $formCreate[0].reset();
            }

            const formSubmit = ($modal, $form, $submit, $href, $method, addedAction = null) => {
                $form.off('submit')
                $form.on('submit', function(e) {
                    e.preventDefault();

                    let formData = $(this).serialize();
                    $submit.ladda('start');

                    ajaxSetup();
                    $.ajax({
                            url: $href,
                            method: $method,
                            data: formData,
                            dataType: 'json'
                        })
                        .done(response => {
                            let {
                                message
                            } = response;
                            successNotification('Berhasil', message)
                            reloadDT();
                            $submit.ladda('stop');
                            $modal.modal('hide');

                            if (addedAction) {
                                addedAction();
                            }
                        })
                        .fail(error => {
                            $submit.ladda('stop');
                            ajaxErrorHandling(error, $form);
                        })
                })
            }

            formSubmit(
                $modalCreate,
                $formCreate,
                $formCreateSubmitBtn,
                `{{ route('master.suratType.store') }}`,
                'post',
                () => {
                    clearFormCreate();
                }
            );

        });
    </script>
@endsection
