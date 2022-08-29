<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title'); ?> :: Ruang Rapat</title>
    <meta name="description" content="Ruang Rapat">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?= site_url('favicon.ico');?>" />
    <link rel="stylesheet" href="<?= site_url('third-party/fontawesome/css/all.min.css'); ?>" />
    <link rel="stylesheet" href="<?= site_url('third-party/bootstrap/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= site_url('third-party/DataTables/datatables.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?= site_url('css/style.css?'.time()); ?>" />
</head>

<body>

    <div id="page">
        
        <div class="overlay"></div>
        <div class="floating-msg<?= (session()->has('flash_success') || session()->has('flash_error')) ? ' show' : '';?>">
            <?php if(session()->has('flash_success')) : ?>
                <div class="alert alert-success"><?= session()->get('flash_success');?></div>
            <?php endif;?>
            <?php if(session()->has('flash_error')) : ?>
                <div class="alert alert-danger"><?= session()->get('flash_error');?></div>
            <?php endif;?>
        </div>

        <header class="header-wrapper">
            <div class="container">

                <div class="app-header">
                    <div class="sidebar-nav-btn">
                        <span data-placement="bottom" class="burger-icon active"><i class="fas fa-bars"></i></span>
                        <span data-placement="bottom" class="burger-icon-mobile"><i class="fas fa-bars"></i></span>
                    </div>

                    <?php if($auth->isLoggedIn()) : ?>
                        <div class="top-nav">
                            <div class="top-right-nav">
                                <div class="icon">
                                    <i class="far fa-user-circle"></i>
                                </div>
                                <div class="name">
                                    <?= session()->get('Nama');?>
                                </div>
                            </div>
                        </div>
                <?php endif;?>
                    </div>
                </div>

            </header>

        <div class="main-wrapper">
            <?php if(url_is('login')) :
                echo $this->renderSection('content');
            else : ?>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>
        </div>

        <section class="sidebar">
            <div class="app-title-box">
                <p class="app-title">
                    RuangRapat
                </p>
            </div>

            <div class="main-menu">
                <?php if($auth->isLoggedIn()) : ?>
                    <ul>
                        <li >
                            <a href="<?= site_url('queue/input');?>">Form Peminjaman</a>
                        </li>

                        <li>
                            <a href="<?= site_url('queue/index');?>">Jadwal Peminjaman</a>
                        </li>

                        <li >
                            <a href="<?= site_url('queue/antrian');?>">Antrian Peminjaman</a>
                        </li>

                        <li >
                            <a href="<?= site_url('queue/laporan');?>">Laporan Peminjaman</a>
                        </li>


                        <li>
                            <a href="<?= site_url('logout');?>" onclick="return confirm('Anda yakin untuk Logout?')">Logout</a>
                        </li>

                    </ul>

                <?php else : ?>
                    <ul>
                        <li<?= (url_is('login')) ? ' class="active"' : '' ?>>
                            <a href="<?= site_url('login');?>">Login</a>
                        </li>
                    </ul>
                <?php endif;?>

            </div>
        </section>

        <footer class="app-footer<?= (env('app.bottomFrame')) ? ' with-margin' : '';?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copyright">
                            &copy; <?= date("Y") ?> Group of Manufacture
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <!-- SCRIPTS -->

    <script src="<?= site_url('third-party/jquery/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= site_url('third-party/DataTables/datatables.min.js');?>"></script>
    <script type="text/javascript"
        src="<?= site_url('third-party/DataTables/DataTables-1.11.3/js/dataTables.bootstrap4.min.js');?>"></script>
    <script src="<?= site_url('third-party/bootstrap/js/popper.min.js'); ?>"></script>
    <script src="<?= site_url('third-party/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript">
        const HOST = "<?= base_url();?>"
    </script>

    <?php if(url_is('status') || url_is('status/*')) : ?>
        <script src="<?= site_url('js/status.js');?>"></script>
    <?php endif;?>
    <?php if(url_is('/') || url_is('queue') || url_is('queue/*')) : ?>
        <script src="<?= site_url('js/queue.js');?>"></script>
    <?php endif;?>
    <?php if(url_is('users') || url_is('users/*')) : ?>
        <script src="<?= site_url('js/users.js');?>"></script>
    <?php endif;?>
    <script src="<?= site_url('js/custom.js'); ?>"></script>
    <!-- -->

</body>

</html>