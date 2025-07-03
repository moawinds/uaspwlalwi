<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Invoice</h2>
    <hr>

    <?php if (session()->getFlashdata('failed')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('failed') ?>
        </div>
    <?php endif; ?>

    <?php if (!isset($transaksi) || empty($transaksi)): ?>
        <div class="alert alert-warning">
            Data transaksi tidak tersedia.
        </div>
    <?php else: ?>

    <!-- Informasi Pengguna -->
    <div class="mb-4">
        <p><strong>Nama:</strong> <?= esc($transaksi['username']) ?></p>
        <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i:s', strtotime($transaksi['created_at'])) ?></p>
    </div>

    <!-- Tabel Produk -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($detail as $item): 
                $harga_satuan = ($item['jumlah'] > 0) 
                    ? $item['subtotal_harga'] / $item['jumlah'] 
                    : 0;
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($item['nama_produk'] ?? 'Produk #' . $item['product_id']) ?></td>
                <td><?= $item['jumlah'] ?></td>
                <td><?= number_to_currency($harga_satuan, 'IDR') ?></td>
                <td><?= number_to_currency($item['subtotal_harga'], 'IDR') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4" class="text-end"><strong>Total</strong></td>
                <td><strong><?= number_to_currency($transaksi['total_harga'], 'IDR') ?></strong></td>
            </tr>
        </tbody>
    </table>

    <div class="mt-3">
        <a href="<?= base_url('/') ?>" class="btn btn-primary">Kembali ke Dashboard</a>
        <a href="<?= base_url('invoice/cetak/' . $transaksi['id']) ?>" class="btn btn-secondary" target="_blank">
    Cetak Invoice (PDF)
</a>

    </div>

    <?php endif; ?>
</div>

<?= $this->endSection() ?>
