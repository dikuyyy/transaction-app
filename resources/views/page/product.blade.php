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
                <button onclick="handleShowModal()" class="btn btn-primary">Tambah</button>
            </div>
            <table class="table table-bordered display mt-2" id="table">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama Barang</th>
                    <th>Tag</th>
                    <th>Tanggal dibuat</th>
                    <th class="text-center">Aksi</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="openModalButton" aria-hidden="true">
        <form method="post" action="{{route('produk.store')}}">
            @csrf
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Nama</label>
                            <input class="form-control" name="name" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="kuantitas">Kuantitas</label>
                            <input class="form-control" type="number" name="kuantitas" id="kuantitas">
                        </div>
                        <div class="mb-3">
                            <label for="harga-beli">Harga Beli</label>
                            <input class="form-control" name="harga_beli" id="harga-beli">
                        </div>
                        <div class="mb-3">
                            <label for="name">Harga Jual</label>
                            <input class="form-control" name="harga_jual" id="harga-jual">
                        </div>
                        <div class="mb-3">
                            <label for="tags">Tags</label>
                            <select class="form-select" name="tags[]" id="multiple-select" data-placeholder="Choose anything" multiple>
                                @foreach($tags as $item)
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="openModalButton" aria-hidden="true">
        <form method="post" action="{{route('produk.store')}}">
            @csrf
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Nama</label>
                            <input class="form-control" name="name" id="name-update-field">
                        </div>
                        <div class="mb-3">
                            <label for="kuantitas">Kuantitas</label>
                            <input class="form-control" type="number" name="kuantitas" id="kuantitas-update-field">
                        </div>
                        <div class="mb-3">
                            <label for="harga-beli">Harga Beli</label>
                            <input class="form-control" type="number" name="harga_beli" id="harga-beli-update-field">
                        </div>
                        <div class="mb-3">
                            <label for="name">Harga Jual</label>
                            <input class="form-control" type="number" name="harga_jual" id="harga-jual-update-field">
                        </div>
                        <div class="mb-3">
                            <label for="tags">Tags</label>
                            <select class="form-select" name="tags[]" id="multiple-select-edit" data-placeholder="Choose anything" multiple>
                                @foreach($tags as $item)
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
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
        const productUpdateUrl = "{{ route('produk.update', ['id' => 'PLACEHOLDER']) }}"
        $(document).ready(function () {
            const table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                order: [[0, 'desc']],
                ajax: `{{route('product.datatable')}}`,
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        render: (data, type, row, meta) => {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'tags',
                        name: 'tags'
                    },
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: (data, type, row) => {
                            return `
                            <div style="text-align: center">
                                <form method="post" action="{{url('/produk')}}/${row.id}">
                                @csrf
                            @method('delete')
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning btn-sm text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan" onclick='handleShowModalEdit(${JSON.stringify(row)})'><i class="bi bi-pencil-fill"></i></button>
                                         <button class="btn btn-danger btn-sm text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan" onclick='handleDeleteData(${JSON.stringify(row)})'><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </form>
                            </div>
                            `
                        }
                    }
                ]
            })
        })

        window.handleShowModal = () => {
            $('#modal').modal('show');
        }

        window.handleShowModalEdit = (row) => {
            const url = productUpdateUrl.replace('PLACEHOLDER', row.id)
            $('#form-update').attr('action', url)
            $('#name-update-field').val(row.name);
            $('#kuantitas-update-field').val(row.quantity);
            $('#harga-beli-update-field').val(row.purchasing_price);
            $('#harga-jual-update-field').val(row.selling_price);
            $('#multiple-select-edit').val(row.tags_id).trigger('change');
            $('#editModal').modal('show');
        }

        $('#multiple-select').select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            allowClear: true,
        } );

        $('#multiple-select-edit').select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            allowClear: true,
        } );
    </script>
@endsection
