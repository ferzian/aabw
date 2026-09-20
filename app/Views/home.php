<!-- memanggil template dari folder 'layout/backend.php' -->
<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<!-- dipindahkan dari file 'backend.php' bagian 'content' -->
<section class="section">
    <div class="section-header">
        <h1>Selamat Datang</h1>
    </div>

    <!-- disini isi halaman utamanya -->
    <div class="section-body">
        <!-- mengambil dari folder 'views/akun1/index.php' -->
         <h2>Sistem Informasi Akuntansi - AKN</h2>
         <h5>Sekolah Vokasi IPB</h5>
    </div>
</section>

<?= $this->endSection() ?>