<!-- resources/views/products/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Penjualan</title>
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
  <div class="container my-5">
    <h1 class="mb-4">Dashboard Penjualan</h1>

    <!-- Summary Cards -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card text-primary mb-3">
          <div class="card-header fw-bold">Total Pesanan</div>
          <div class="card-body">
            <h5 class="card-title">{{ number_format($total_pesanan, 0, ',', '.') }}</h5>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-success mb-3">
          <div class="card-header fw-bold">Total Pendapatan</div>
          <div class="card-body">
            <h5 class="card-title">Rp{{ number_format($total_pendapatan, 0, ',', '.') }}</h5>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-warning mb-3">
          <div class="card-header fw-bold">Item Paling Laris</div>
          <div class="card-body">
            <h5 class="card-title">{{ $produk_terlaris['Produk'] }}</h5>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-end mb-2">
      {{-- <button class="btn btn-primary">
        Download Laporan
      </button> --}}
      <a href="{{ route('dashboard.laporan') }}" class="btn btn-primary">
        Download Laporan
      </a>
    </div>

    <!-- Orders Table -->
    <div class="card">
      <div class="card-header bg-dark text-white">
        Laporan Penjualan Item
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">SKU</th>
              <th scope="col">Produk</th>
              <th scope="col">Kategori</th>
              <th scope="col">Jumlah Terjual</th>
              <th scope="col">Total Harga</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach ($penjualan as $item)
              <tr>
                <th scope="row">{{ $no }}</th>
                <td>{{ $item['SKU'] }}</td>
                <td>{{ $item['Produk'] }}</td>
                <td>{{ $item['Kategori'] }}</td>
                <td>{{ number_format($item['Jumlah Terjual'], 0, ',', '.') }}</td>
                <td>Rp{{ number_format($item['Total Harga'], 0, ',', '.') }}</td>
              </tr>
              @php
                $no += 1;
              @endphp
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>

</html>
