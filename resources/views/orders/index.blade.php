<!-- resources/views/orders/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pesanan</title>
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
    <h1 class="mb-4">Daftar Pesanan</h1>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Tambah Pesanan</a>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Produk</th>
          <th>Jumlah</th>
          <th>Total Harga</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
          <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->product->nama }}</td>
            <td>{{ $order->jumlah }}</td>
            <td>{{ $order->total_harga }}</td>
            <td>
              <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Lihat</a>
              <a href="{{ route('orders.reorder', $order->id) }}" class="btn btn-warning btn-sm">Reorder</a>
              <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                  onclick="return confirm('Are you sure you want to delete this order?')">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>

</html>
