<html>

<head>
    <style type="text/css">
        .aturkiri {
            text-align: left;
        }

        .aturkanan {
            text-align: right;
        }

        .aturtengah {
            text-align: center;
        }

        .spesifik {
            font-style: italic;
            word-spacing: 30px;
        }

        .judul {
            font-style: italic;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <p class="judul">Neraca Saldo</p>
    Periode : <?= date('d F Y', strtotime($tglawal)) . " s/d " . date('d F Y', strtotime($tglakhir)) ?>
    <br>
    <br>

    <table border="0.1" class="table table-bordered">
        <thead class="judul">
            <tr>
                <td class="aturtengah" rowspan="2" width="125px">Kode Akun</td>
                <td class="aturkiri" rowspan="2" width="200px">Keterangan</td>
                <td class="text-center" colspan="2" width="50px">Saldo</td>
            </tr>
            <tr>
                <td class="text-center" width="50px">Debit</td>
                <td class="text-center" width="50px">Kredit</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $td = 0;
            $tk = 0;
            ?>
            <?php foreach ($dttransaksi as $key => $value): ?>
                <?php
                $d = $value->jumdebit;
                $k = $value->jumkredit;
                $neraca = $d - $k;

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
                    $debittnew = 0;
                }

                ?>
                <tr>
                    <td width="125px">
                        <?= $value->kode_akun3 ?>
                    </td>
                    <td width="200px">
                        <?= $value->nama_akun3 ?>
                    </td>
                    <td width="50px" class="aturkanan">
                        <?= number_format($debitnew, 0, ',', ',') ?>
                    </td>
                    <td width="50px" class="aturkanan">
                        <?= number_format($kreditnew, 0, ',', ',') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot class="judul">
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="aturkanan">
                    <?= number_format($td, 0, ',', ',') ?>
                </td>
                <td class="aturkanan">
                    <?= number_format($tk, 0, ',', ',') ?>
                </td>
            </tr>
        </tfoot>
    </table>

    <br>
    <br>
    <br>
    <br>
    <br>

    <?php
    $tgl = date('l, d-m-y');
    echo $tgl;
    ?>

    <br>
    <br>
    <br>
    <br>
    Pimpinan AKN

</body>

</html>