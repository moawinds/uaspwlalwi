<!DOCTYPE html>
<html>
<head>
    <title>Invoice #<?= $transaksi['id'] ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Invoice Transaksi</h2>
    <p><strong>ID Transaksi:</strong> <?= $transaksi['id'] ?><br>
    <strong>Tanggal:</strong> <?= date('d-m-Y H:i:s', strtotime($transaksi['created_at'])) ?><br>
    <strong>Total:</strong> Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($detail as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item['nama_produk'] ?? '-' ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td>Rp <?= number_format($item['subtotal_harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
