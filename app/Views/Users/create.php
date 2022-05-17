<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<?= $breadcrumbs?>

<div class="page-title-wrapper">
    <h3 class="page-title"><?= $page_title;?></h3>
    <a href="<?= site_url('users');?>" class="back-btn-icon">
        <i class="fas fa-chevron-left"></i> Back
    </a>
</div>

<?php if(session()->has('error')) :?>
<div class="alert alert-danger"><?= session()->get('error');?></div>
<?php endif;?>

<?php
$attributes = ['class' => 'addUserForm'];
echo form_open('users/addProcess', $attributes);?>
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <label for="nik" class="d-block">NIK</label>
                        </div>
                        <div class="col-lg-5 col-md-7 col-sm-12">
                            <input type="text" class="form-control<?= (session()->has('error')) ? ' border-danger' : '';?>" value="<?= old('nik');?>" id="nik" name="nik" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <label for="nama" class="d-block">Nama</label>
                        </div>
                        <div class="col-lg-5 col-md-7 col-sm-12">
                            <input type="text" class="form-control<?= (session()->has('error')) ? ' border-danger' : '';?>" value="<?= old('nama');?>" id="nama" name="nama" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <label class="d-block" for="fungsi">Fungsi</label>
                        </div>
                        <div class="col-lg-5 col-md-7 col-sm-12">
                            <select name="fungsi" id="fungsi" class="custom-select">
                                <?php foreach ($user_fungsi['fungsi'] as $key => $func) : ?>
                                    <option value="<?= $func;?>"><?= $func;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <label for="site" class="d-block">Site</label>
                        </div>
                        <div class="col-lg-5 col-md-7 col-sm-12">
                            <select readonly name="site" id="site" class="custom-select">
                                <?php foreach ($user_fungsi['sites'] as $key => $site) : ?>
                                    <option value="<?= $site;?>"><?= $site;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <label for="KodeSPMB" class="d-block">Kode SPMB</label>
                        </div>
                        <div class="col-lg-5 col-md-7 col-sm-12">
                            <input type="text" value="<?= old('KodeSPMB');?>" class="form-control" id="KodeSPMB" name="KodeSPMB">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <label for="compid" class="d-block">CompId</label>
                        </div>
                        <div class="col-lg-5 col-md-7 col-sm-12">
                            <input type="text" value="<?= old('compid');?>" class="form-control" id="compid" name="compid">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <label for="deptid" class="d-block">DeptId</label>
                        </div>
                        <div class="col-lg-5 col-md-7 col-sm-12">
                            <input type="text" value="<?= old('deptid');?>" class="form-control" id="deptid" name="deptid">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            &nbsp;
                        </div>
                        <div class="col-lg-5 col-md-7 col-sm-12">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" name="cancel" class="btn btn-secondary">Batal</button>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>   

<?= $this->endSection()?>