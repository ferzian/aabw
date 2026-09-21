memanggil template dari folder 'layout/backend.php'
<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<!-- dipindahkan dari file 'backend.php' bagian 'content' -->
<section class="section">
    <div class="section-header">
        <!-- <h1>Blank Page</h1> -->
        <a href="<?= site_url('transaksi') ?>" class="btn btn-primary">Back</a>
    </div>

    <!-- disini isi halaman utamanya -->
    <div class="section-body">
        <!-- mengambil dari folder 'views/akun1/index.php' -->
        <div class="card">
            <div class="card-header">
                <h4>Tambah Data Transaksi</h4>
            </div>
            <div class="card-body p-4">
                <form method="post" action="<?= site_url('transaksi') ?>">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Kwitansi</label>
                        <input type="text" class="form-control" name="kwitansi" placeholder="Kwitansi" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
                    </div>
                    <div class="form-group">
                        <label>Ket Jurnal</label>
                        <input type="text" class="form-control" name="ketjurnal" placeholder="Ket Jurnal" required>
                    </div>

                    <div class="box-body">
                        <table class="table table-bordered" id="tableLoop">
                            <thead>
                                <tr>
                                    <th>No/th>
                                    <th>Kode Akun</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Status</th>
                                    <th>
                                        <button class="btn btn-primary btn-sm btn-block" id="Barisbaru"><i
                                                class="fa fa-plus"></i>Add Row</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- form dinamis jQuery -->
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i>Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>