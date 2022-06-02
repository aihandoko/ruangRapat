<?= $this->extend('theme')?>

<?= $this->section('title')?>
Login
<?php $this->endSection();?>

<?= $this->section('content')?>

<form name="login">
<div class="login-wrapper">
    <div class="app-desc">
        <strong>Sistem Penerimaan Mahasiswa Baru (SPMB)</strong> merupakan aplikasi intranet Gramedia Printing yang digunakan untuk memantau dan atau menerbitkan persetujuan (approval) berkaitan dengan pengadaan dan pembelian barang dan jasa di lingkungan Gramedia Printing. Silahkan gunakan NIK dan password untuk menggunakan aplikasi.
    </div>
    <div class="separator"></div>
    
        <div class="login-box">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">Login</h2>
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
    
</div>
</form>

<?= $this->endSection()?>