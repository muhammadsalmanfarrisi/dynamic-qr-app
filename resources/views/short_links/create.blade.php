<!DOCTYPE html>
<html>

<head>
    <title>Buat QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm" style="max-width: 600px; margin: auto;">
            <div class="card-body">
                <h4 class="card-title">Buat QR Code Baru</h4>
                <form action="{{ route('short_links.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Judul / Label</label>
                        <input type="text" name="title" class="form-control" required
                            placeholder="Contoh: Form Evaluasi">
                    </div>
                    <div class="mb-3">
                        <label>Custom Short Code (Opsional)</label>
                        <input type="text" name="short_code" class="form-control"
                            placeholder="Contoh: sp7-orientasi (Kosongkan untuk auto-generate)">
                    </div>
                    <div class="mb-3">
                        <label>URL Tujuan Awal</label>
                        <input type="url" name="destination_url" class="form-control" required
                            placeholder="https://docs.google.com/form/...">
                    </div>
                    <button type="submit" class="btn btn-primary">Generate QR Code</button>
                    <a href="{{ route('short_links.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
