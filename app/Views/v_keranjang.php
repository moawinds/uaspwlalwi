<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Notifikasi Flashdata -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Tombol Kosongkan -->
<a href="<?= base_url('keranjang/clear') ?>" class="btn btn-danger mb-3" onclick="return confirm('Yakin ingin mengosongkan keranjang?')">
    Kosongkan Keranjang
</a>

<!-- Form Update Keranjang -->
<form action="<?= base_url('keranjang/edit') ?>" method="post">
    <?= csrf_field() ?>

    <table class="table datatable table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0; foreach ($items as $produk) : ?>
                <tr>
                    <th><?= $no + 1 ?></th>
                    <td><?= esc($produk['name']) ?></td>
                    <td><?= number_to_currency($produk['price'], 'IDR') ?></td>
                    <td>
                        <input type="hidden" name="rowid<?= $no ?>" value="<?= esc($produk['rowid']) ?>">
                        <input type="number" name="qty<?= $no ?>" value="<?= esc($produk['qty']) ?>" min="1" class="form-control" style="width:80px">
                    </td>
                    <td><?= number_to_currency($produk['subtotal'], 'IDR') ?></td>
                    <td>
                        <?php if (!empty($produk['options']['foto']) && file_exists(FCPATH . 'img/' . $produk['options']['foto'])) : ?>
                            <img src="<?= base_url('img/' . $produk['options']['foto']) ?>" width="100px">
                        <?php else : ?>
                            <small class="text-muted">Tidak ada foto</small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('keranjang/delete/' . $produk['rowid']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus</a>
                    </td>
                </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Total & Tombol -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <button type="submit" class="btn btn-warning">Perbarui Keranjang</button>
        </div>
        <div class="text-end">
            <h5>Total: <strong><?= number_to_currency($total, 'IDR') ?></strong></h5>
            <button type="submit" formaction="<?= base_url('checkout') ?>" class="btn btn-success mt-2">Bayar Sekarang</button>

        </div>
    </div>
</form>

<?= $this->endSection() ?>
