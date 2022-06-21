<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>404 Error | Halaman tidak tersedia :: SPMB</title>
    <meta name="description" content="SPMB app">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link rel="stylesheet" href="<?= site_url('third-party/fontawesome/css/all.min.css'); ?>" />

    <link rel="stylesheet" href="<?= site_url('third-party/bootstrap/css/bootstrap.min.css'); ?>" />

    <link rel="stylesheet" type="text/css" href="<?= site_url('css/style.css'); ?>" />
</head>

<body class="common-page">

    <div id="page">
        <header class="common-header">
            <div class="container">
                <div class="col-12">
                    <h1 class="app-title">
                        SPMB
                    </h1>
                </div>
            </div>
        </header>

        <div class="main-wrapper to-sidebar-hide">
            <div class="not-found-wrapper">
                <div class="not-found">
                    <div class="giant-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="title">
                        404. Halaman tidak ditemukan.
                    </div>
                    <p class="ctn">
                        Maaf, halaman <code><?= current_url();?></code> tidak tersedia dan gagal ditemukan.
                    </p>
                    <p>
                        <?= anchor('/', 'Kembali ke halaman utama', ['class' => 'btn btn-primary']);?>
                    </p>
                </div>
            </div>
        </div>

        <footer class="app-footer to-sidebar-hide mt-0">
            <div class="container">
                <div class="copyright">
                    &copy; <?= date("Y") ?> KG of Manufacture
                </div>
            </div>
        </footer>

    </div>

</body>
</html>