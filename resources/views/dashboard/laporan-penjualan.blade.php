<!-- resources/views/products/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Penjualan</title>
</head>

<body>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
      text-align: left;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header-title {
      font-weight: bold;
      font-size: 18px;
    }

    .date-generated {
      font-size: 12px;
      color: #555;
    }
  </style>

  <div class="header">
    <div class="header-title">Laporan Penjualan</div>
    <div class="date-generated">dibuat: {{ now()->format('d M Y H:i') }}</div>
  </div>

  <table>
    <thead>
      <tr>
        <th>SKU</th>
        <th>Produk</th>
        <th>Kategori</th>
        <th>Jumlah Terjual</th>
        <th>Total Harga</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($penjualan as $item)
        <tr>
          <td>{{ $item['SKU'] }}</td>
          <td>{{ $item['Produk'] }}</td>
          <td>{{ $item['Kategori'] }}</td>
          <td>{{ $item['Jumlah Terjual'] }}</td>
          <td>{{ number_format($item['Total Harga'], 0, ',', '.') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>


</body>

</html>
