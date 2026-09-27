<!-- memanggil template dari folder 'layout/backend.php' -->
<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Laba Rugi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- dipindahkan dari file 'backend.php' bagian 'content' -->
<section class="section">
    <div class="section-header">
        <h1>Laporan Laba Rugi</h1>
    </div>

    <!-- disini isi halaman utamanya -->
    <div class="section-body">
        <!-- mengambil dari folder 'views/akun1/index.php' -->
        <div class="card-body">
            <form action="<?= site_url('neracalajur') ?>" method="POST">
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
                            formaction="neracalajur/neracalajurpdf" value="Cetak PDF">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <!-- menambahkan id untuk pagination -->
                <table class="table table-striped table-md">
                    <thead class="judul">
                        <tr>
                            <td class="text-center" rowspan="2"></td>
                            <td class="text-right" rowspan="2">Pendapatan</td>
                            <td class="text-right" colspan="2">Beban</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $td = 0;
                        $tk = 0;
                        $tdjp = 0;
                        $tkjp = 0;
                        $totk = 0;
                        $totd = 0;
                        $lb_td = 0;
                        $lb_tk = 0;
                        $totns = 0;
                        $totkd = 0;
                        ?>
                        <?php foreach ($dttransaksi as $key => $value): ?>
                            <?php
                            $d = $value->jumdebit;
                            $k = $value->jumkredit;
                            $neraca = $d - $k;

                            // jurnal penyesuaian
                            $djp = $value->jumdebits;
                            $kjp = $value->jumkredits;
                            $neracajp = $djp - $kjp;

                            if ($neracajp < 0) {
                                $kreditnewjp = abs($neracajp);
                                $tkjp = $tkjp + $kreditnewjp;
                            } else {
                                $kreditnewjp = 0;
                            }

                            if ($neracajp > 0) {
                                $debitnewjp = $neracajp;
                                $tdjp = $tdjp + $debitnewjp;
                            } else {
                                $debitnewjp = 0;
                            }

                            if ($neraca < 0) {
                                $kreditnew = abs($neraca);
                                $tk = $tk + $kreditnew;
                            } else {
                                $kreditnew = 0;
                            }
                            if ($neraca > 0) {
                                $debitnew = $neraca;
                                $td = $td + $debitnew;
                            } else {
                                $debitnew = 0;
                            }

                            // tambahan jurnal penyesuaian
                            $ns = $debitnew - $kreditnew + $value->jumdebits - $value->jumkredits;

                            if ($ns > 0) {
                                $debs = $ns;
                                $totd = $totd + $debs;
                            } else {
                                $debs = 0;
                            }

                            if ($ns < 0) {
                                $kres = abs($ns);
                                $totk = $totk + $kres;
                            } else {
                                $kres = 0;
                            }

                            // laba rugi
                            $kode_akun = $value->kode_akun3;
                            $kode = substr($kode_akun, 0, 1);

                            if ($kode == 4) {
                                $lb_db = $kres;
                                $lb_td = $lb_td + $lb_db;
                            } else {
                                $lb_db = 0;
                            }
                            if ($kode == 5) {
                                $lb_kr = $debs;
                                $lb_tk = $lb_tk + $lb_kr;
                            } else {
                                $lb_kr = 0;
                            }

                            // neraca
                            if ($kode <= 3 and $ns > 0) {
                                $nrbs = $debs;
                                $totns = $totns + $nrbs;
                            } else {
                                $nrbs = 0;
                            }

                            if ($kode <= 3 and $ns < 0) {
                                $nrkd = abs($ns);
                                $totkd = $totkd + $nrkd;
                            } else {
                                $nrkd = 0;
                            }

                            ?>
                            <tr>
                                <?php
                                if ($value->kode_akun1 == 4) { ?>
                                    <td>
                                        <?= $value->nama_akun3 ?>
                                    </td>
                                    <td class="text-right">
                                        <?= number_format($lb_db, 0, ',', ',') ?>
                                    </td>
                                    <td class="text-right">

                                    </td>
                                    <?php
                                } ?>
                                <?php
                                if ($value->kode_akun1 == 5) { ?>
                                    <td class="text-right">

                                    </td>
                                    <td>
                                        <?= $value->nama_akun3 ?>
                                    </td>
                                    <td class="text-right">
                                        <?= number_format($lb_kr, 0, ',', ',') ?>
                                    </td>
                                    <?php
                                } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="judul">
                        <tr>
                            <td class="text-center"></td>
                            <td class="text-right"><?= number_format($lb_td, 0, ',', ',') ?></td>
                            <td class="text-right"><?= number_format($lb_tk, 0, ',', ',') ?></td>
                        </tr>
                        <tr class="khusus">
                            <td class="text-center"></td>
                            <td class="text-right">Laba Rugi</td>
                            <td class="text-right"><?= number_format($lb_td - $lb_tk, 0, ',', ',') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>