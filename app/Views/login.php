<?= $this->extend('theme')?>

<?= $this->section('title')?>
Login
<?php $this->endSection();?>

<?= $this->section('content')?>

<div class="login-wrapper">
    <!-- <form name="login"> -->
    <?= form_open('auth/checkLogin');?>
        <div class="login-box">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">Login</h2>
                    <?php if(session()->has('error')) : ?>
                    <div class="alert alert-danger"><?= session()->get('error');?></div>
                    <?php endif;?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" name="nik" placeholder="NIK" class="form-control form-control-lg <?= (session()->has('error')) ? 'border-danger' : '';?>" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input type="password" placeholder="Password" name="password" class="form-control form-control-lg <?= (session()->has('error')) ? 'border-danger' : '';?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                    <a href="<?= site_url('forgot_password');?>"></a>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection()?>