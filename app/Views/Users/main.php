<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<h1 class="page-title"><?= $page_title;?></h1>

<?php if(session()->has('success')) :?>
<div class="alert alert-success"><?= session()->get('success');?></div>
<?php endif;?>
<?php if(session()->has('error')) :?>
<div class="alert alert-danger"><?= session()->get('error');?></div>
<?php endif;?>
<table id="usersList" class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
            <th width="40">#</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Fungsi</th>
            <th>Site</th>
            <th>Kode SPMB</th>
            <th>CompId</th>
            <th>DeptId</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
</table>

<div class="modal" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="addUserForm">
            <div class="modal-header">
                <h5 class="modal-title" id="placeholdersGuideLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="nik" class="d-block text-right">NIK</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="nik" name="nik">
                                    </div>
                                </div>    
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="nama" class="d-block text-right">Nama</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <label class="d-block text-right" for="fungsi">Fungsi</label>
                                    </div>
                                    <div class="col-6">
                                        <select name="fungsi" id="fungsi" class="custom-select">
                                            <option value="">--</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="site" class="d-block text-right">Site</label>
                                    </div>
                                    <div class="col-6">
                                        <select name="site" id="site" class="custom-select">
                                            <option value="">------</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="kode_spmb" class="d-block text-right">Kode SPMB</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="kode_spmb" name="kode_spmb">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="compid" class="d-block text-right">CompId</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="compid" name="compid">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="deptid" class="d-block text-right">DeptId</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="deptid" name="deptid">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>                    
                </table>
            </div>
            <div class="modal-footer">
                <div style="width: 100%;">
                    <div class="row">
                        <div class="col-6">
                            <div class="submit-indicator"></div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" name="cancel" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection()?>