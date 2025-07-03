<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card shadow p-4">
    <h3 class="mb-4 text-primary">Get To Know Us</h3>

    <p>
        <strong>Alwi Shop</strong> — Temukan berbagai gadget terbaru, original, dan bergaransi hanya di Alwi Shop.
        Kami hadir untuk memenuhi kebutuhan teknologi Anda — dari smartphone, tablet, smartwatch, hingga aksesoris digital terkini.
    </p>

    <p>
        Kami hadir sejak 2010 dan sudah dipercaya ratusan pelanggan dari berbagai penjuru.
        Di Alwi Shop, belanja gadget jadi lebih mudah dan nyaman. Cukup pesan dari rumah, biar kami yang kirim ke pintu Anda.
    </p>

    <p>
        Kami mengucapkan terima kasih atas kepercayaan Anda berbelanja di <strong>Alwi Shop</strong>. Kepuasan Anda adalah prioritas utama kami.
    </p>

    <!-- Gambar About -->
    <div class="text-center mt-4">
        <img src="<?= base_url('img/about.jpg') ?>" 
             alt="Tentang Alwi Shop" 
             class="img-fluid rounded shadow" 
             style="max-width: 500px;">
        <p class="text-muted mt-2">Kami siap melayani Anda dengan sepenuh hati ❤️</p>
    </div>
</div>

<?= $this->endSection() ?>
