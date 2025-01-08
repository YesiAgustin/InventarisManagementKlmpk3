<!-- resources/views/products/create.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tambah Produk Baru</h1>

        <!-- Form untuk menambahkan produk baru -->
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" required></input>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required></input>
            </div>

            <div class="mb-3">
                <label for="ukuran" class="form-label">Ukuran</label>
                <input type="text" class="form-control" id="ukuran" name="ukuran" required></input>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok Awal</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>

            <div class="d-flex flex flex-row gap-2">
                <div class="col-6 mb-3">
                    <label for="stok" class="form-label">Stok Minimal</label>
                    <input type="number" class="form-control" id="stok_minimum" name="stok_minimum" required>
                </div>

                <div class="col-6 mb-3">
                    <label for="stok" class="form-label">Stok Maximal</label>
                    <input type="number" class="form-control" id="stok_maximum" name="stok_maximum" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Produk</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>
