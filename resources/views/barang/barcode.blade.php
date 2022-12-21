<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>
    <style>
        .text-center {
            text-align: center;
        }

        body{
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <table border="0,5" style="width="377.95275591">
        @foreach ($databarang as $key => $barang)
        <tr>
            <td><img src="{{asset($setting->logo_1)}}" alt=""></td>
            <td class="text-center">SMK Antartika 1 Sidoarjo</td>
            <td>Logo</td>
        </tr>
        <tr>
            
                <td class="text-center">{{ $barang->nama }} </td>
                <td class="text-center">
                    <img src="data:image/png;base64, {{ DNS1D::getBarcodePNG($barang->kode, 'C39') }}"
                    alt="{{ $barang->kode }}" width="170" height="50">
                    {{ $barang->kode }}
                </td>
                <td class="text-center">{{ $barang->tempat->nama }}</td>
                

            </tr>
            <tr>
            @if ($no++ % 3 == 0)
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>
