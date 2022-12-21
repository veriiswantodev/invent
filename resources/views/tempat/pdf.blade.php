<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .text-center{
            text-align: center;
        }
        .M-0{
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div>
        <div class="text-center" style="margin: 0; padding: 0;">
            <h3>DAFTAR INVENTARIS</h3>
            <h3>{{$setting->company}}</h3>
        </div>
    </div>
    
    <p>Barang yang ada di {{ $tempat_nama }}</p>
    <table border="1" style="width: 100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->stok }}</td>
                    <td>{{ $item->ket }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
