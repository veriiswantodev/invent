@extends('template.layout')

@section('title')
    Barang
@endsection

@section('content')
    <div class="main-content" style="min-height: 241px;">
        <section class="section">
            <div class="section-header">
                Barang
            </div>

            <div class="section-body">
                <div class="row">

                    {{-- untuk data barang --}}
                    <div class="col-12 col-md-12col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Barang</h4>
                                <div class="ml-auto">
                                    <button class="btn btn-success btn-sm"
                                        onclick="cetakBarcode('{{ route('barang.cetak_barcode') }}')"><i
                                            class="fa fa-barcode"></i></button>
                                    <button class="btn btn-success btn-sm"
                                        onclick="addForm('{{ route('barang.store') }}')"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="card-body">
                                <form action="" method="post" class="form-barang">
                                    @csrf
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td style="width: 3%">
                                                    <input type="checkbox" name="select_all" id="select_all">
                                                </td>
                                                <td style="width: 5%">#</td>
                                                <td>Kode</td>
                                                <td>Nama</td>
                                                <td>Lokasi</td>
                                                <td style="width: 15%">Aksi</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- untuk tambah data --}}
                    {{-- <div class="col-12 col-md-5 col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Barang</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('barang.store') }}" method="post" name="barang">
                                    @csrf
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                            name="kode" id="kode" readonly>
                                        @error('kode')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama">
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tempat">Tempat</label>
                                        <select name="tempat_id"
                                            class="form-control @error('tempat_id') is-invalid @enderror select2">
                                            <option value="">Pilih</option>
                                            @foreach ($tempat as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('tempat_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror select2 kategori">
                                            <option value="">Pilih</option>
                                            @foreach ($category as $ct)
                                                <option value="{{ $ct->id }}" nama-category={{ $ct->nama }}>
                                                    {{ $ct->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input type="number" name="stok"
                                            class="form-control @error('stok') is-invalid @enderror">
                                        @error('stok')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ket">Keterangan</label>
                                        <textarea name="ket" class="form-control @error('ket') is-invalid @enderror"></textarea>
                                        @error('ket')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </section>
    </div>
    @includeIf('barang.form')
@endsection

@push('script')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autowidth: true,
                ajax: {
                    url: '{{ route('barang.data') }}'
                },
                columns: [{
                        data: 'select_all'
                    },
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'kode'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'tempat_id'
                    },
                    {
                        data: 'aksi'
                    }
                ]
            });

            $('.select2').select2();

            $('#modalForm').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.post($('#modalForm form').attr('action'), $('#modalForm form').serialize())
                        .done((response) => {
                            $('#modalForm').modal('hide');
                            table.ajax.reload();
                            iziToast.success({
                                title: 'Sukses',
                                message: 'Data berhasil diupdate',
                                position: 'topRight'
                            });
                            window.location.reload();
                            // return;
                        })
                        .fail((errors) => {
                            iziToast.error({
                                title: 'gagal',
                                message: 'Data gagal diupdate',
                                position: 'topRight'
                            });
                            return;
                        })
                }
            })

            $('[name=select_all]').on('click', function() {
                $(':checkbox').prop('checked', this.checked);
            });

        })

        function addForm(url) {
            $('#modalForm').modal('show');
            $('#modalForm form')[0].reset();
            $('#modalForm .modal-title').text('Tambah Data');
        }

        function editData(url) {
            $('#modalForm').modal('show');
            $('#modalForm form')[0].reset();
            $('#modalForm .modal-title').text('Edit Data');

            $('#modalForm form')[0].reset();
            $('#modalForm form').attr('action', url);
            $('#modalForm [name=_method]').val('put');

            $.get(url)
                .done((response) => {
                    $('#modalForm [name=kode]').val(response.kode);
                    $('#modalForm [name=nama]').val(response.nama);
                    $('#modalForm [name=tempat_id]').val(response.tempat_id);
                    $('#modalForm [name=kategori_id]').val(response.kategori_id);
                    $('#modalForm [name=stok]').val(response.stok);
                    $('#modalForm [name=ket]').val(response.ket);

                    console.log(response);
                })
                .fail((errors) => {
                    iziToast.success({
                        title: 'Gagal',
                        message: 'Tidak dapat menampilkan data',
                        position: 'topRight'
                    });
                    return;
                });
        }

        $('.kategori').change(function() {
            var nama_category = $(this).children('option').filter(':selected').text().trim();
            console.log(nama_category);
            $('#kode').val('INV/ANT/' + {{ $max_id }} + '/' + nama_category + '/' + {{ $bulan }} +
                '/' + {{ $tahun }})
        })

        function deleteData(url) {
            swal({
                    title: "Yakin ingin manghapus data ini?",
                    text: "Jika Anda klik Ok! Maka data akan terhapus!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.post(url, {
                                '_token': $('[name=csrf-token]').attr('content'),
                                '_method': 'delete'
                            })
                            .done((response) => {
                                iziToast.success({
                                    title: 'Sukses',
                                    message: 'Data Berhasil dihapus',
                                    position: 'topRight'
                                });
                                return;
                            })
                            .fail((errors) => {
                                iziToast.success({
                                    title: 'Sukses',
                                    message: 'Data gagal dihapus',
                                    position: 'topRight'
                                });
                                return;
                            });

                        table.ajax.reload();
                    }
                });
        }

        function cetakBarcode(url) {
            if ($('input:checked').length < 1) {
                swal({
                    title: "Silahkan pilih Data?",
                    text: "Silahkan pilih data yang akan di cetak",
                    icon: "warning",
                    buttons: {
                        cancel: false,
                        confirm: true
                    },
                    dangerMode: true,
                });
                return;
            } else if ($('input:checked').length < 3) {
                swal({
                    title: "Silahkan Pilih 3 Data?",
                    text: "Silahkan pilih minimal 3 data yang akan di cetak",
                    icon: "warning",
                    buttons: {
                        cancel: false,
                        confirm: true
                    },
                    dangerMode: true,
                });
                return;
            } else {
                $('.form-barang').attr('action', url).attr('target', '_blank').submit();
            }
        }
    </script>
@endpush
