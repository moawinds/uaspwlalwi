<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Notifikasi Flashdata -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> <?= session()->getFlashdata('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Tombol Kosongkan -->
<a href="<?= base_url('keranjang/clear') ?>" class="btn btn-outline-danger mb-3" onclick="return confirm('Yakin ingin mengosongkan keranjang?')">
    <i class="fas fa-trash-alt me-1"></i> Kosongkan Keranjang
</a>

<!-- Form Update Keranjang -->
<form action="<?= base_url('keranjang/edit') ?>" method="post">
    <?= csrf_field() ?>

    <div class="card shadow-sm border-left-info">
        <div class="card-header bg-gradient-info text-white">
            <strong><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</strong>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
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
                            <td><?= $no + 1 ?></td>
                            <td><strong><?= esc($produk['name']) ?></strong></td>
                            <td><span class="badge bg-success"><?= number_to_currency($produk['price'], 'IDR') ?></span></td>
                            <td>
                                <input type="hidden" name="rowid<?= $no ?>" value="<?= esc($produk['rowid']) ?>">
                                <input type="number" name="qty<?= $no ?>" value="<?= esc($produk['qty']) ?>" min="1" class="form-control text-center mx-auto" style="width:80px;">
                            </td>
                            <td><strong><?= number_to_currency($produk['subtotal'], 'IDR') ?></strong></td>
                            <td>
                                <?php if (!empty($produk['options']['foto']) && file_exists(FCPATH . 'img/' . $produk['options']['foto'])) : ?>
                                    <img src="<?= base_url('img/' . $produk['options']['foto']) ?>" class="img-thumbnail" width="80">
                                <?php else : ?>
                                    <span class="text-muted small">Tidak ada foto</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('keranjang/delete/' . $produk['rowid']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus item ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>

            <!-- Tombol Bawah -->
            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-sync-alt me-1"></i> Perbarui Keranjang
                </button>

                <div class="text-end">
                    <h5 class="text-dark">Total: <strong class="text-success"><?= number_to_currency($total, 'IDR') ?></strong></h5>
                    <button type="submit" formaction="<?= base_url('checkout') ?>" class="btn btn-success mt-2">
                        <i class="fas fa-credit-card me-1"></i> Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>
