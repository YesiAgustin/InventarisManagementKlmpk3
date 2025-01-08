<!DOCTYPE html>
<html>

<head>
    <title>Selamat Datang</title>
</head>

<body>
    <h1>Selamat Datang di Buku Tamu</h1>
    <a href="{{ route('bukutamu.create') }}">Isi Buku Tamu</a> |
    <a href="{{ route('bukutamu.show') }}">Lihat Komentar</a>
    <a href="{{ route('products.index') }}">Daftar Produk</a>
    <a href="{{ route('orders.index') }}">Pesanan</a>
</body>

</html>
