@extends('template.layout')

@section('title')
    Kategori
@endsection

@section('content')
    <div class="main-content" style="min-height: 241px;">
        <section class="section">
            <div class="section-header">
                <h4>Kategori</h4>
            </div>

            <div class="section-body">
                <div class="row">

                    {{-- untuk data Kategori --}}
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Kategori</h4>
                            </div>

                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td style="width: 5%">#</td>
                                            <td>Nama</td>
                                            <td style="width: 20%">Aksi</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- untuk tambah data --}}
                    <div class="col-12 col-md-5 col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Kategori</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('kategori.store') }}" method="post">
                                    @method('post')
                                    @csrf
                                    {{-- {{ $errors }} --}}
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama">
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" id="simpan" class="btn btn-sm btn-success">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    @includeIf('tempat.form')
@endsection

@push('script')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autowidth: true,
                ajax: {
                    url: '{{ route('kategori.data') }}'
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'aksi'
                    }
                ]
            });

            $('#modalForm').on('submit', function(e){
                if(! e.preventDefault()){
                    $.post($('#modalForm form').attr('action'), $('#modalForm form').serialize())
                        .done((response) => {
                            $('#modalForm').modal('hide');
                            table.ajax.reload();
                            iziToast.success({
                                title: 'Sukses',
                                message: 'Data berhasil diupdate',
                                position: 'topRight'
                            });
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
        })

        function editData(url) {
            $('#modalForm').modal('show');
            $('#modalForm .modal-title').text('Edit Data Kategori');

            $('#modalForm form')[0].reset();
            $('#modalForm form').attr('action', url);
            $('#modalForm [name=_method]').val('put');

            $.get(url)
                .done((response) => {
                    $('#modalForm [name=nama]').val(response.nama);
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
    </script>
@endpush
