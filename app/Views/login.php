<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login :: SPMB</title>
    <meta name="description" content="WebApp untuk kebutuhan kirim blasting email.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= site_url('third-party/fontawesome/css/all.min.css');?>" />

    <link rel="stylesheet" href="<?= site_url('third-party/bootstrap/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?= site_url('css/style.css');?>" />

</head>

<body>

    <div id="page">

        <div class="main-wrapper">
            <header class="app-header">
                &nbsp;
            </header>

            <div class="content">


                <div class="page centered-element">

                    <div class="login-wrapper">

                        <?= form_open('auth/checkLogin'); ?>
                        <div class="login-box">
                            <div class="row">
                                <div class="col-12">
                                    <h2>Login</h2>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <input type="text" name="nik" placeholder="NIK"
                                        class="form-control <?= (session()->has('error')) ? 'border-danger' : '';?>"
                                        value="dummy" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <input type="password" placeholder="Password" name="password" value="dummy"
                                        class="form-control <?= (session()->has('error')) ? 'border-danger' : '';?>" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
                                    <a href="<?= site_url('forgot_password');?>"></a>
                                </div>
                            </div>
                        </div>
                        </form>

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

    <script src="<?= site_url('third-party/jquery/jquery.min.js');?>"></script>
    <script src="<?= site_url('third-party/bootstrap/js/bootstrap.min.js');?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</body>

</html>