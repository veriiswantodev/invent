<div class="modal fade" id="modalForm" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('barang.store') }}" method="post" name="barang">
                    @csrf
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode"
                            id="kode" readonly>
                        @error('kode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <select name="tempat_id" class="form-control @error('tempat_id') is-invalid @enderror select2">
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
                        <select name="kategori_id"
                            class="form-control @error('kategori_id') is-invalid @enderror kategori">
                            <option value="">Pilih</option>
                            @foreach ($category as $ct)
                                <option value="{{ $ct->id }}" nama-category={{ $ct->nama }}>
                                    {{ $ct->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror">
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

    </div>
</div>
