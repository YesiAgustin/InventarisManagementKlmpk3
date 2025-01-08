<!-- resources/views/orders/show.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Detail Pesanan</h1>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Pesanan</h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">Produk: {{ $order->product->nama }}</h5>
                <p class="card-text"><strong>Jumlah:</strong> {{ $order->jumlah }}</p>
                <p class="card-text"><strong>Total Harga:</strong> Rp
                    {{ number_format($order->total_harga, 2, ',', '.') }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Kembali ke Daftar Pesanan</a>
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus Pesanan</button>
            </form>
        </div>
    </div>
</body>

</html>
