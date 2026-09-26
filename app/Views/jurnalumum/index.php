<!-- memanggil template dari folder 'layout/backend.php' -->
<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Jurnal Umum</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- dipindahkan dari file 'backend.php' bagian 'content' -->
<section class="section">
    <div class="section-header">
        <h1>Laporan Jurnal Umum</h1>
    </div>

    <!-- disini isi halaman utamanya -->
    <div class="section-body">
        <!-- mengambil dari folder 'views/akun1/index.php' -->
        <div class="card-body">
            <form action="<?= site_url('jurnalumum') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row g-3">
                    <div class="col">
                        <input type="date" name="tglawal" class="form-control" value="<?= $tglawal ?>">
                    </div>
                    <div class="col">
                        <input type="date" name="tglakhir" class="form-control" value="<?= $tglakhir ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-list"></i>Tampilkan</button>
                        <input type="submit" formtarget="_blank" class="btn btn-success"
                            formaction="jurnalumum/cetakjupdf" value="Cetak PDF">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <!-- menambahkan id untuk pagination -->
                <table class="table table-striped table-md">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Ref</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dttransaksi as $key => $value): ?>
                            <tr>
                                <td>
                                    <?= $value->tanggal ?>
                                </td>
                                <td>
                                    <?= $value->nama_akun3 ?>
                                </td>
                                <td>
                                    <?= $value->kode_akun3 ?>
                                </td>
                                <td class="text-right">
                                    <?= number_format($value->debit, 0, ',', ',') ?>
                                </td>
                                <td class="text-right">
                                    <?= number_format($value->kredit, 0, ',', ',') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>