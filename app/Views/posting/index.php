<!-- memanggil template dari folder 'layout/backend.php' -->
<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Posting</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- dipindahkan dari file 'backend.php' bagian 'content' -->
<section class="section">
    <div class="section-header">
        <h1>Laporan Posting</h1>
    </div>

    <!-- disini isi halaman utamanya -->
    <div class="section-body">
        <!-- mengambil dari folder 'views/akun1/index.php' -->
        <div class="card-body">
            <form action="<?= site_url('posting') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row g-3">
                    <div class="col">
                        <input type="date" name="tglawal" class="form-control" value="<?= $tglawal ?>">
                    </div>
                    <div class="col">
                        <input type="date" name="tglakhir" class="form-control" value="<?= $tglakhir ?>">
                    </div>
                    <div class="col">
                        <select name="kode_akun3" class="form-control">
                            <option selected>Pilih Kode Akun</option>
                            <?php foreach ($dtakun3 as $key => $value): ?>
                                <option value="<?= $value->kode_akun3 ?>" <?= $kode_akun3 == $value->kode_akun3 ? 'selected' : null ?>> <?= $value->kode_akun3 ?>
                                    |
                                    <?= $value->nama_akun3 ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-list"></i>Tampilkan</button>
                        <input type="submit" formtarget="_blank" class="btn btn-success" formaction="posting/postingpdf"
                            value="Cetak PDF">
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
                            <td class="text-center" rowspan="2">Tanggal</td>
                            <td class="text-center" rowspan="2">Keterangan</td>
                            <td class="text-center" rowspan="2">Ref</td>
                            <td class="text-center" rowspan="2">Debit</td>
                            <td class="text-center" rowspan="2">Kredit</td>
                            <td class="text-center" colspan="2">Neraca</td>
                        </tr>
                        <tr>
                            <td>Debit</td>
                            <td>Kredit</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dbt = 0;
                        ?>
                        <?php foreach ($dttransaksi as $key => $value): ?>
                            <?php
                            if ($value->debit) {
                                $dbt = $dbt + $value->debit;
                            } else {
                                $dbt = $dbt - $value->kredit;
                            }

                            $ndbt1 = $dbt >= 0 ? $dbt : 0;
                            $ndbt2 = $dbt < 0 ? $dbt : 0;

                            ?>
                            <tr>
                                <td>
                                    <?= $value->tanggal ?>
                                </td>
                                <td>
                                    <?= $value->kode_akun3 ?>
                                </td>
                                <td>
                                    <?= $value->ketjurnal ?>
                                </td>
                                <td class="text-right">
                                    <?= number_format($value->debit, 0, ',', ',') ?>
                                </td>
                                <td class="text-right">
                                    <?= number_format($value->kredit, 0, ',', ',') ?>
                                </td>
                                <td class="text-right">
                                    <?= number_format($ndbt1, 0, ',', ',') ?>
                                </td>
                                <td class="text-right">
                                    <?= number_format(abs($ndbt2), 0, ',', ',') ?>
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