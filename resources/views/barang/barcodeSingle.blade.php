<style>
  .text-center {
            text-align: center;
        }
</style>

<table style="width: 100%" class="text-center">
  <tr>
    <td><img src="{{asset($setting->logo_1)}}"></td>
    <td>{{$setting->company}}</td>
    <td>Logo 2</td>
  </tr>
 
</table>

<table border="1" style="width: 100%">
  <tr>
    <td colspan="2" class="text-center">
      <img src="data:image/png;base64, {{ DNS1D::getBarcodePNG($barang->kode, 'C39') }}"
                    alt="{{ $barang->kode }}" width="170" height="50"><br>
      {{$barang->kode}}
    </td>
  </tr>
  <tr>
    <td>Nama Barang</td>
    <td>{{$barang->nama}}</td>
  </tr>
  <tr>
    <td>Anggaran</td>
    <td>{{$barang->kategori->nama}}</td>
  </tr>
  <tr>
    <td>Jumlah</td>
    <td>{{$barang->stok}} Unit</td>
  </tr>
  <tr>
    <td>Keadaan</td>
    <td>{{$barang->ket}}</td>
  </tr>

</table>