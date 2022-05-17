<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>500 Error | Gagal terhubung dengan database :: SPMB</title>
    <meta name="description" content="SPMB app">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link rel="stylesheet" href="<?= site_url('third-party/fontawesome/css/all.min.css'); ?>" />

    <link rel="stylesheet" href="<?= site_url('third-party/bootstrap/css/bootstrap.min.css'); ?>" />

    <link rel="stylesheet" type="text/css" href="<?= site_url('css/style.css'); ?>" />
</head>

<body class="common-page">

    <?php
    if(count($dbs) > 0) {
        $db = '<code>' . implode('</code>, <code>', $dbs) . '</code>';
    } else {
        $db = '';
    }
    ?>

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
                        500. Gagal terhubung dengan database.
                    </div>
                    <p class="ctn">
                        Aplikasi gagal terhubung dengan database <?= $db;?>.<br />
                        Silahkan refresh kembali halaman atau hubungi IT Support.
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