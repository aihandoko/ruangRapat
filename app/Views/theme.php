<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SPMB</title>
    <meta name="description" content="SPMB app">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link rel="stylesheet" href="<?= site_url('third-party/fontawesome/css/all.min.css'); ?>" />

    <link rel="stylesheet" href="<?= site_url('third-party/bootstrap/css/bootstrap.min.css'); ?>" />

    <link rel="stylesheet" type="text/css" href="<?= site_url('third-party/DataTables/datatables.min.css');?>" />

    <link rel="stylesheet" type="text/css" href="<?= site_url('css/style.css'); ?>" />
</head>

<body>

    <div id="page">

        <div class="main-wrapper">
            <header class="app-header">
                &nbsp;
            </header>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
            </footer>
        </div>

        <section class="sidebar">
            <div class="app-title-box">
                <h1 class="app-title">
                    SPMB
                </h1>
            </div>

            <div class="non-login-menu">
                <ul>
                    <li class="active">
                        <a href="<?= site_url('login');?>">Login</a>
                    </li>
                    <li>
                        <a href="<?= site_url('status');?>">Status SPMB</a>
                    </li>
                </ul>
            </div>
        </section>

    </div>

    <!-- SCRIPTS -->

    <script>
    </script>

    <!-- -->

</body>

</html>