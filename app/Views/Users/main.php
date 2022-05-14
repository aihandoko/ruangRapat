<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<h1 class="page-title"><?= $page_title;?></h1>

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
                <div class="form-group row">
                    <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nik" name="nik">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fungsi" class="col-sm-3 col-form-label">Fungsi</label>
                    <div class="col-sm-9">
                        <select name="fungsi" id="fungsi" class="custom-select">
                            <option value="">--</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="site" class="col-sm-3 col-form-label">Site</label>
                    <div class="col-sm-9">
                        <select name="site" id="site" class="custom-select">
                            <option value="">------</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_spmb" class="col-sm-3 col-form-label">Kode SPMB</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_spmb" name="kode_spmb">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="compid" class="col-sm-3 col-form-label">CompId</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="compid" name="compid">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deptid" class="col-sm-3 col-form-label">DeptId</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="deptid" name="deptid">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection()?>