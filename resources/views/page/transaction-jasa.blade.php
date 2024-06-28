@extends('layouts.main')
@section('title')
    Transaksi Jasa
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Halaman Transaksi</div>
            <div class="d-flex justify-content-end gap-1 mb-2">
                <button onclick="handleShowModal()" class="btn btn-primary">Tambah</button>
            </div>
            <table class="table table-bordered" id="dynamic-table">
                <thead>
                <tr>
                    <th>Nama Jasa</th>
                    <th>Biaya</th>
                    <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tbody id="dynamic-table-body">
                <!-- Table rows will be dynamically added here -->
                </tbody>
            </table>
            <div class="card-footer">
                <div class="d-flex justify-content-end gap-1 mb-2">
                    <button onclick="handleShowModal()" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="openModalButton" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    Tambah Jasa
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jasa">Jasa</label>
                        <select class="form-select" name="jasa" id="jasa">
                            <option disabled selected>Pilih jasa</option>
                            @foreach($jasa as $item)
                                <option value="{{$item}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" onclick="handleAddItem()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const rows = [];

        function initializeTable() {
            const tbody = $('#dynamic-table-body');
            tbody.empty(); // Clear existing rows

            rows.forEach(rowData => {
                const html = `<tr>
                    <td>${rowData.nama_jasa}</td>
                    <td>${rowData.biaya}</td>
                    <td class="text-center"><button type="button" class="btn btn-danger btn-sm btn-delete">Delete</button></td>
                  </tr>`;
                tbody.append(html);
            });
        }

        $(document).ready(function () {
            initializeTable();
        });

        window.handleShowModal = () => {
            $('#modal').modal('show');
        }

        window.handleAddItem = () => {
            const jasa = JSON.parse($('#jasa').val());
            const newItem = {
                nama_jasa: jasa.name,
                biaya: jasa.selling_price
            }
            rows.push(newItem);
            initializeTable();
            $('#modal').modal('hide');
        }

        $('#multiple-select').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            allowClear: true,
        });
    </script>
@endsection
