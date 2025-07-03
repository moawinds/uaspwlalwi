<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="card shadow p-4">
    <h3 class="mb-4 text-primary">Kontak Kami</h3>
    
    <ul class="list-unstyled">
        <li><strong>Nama Perusahaan:</strong> Alwi Shop Official</li>
        <li><strong>Alamat Kantor:</strong> Jl. Pemuda No. 246, Semarang Tengah, Kota Semarang 15472</li>
        <li><strong>Nomor Telepon:</strong> 081229542787</li>
        <li><strong>Email:</strong> @alwishop.co.id</li>
    </ul>

    <!-- Gambar Toko -->
    <div class="text-center mt-4">
        <img src="<?= base_url('img/store.jpeg') ?>" 
             alt="Tampilan Toko" 
             class="img-fluid rounded shadow" 
             style="max-width: 500px;">
        <p class="text-muted mt-2">Tampilan depan toko Alwi Shop Official</p>
    </div>
</div>
<?= $this->endSection() ?>
