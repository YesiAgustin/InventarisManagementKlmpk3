<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Product</h1>

        <!-- Form untuk mengedit produk -->
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT or PATCH for updating -->

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama"
                    value="{{ old('nama', $product->nama) }}" required>
            </div>

            <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku"
                    value="{{ old('sku', $product->sku) }}" required>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori"
                    value="{{ old('kategori', $product->kategori) }}" required>
            </div>

            <div class="mb-3">
                <label for="ukuran" class="form-label">Ukuran</label>
                <input type="text" class="form-control" id="ukuran" name="ukuran"
                    value="{{ old('ukuran', $product->ukuran) }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $product->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga"
                    value="{{ old('harga', $product->harga) }}" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok Awal</label>
                <input type="number" class="form-control" id="stok" name="stok"
                    value="{{ old('stok', $product->stok) }}" readonly required>
            </div>

            <div class="d-flex flex-row gap-2">
                <div class="col-6 mb-3">
                    <label for="stok_minimum" class="form-label">Stok Minimal</label>
                    <input type="number" class="form-control" id="stok_minimum" name="stok_minimum"
                        value="{{ old('stok_minimum', $product->stok_minimum) }}" required>
                </div>

                <div class="col-6 mb-3">
                    <label for="stok_maximum" class="form-label">Stok Maximal</label>
                    <input type="number" class="form-control" id="stok_maximum" name="stok_maximum"
                        value="{{ old('stok_maximum', $product->stok_maximum) }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </form>

    </div>
</body>

</html>
