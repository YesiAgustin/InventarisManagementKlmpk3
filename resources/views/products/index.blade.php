<!-- resources/views/products/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="/dashboard">Toko Baju</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">Pesanan</a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="btn btn-link nav-link"
                style="color: inherit; text-decoration: none;">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container mt-5">
    <h1 class="mb-4">Daftar Produk</h1>

    <!-- Tambahkan tombol untuk membuat produk baru -->
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    <!-- Cek apakah ada produk -->
    @if ($products->isEmpty())
      <p>Belum ada produk tersedia</p>
    @else
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>SKU</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
            <tr>
              <td>{{ $product->sku }}</td>
              <td>{{ $product->nama }}</td>
              <td>{{ $product->kategori }}</td>
              <td>{{ $product->harga }}</td>
              <td>{{ $product->stok }}</td>
              <td>{{ $product->getStockStatus() }}</td>
              <td>
                <!-- Tombol untuk melihat detail produk -->
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Lihat</a>

                <!-- Tombol untuk mengedit produk -->
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <!-- Form untuk menghapus produk -->
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure?')">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</body>

</html>
