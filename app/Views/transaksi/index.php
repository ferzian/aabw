<!-- memanggil template dari folder 'layout/backend.php' -->
<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Transaksi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- dipindahkan dari file 'backend.php' bagian 'content' -->
<section class="section">
    <div class="section-header">
        <!-- <h1>Blank Page</h1> -->
        <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary">Add New</a>
    </div>

    <!-- untuk menangkap alert session success -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    <?php endif ?>

    <!-- session error -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
    <?php endif ?>

    <!-- disini isi halaman utamanya -->
    <div class="section-body">
        <!-- mengambil dari folder 'views/akun1/index.php' -->
        <div class="card">
            <div class="card-header">
                <h4>Transaksi Jurnal</h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <!-- menambahkan id untuk pagination -->
                    <table class="table table-striped table-md " id='myTable'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kwitansi</th>
                                <th>Tanggal</th>
                                <th>Ket Jurnal</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dttransaksi as $key => $value): ?>
                                <tr>
                                    <td>
                                        <?= $key + 1 ?>
                                    </td>
                                    <td>
                                        <?= $value->kwitansi ?>
                                    </td>
                                    <td>
                                        <?= $value->tanggal ?>
                                    </td>
                                    <td>
                                        <?= $value->deskripsi ?>
                                    </td>
                                    <td>
                                        <?= $value->ketjurnal ?>
                                    </td>
                                    <td class="text-center" style="width:20%">
                                        <a href="<?= site_url('transaksi/' . $value->id_transaksi) ?>"
                                            class="btn btn-info btn-small"><i class="fas fa-bars btn-small"></i>Detail</a>
                                        <a href="<?= site_url('transaksi/' . $value->id_transaksi) . '/edit' ?>"
                                            class="btn btn-warning"><i class="fas fa-pencil-alt btn-small"></i>Edit</a>
                                        <form action="<?= site_url('transaksi/' . $value->id_transaksi) ?>" method="post"
                                            id="del-<?= $value->id_transaksi ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-small"
                                                data-confirm="Hapus data? | Apakah anda yakin? Karena data tabel relasi akan terhapus semua."
                                                data-confirm-yes="hapus(<?= $value->id_transaksi ?>)"><i
                                                    class="fas fa-trash"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>