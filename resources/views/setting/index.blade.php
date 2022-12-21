@extends('template.layout')

@section('title')
    Setting
@endsection

@section('content')
    <div class="main-content" style="min-height: 241px;">
        <section class="section">
            <div class="section-header">
                <h1>Setting</h1>
            </div>

            <div class="section-body">
                <div id="output-status"></div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('setting.update') }}" class="setting" enctype="multipart/form-data">
                            @csrf
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h4>Settings</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row align-items-center">
                                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama
                                            Sekolah</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="text" name="company" class="form-control" id="site-title">
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="form-control-label col-sm-3 text-md-right">Site Logo 1</label>
                                        <div class="col-sm-6 col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="site_logo" class="custom-file-input"
                                                    id="site-logo">
                                                <label class="custom-file-label">Pilih</label>
                                            </div>
                                            <div class="tampil-logo1">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="form-control-label col-sm-3 text-md-right">Site Logo 2</label>
                                        <div class="col-sm-6 col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="site_logo" class="custom-file-input"
                                                    id="site-logo">
                                                <label class="custom-file-label">Pilih</label>
                                            </div>
                                            <div class="tampil-logo2">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="form-control-label col-sm-3 text-md-right">Favicon</label>
                                        <div class="col-sm-6 col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="site_favicon" class="custom-file-input"
                                                    id="site-favicon">
                                                <label class="custom-file-label">Pilih</label>
                                            </div>

                                            <div class="favicon">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-whitesmoke text-md-right">
                                    <button class="btn btn-primary btn-sm" id="save-btn">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            showData();
            $('.setting').on('submit'),
                function(e) {
                    if (!e.preventDefault()) {
                        $.ajax({
                                url: $('.setting').attr('action'),
                                type: $('.setting').attr('method'),
                                data: new FormData($('.setting')[0]),
                                async: false,
                                proccessData: false,
                                contentType: false
                            })
                            .done(response => {
                                showData();
                                iziToast.success({
                                        title: 'Sukses',
                                        message: 'Data berhasil diupdate',
                                        position: 'topRight'
                                    })
                                    .fail(errors => {
                                        swal({
                                            icon: 'error',
                                            text: 'Data gagal di load'
                                        })
                                        return;
                                    })
                            })
                    }
                }
        });

        function showData() {
            $.get('{{ route('setting.show') }}')
                .done(response => {
                    console.log(response);
                    $('[name="company"]').val(response.company);
                    // console.log(response);

                    $('.tampil-logo1').html(`<img src="storage${response.logo_1}" class="mt-3" width="100" height= "100">`);
                    $('.tampil-logo2').html(`<img src="storage${response.logo_2}" class="mt-3" width="100" height= "100">`);
                    $('.favicon').html(`<img src="storage${response.favicon}" class="mt-3" width="100" height= "100">`);
                    // $('[rel=icon]').attr('href', `{{ url('/')}}/${response.favicon}`);
                })
                .fail(error => {
                    swal({
                        icon: 'error',
                        text: 'Data gagal di load'
                    })
                })
        }
    </script>
@endpush
