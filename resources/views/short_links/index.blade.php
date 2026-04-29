<!DOCTYPE html>
<html>

<head>
    <title>Manajemen QR Code Dinamis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Manajemen QR Code</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('short_links.create') }}" class="btn btn-primary mb-3">+ Buat QR Code Baru</a>

        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>QR Code</th>
                    <th>Detail Info</th>
                    <th>Hasil Short Link</th>
                    <th>URL Tujuan Saat Ini</th>
                    <th>Total Scan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($links as $link)
                    <tr>
                        <td class="text-center">
                            {!! QrCode::size(100)->generate(url('/go/' . $link->short_code)) !!}
                        </td>
                        <td>
                            <strong>{{ $link->title }}</strong><br>
                        </td>
                        <td>
                            <strong>{{ $link->short_code }}</strong><br>
                        </td>
                        <td>
                            <a href="{{ $link->destination_url }}" target="_blank" class="text-truncate d-inline-block"
                                style="max-width: 250px;">
                                {{ $link->destination_url }}
                            </a>
                        </td>
                        <td>{{ $link->clicks }} kali</td>
                        <td>
                            <a href="{{ route('short_links.edit', $link->id) }}" class="btn btn-sm btn-warning">Edit
                                Link Tujuan</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
