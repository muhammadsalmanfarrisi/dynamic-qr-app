<!DOCTYPE html>
<html>

<head>
    <title>Edit Link Tujuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm border-warning" style="max-width: 600px; margin: auto;">
            <div class="card-body">
                <h4 class="card-title text-warning">Update URL Tujuan</h4>
                <p class="text-muted">QR Code fisik (<strong>{{ $shortLink->short_code }}</strong>) tidak akan berubah.
                </p>

                <form action="{{ route('short_links.update', $shortLink->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Judul / Label</label>
                        <input type="text" name="title" class="form-control" value="{{ $shortLink->title }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>URL Tujuan BARU</label>
                        <input type="url" name="destination_url" class="form-control"
                            value="{{ $shortLink->destination_url }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Update Tujuan</button>
                    <a href="{{ route('short_links.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
