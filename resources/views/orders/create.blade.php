<!-- resources/views/orders/create.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Buat Pesanan Baru</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_product" class="form-label">Produk</label>
                <select id="id_product" name="id_product" class="form-select" required onchange="updateProductInfo()">
                    <option value="">Pilih Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-harga="{{ $product->harga }}"
                            data-stok="{{ $product->stok }}"
                            {{ isset($order) && $order->id_product == $product->id ? 'selected' : '' }}>
                            {{ $product->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" class="form-control" required min="1"
                    value="{{ isset($order) ? $order->jumlah : '' }}" oninput="updateTotalPrice()">
            </div>

            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" id="total_harga" name="total_harga" class="form-control" required step="0.01"
                    readonly value="{{ isset($order) ? $order->total_harga : '' }}">
            </div>

            <div class="mb-3">
                <p id="product_info" class="text-muted">
                    {{ isset($order) ? 'Stok Tersedia: ' . $order->product->stok : '' }}
                </p>
            </div>

            <button type="submit" class="btn btn-primary">Buat Pesanan</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script>
        function updateProductInfo() {
            const select = document.getElementById('id_product');
            const selectedOption = select.options[select.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const stok = selectedOption.getAttribute('data-stok');
            const productInfo = document.getElementById('product_info');

            if (selectedOption.value) {
                productInfo.innerText = `Harga: Rp ${harga}, Stok Tersedia: ${stok}`;
            } else {
                productInfo.innerText = '';
            }
            updateTotalPrice();
        }

        function updateTotalPrice() {
            const select = document.getElementById('id_product');
            const selectedOption = select.options[select.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const quantity = parseInt(document.getElementById('jumlah').value) || 0;
            const totalPriceInput = document.getElementById('total_harga');

            totalPriceInput.value = (harga * quantity).toFixed(2);
        }

        // Auto-trigger update on page load if order exists
        window.onload = function() {
            if (document.getElementById('id_product').value) {
                updateProductInfo();
            }
        };
    </script>
</body>

</html>
