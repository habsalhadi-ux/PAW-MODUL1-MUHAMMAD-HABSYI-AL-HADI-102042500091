<?php
// 1. Data produk disimpan menggunakan array PHP
$produk = [
    ["nama" => "Monitor 24 Inch", "kategori" => "Monitor", "harga" => 1800000, "stok" => 4],
    ["nama" => "Laptop Productivity", "kategori" => "Laptop", "harga" => 8500000, "stok" => 3],
    ["nama" => "Keyboard Mekanikal", "kategori" => "Aksesoris", "harga" => 750000, "stok" => 15],
    ["nama" => "Mouse Wireless", "kategori" => "Aksesoris", "harga" => 250000, "stok" => 0],
    ["nama" => "Headset Gaming", "kategori" => "Audio", "harga" => 1200000, "stok" => 5],
    ["nama" => "Webcam 1080p", "kategori" => "Kamera", "harga" => 600000, "stok" => 0]
];

// Fungsi untuk memformat mata uang Rupiah
function formatRupiah($angka) {
    return "Rp" . number_format($angka, 0, ',', '.');
}

// Menghitung jumlah seluruh produk
$total_produk = count($produk);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store - Tech Shop</title>
    <!-- Menghubungkan ke file CSS eksternal -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="logo">Cia Store</div>
        <nav>
            <a href="#">Beranda</a>
            <a href="#katalog">Produk</a>
            <a href="#">Tentang Kami</a>
        </nav>
    </header>

    <section class="hero">
        <div style="font-size: 14px; font-weight: 600; letter-spacing: 3px; margin-bottom: 15px; color: #cbd5e1;">CIA STORE</div>
        <h1>Upgrade Teknologimu Sekarang.</h1>
        <p>Temukan berbagai perangkat keras dan aksesoris komputer terbaik untuk menunjang produktivitasmu sehari-hari.</p>
        <a href="#katalog" class="btn-hero">Lihat Katalog Produk</a>
    </section>

    <div class="info-bar" id="katalog">
        <div>
            <div style="font-size: 13px; color: #64748b; text-transform: uppercase; font-weight: 700; margin-bottom: 5px;">Koleksi Kami</div>
            <h2>Katalog Produk</h2>
        </div>
        <div class="total-badge">Total Produk Tersedia: <strong><?= $total_produk ?></strong></div>
    </div>

    <main class="katalog">
        <?php
        foreach ($produk as $item) {
            $harga_asli = $item['harga'];
            $stok = $item['stok'];
            $dapat_diskon = $harga_asli >= 1000000;
            $nilai_diskon = $dapat_diskon ? (0.10 * $harga_asli) : 0;
            $harga_akhir = $harga_asli - $nilai_diskon;
            $status_class = $stok > 0 ? "tersedia" : "habis";
            $status_text = $stok > 0 ? "Tersedia" : "Stok Habis";
        ?>
        <article class="card">
            <div class="card-header">
                <span><?= htmlspecialchars($item['kategori']) ?></span>
                <?php if ($dapat_diskon): ?>
                    <span class="badge-diskon">DISKON 10%</span>
                <?php endif; ?>
            </div>
            
            <h3><?= htmlspecialchars($item['nama']) ?></h3>
            
            <div>
                <?php if ($dapat_diskon): ?>
                    <div class="harga-normal"><?= formatRupiah($harga_asli) ?></div>
                <?php endif; ?>
                <div class="harga-akhir"><?= formatRupiah($harga_akhir) ?></div>
            </div>
            
            <div class="status-bar">
                <span class="stok-text">Stok: <strong><?= $stok ?></strong></span>
                <span class="badge-status <?= $status_class ?>"><?= $status_text ?></span>
            </div>
            
            <?php 
            // 5. Menyembunyikan tombol jika stok habis
            if ($stok > 0): 
            ?>
                <button class="btn-beli">Masukkan Keranjang</button>
            <?php endif; ?>
        </article>
        <?php } ?>
    </main>

    <footer>
        &copy; <?= date("Y") ?> Cia Store. Dibuat untuk Modul Praktikum Web.
    </footer>

</body>
</html>
