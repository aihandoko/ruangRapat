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
            <header class="header-wrapper">
                <div class="app-header">
                        <div class="top-nav">
                            <div class="top-right-nav dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                    <div class="icon">
                                        <i class="far fa-user-circle"></i>
                                    </div>
                                    <div class="name">
                                        <?= session()->get('Nama');?>
                                    </div>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="<?= site_url('myprofile'); ?>" class="dropdown-item">Profil</a>
                                    <a href="<?= site_url('logout'); ?>" onclick="return confirm('Anda yakin untuk Logout?')"
                                        class="dropdown-item">Logout</a>
                                </div>
                            </div>
                        </div>
                </div>
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

            <div class="main-menu">
                <?php if($auth->isLoggedIn()) : ?>
                    <ul>
                        <li>
                            <a href="<?= site_url('/');?>">Dashbor</a>
                        </li>
                        <li>
                            <a href="<?= site_url('switch');?>">Switch fungsi</a>
                        </li>
                        <li>
                            <a href="<?= site_url('queue');?>">Antrian SPMB</a>
                        </li>
                        <li>
                            <a href="<?= site_url('status');?>">Status SPMB</a>
                        </li>
                        <li>
                            <a href="<?= site_url('users');?>">Users</a>
                        </li>
                        <li>
                            <a href="<?= site_url('logout');?>">Logout</a>
                        </li>
                    </ul>
                <?php else : ?>
                    <ul>
                        <li class="active">
                            <a href="<?= site_url('login');?>">Login</a>
                        </li>
                        <li>
                            <a href="<?= site_url('status');?>">Status SPMB</a>
                        </li>
                    </ul>
                <?php endif;?>
            </div>
        </section>

    </div>

    <!-- SCRIPTS -->

    <script src="<?= site_url('third-party/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= site_url('third-party/bootstrap/js/popper.min.js'); ?>"></script>
    <script src="<?= site_url('third-party/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <!-- -->

</body>

</html>