<!-- resources/views/products/show.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h1 class="mb-4">Detail Produk</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->nama }}</h5>
                <p class="card-text"><strong>Kategori:</strong> {{ $product->kategori }}</p>
                <p class="card-text"><strong>Ukuran:</strong> {{ $product->ukuran }}</p>
                <p class="card-text"><strong>Deskripsi:</strong> {{ $product->deskripsi }}</p>
                <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($product->harga, 2, ',', '.') }}</p>
                <p class="card-text"><strong>Jumlah Stok:</strong> {{ $product->stok }}</p>
                <p class="card-text"><strong>Status Stok:</strong> {{ $product->getStockStatus() }}</p>
            </div>
        </div>

        <div class="my-4">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products List</a>
            <a href="{{ route('restock.product', $product->id) }}" class="btn btn-info">Restock Product</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit Product</a>

            <!-- Form untuk menghapus produk -->
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete this product?')">Delete Product</button>
            </form>
        </div>

        <hr>

        <h2 class="mb-4">Riwayat Stok</h2>

        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Jumlah</th>
                    <th>Supplier</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->stockHistories as $history)
                    <tr>
                        <td>{{ $history->created_at }}</td>
                        <td>{{ $history->source }}</td>
                        <td>{{ $history->quantity }}</td>
                        <td>{{ $history->supplier }}</td>
                        <td>{{ $history->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
