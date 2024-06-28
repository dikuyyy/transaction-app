@extends('layouts.main')
@section('title')
    Upload Transaksi
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Tabel Transaksi</div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end gap-1">
                <button onclick="handleShowModal()" class="btn btn-primary">Import</button>
            </div>
            <table class="table table-bordered display mt-2" id="table">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Tanggal Upload</th>
                    <th>Total Data</th>
                    <th>Baris Yang Berhasil</th>
                    <th>Baris Yang Gagal</th>
                    <th>Download Seluruh Data</th>
                    <th>Download Baris Yang Gagal</th>
                    <th>Durasi Import</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="openModalButton" aria-hidden="true">
        <form method="post" action="{{route('transaction.upload')}}"  enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input class="form-control" type="file" name="file_excel" id="formFile" accept=".csv" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>
        const downloadSuccessUrl = "{{ route('transaction.success_row', ['id' => 'PLACEHOLDER']) }}"
        const downloadFailedUrl = "{{ route('transaction.failed_row', ['id' => 'PLACEHOLDER']) }}"

        $(document).ready(function () {
            const table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                order: [[0, 'desc']],
                ajax: `{{route('transaction.datatable')}}`,
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        render: (data, type, row, meta) => {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'created_at', name: 'created_at'},
                    {data: 'total_row', name: 'total_row'},
                    {data: 'success_row', name: 'success_row'},
                    {data: 'failed_row', name: 'failed_row'},
                    {
                        data: 'download_success_row',
                        name: 'download_success_row',
                        orderable: false,
                        searchable: false,
                        render: (data, type, row) => {
                            return `
                            <div class="text-center">
                                <button class="btn btn-primary btn-sm text-white" onclick='handleDownloadSuccessRow(${row.id})'>Download</button>
                            </div>
                            `
                        }
                    },
                    {
                        data: 'download_failed_row',
                        name: 'download_failed_row',
                        orderable: false,
                        searchable: false,
                        render: (data, type, row) => {
                            return `
                            <div class="text-center">
                                <button class="btn btn-primary btn-sm text-white" onclick='handleDownloadFailedRow(${row.id})'>Download</button>
                            </div>
                            `
                        }
                    },
                    {data: 'duration', name: 'duration'}
                ],
            })

            window.handleDownloadSuccessRow = (id) => {
                window.location = downloadSuccessUrl.replace('PLACEHOLDER', id);
            }

            window.handleDownloadFailedRow = (id) => {
                window.location = downloadFailedUrl.replace('PLACEHOLDER', id)
            }

            window.handleShowModal = () => {
                $('#modal').modal('show');
            }
        })
    </script>
@endsection
