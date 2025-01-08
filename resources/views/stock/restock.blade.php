<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restok Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h1 class="mb-4">Restok Produk</h1>

        <form action="{{ route('restock.save') }}" method="POST">
            @csrf
            <div class="row">

                <div class="mb-3 col-6 hidden">
                    <label for="id" class="form-label">Id Produk</label>
                    <input type="text" readonly class="form-control" id="id" name="id"
                        value="{{ old('id', $product->id) }}" required>
                </div>

                <div class="mb-3 col-6">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" readonly class="form-control" id="nama" name="nama"
                        value="{{ old('nama', $product->nama) }}" required>
                </div>

                <div class="mb-3 col-6">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="text" readonly class="form-control" id="sku" name="sku"
                        value="{{ old('sku', $product->sku) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Sisa Stok</label>
                <input type="number" class="form-control" id="stok" name="stok"
                    value="{{ old('stok', $product->stok) }}" readonly required>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Tambah Stock</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>

            <div class="mb-3">
                <label for="supplier" class="form-label">Pilih Supplier</label>
                <select class="form-control" id="supplier" name="supplier">
                    <option value="">--Pilih Supplier--</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier }}" {{ old('supplier') == $supplier ? 'selected' : '' }}>
                            {{ $supplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </form>

    </div>
</body>

</html>
