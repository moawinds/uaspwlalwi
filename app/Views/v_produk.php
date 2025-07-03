<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Notifikasi Flashdata -->
<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Tombol Tambah Data -->
<button class="btn btn-success mb-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
    <i class="fas fa-plus me-1"></i> Tambah Produk
</button>

<!-- Tabel Produk -->
<div class="card shadow-sm border-left-info">
    <div class="card-header bg-info text-white">
        <strong><i class="fas fa-box"></i> Data Produk</strong>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product as $index => $produk) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><strong><?= esc($produk['nama']) ?></strong></td>
                        <td><span class="badge bg-success">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></span></td>
                        <td><span class="badge bg-primary"><?= esc($produk['jumlah']) ?></span></td>
                        <td>
                            <?php if (!empty($produk['foto']) && file_exists(FCPATH . 'img/' . $produk['foto'])) : ?>
                                <img src="<?= base_url('img/' . $produk['foto']) ?>" class="img-thumbnail" width="80">
                            <?php else : ?>
                                <span class="text-muted">Tidak ada foto</span>
                            <?php endif; ?>
                        </td>
                        <td class="d-flex flex-wrap justify-content-center gap-1">
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $produk['id'] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?= base_url('delete/' . $produk['id']) ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <a href="<?= base_url('keranjang/add/' . $produk['id']) ?>" class="btn btn-sm btn-success">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal<?= $produk['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="<?= base_url('produk/edit/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="fas fa-edit me-1"></i> Edit Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama<?= $produk['id'] ?>" class="form-label">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="nama<?= $produk['id'] ?>" value="<?= esc($produk['nama']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga<?= $produk['id'] ?>" class="form-label">Harga</label>
                                            <input type="text" name="harga" class="form-control" id="harga<?= $produk['id'] ?>" value="<?= esc($produk['harga']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jumlah<?= $produk['id'] ?>" class="form-label">Jumlah</label>
                                            <input type="text" name="jumlah" class="form-control" id="jumlah<?= $produk['id'] ?>" value="<?= esc($produk['jumlah']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto<?= $produk['id'] ?>" class="form-label">Foto (Opsional)</label>
                                            <input type="file" class="form-control" id="foto<?= $produk['id'] ?>" name="foto">
                                            <?php if (!empty($produk['foto'])) : ?>
                                                <img src="<?= base_url('img/' . $produk['foto']) ?>" width="100px" class="mt-2 rounded shadow-sm">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-1"></i> Tambah Produk</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
