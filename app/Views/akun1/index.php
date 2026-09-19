<!-- memanggil template dari folder 'layout/backend.php' -->
<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<!-- dipindahkan dari file 'backend.php' bagian 'content' -->
<section class="section">
    <div class="section-header">
        <!-- <h1>Blank Page</h1> -->
        <a href="<?= site_url('akun1/new') ?>" class="btn btn-primary">Add New</a>
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
                <h4>Data Akun 1</h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Akun 1</th>
                                <th>Nama Akun</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dtakun1 as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->kode_akun1 ?></td>
                                    <td><?= $value->nama_akun1 ?></td>
                                    <td class="text-center" style="width:15%">
                                        <a href="<?= site_url('akun1/edit/' . $value->id_akun1) ?>" class="btn btn-warning"><i
                                                class="fas fa-pencil-alt btn-sm"></i>Edit</a>
                                        <a href="" class="btn btn-danger"><i class="fas fa-trash btn-sm"></i>Delete</a>
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