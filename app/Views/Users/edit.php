<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<h1 class="page-title"><?= $page_title;?></h1>

<?php if(session()->has('error')) :?>
<div class="alert alert-danger"><?= session()->get('error');?></div>
<?php endif;?>

<?php
$attributes = ['class' => 'addUserForm'];
echo form_open('users/editProcess', $attributes, $input_hidden);?>
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-5">
                            <label for="nik" class="d-block text-right">NIK</label>
                        </div>
                        <div class="col-5">
                            <input type="text" class="form-control<?= (session()->has('error')) ? ' border-danger' : '';?>" value="<?= old('nik') ?? $data['NIK'];?>" id="nik" name="nik" />
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
                        <div class="col-5">
                            <input type="text" class="form-control<?= (session()->has('error')) ? ' border-danger' : '';?>" value="<?= old('nama') ?? $data['Nama'];?>" id="nama" name="nama" />
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
                        <div class="col-5">
                            <select name="fungsi" id="fungsi" class="custom-select">
                                <?php foreach ($user_fungsi['fungsi'] as $key => $func) :
                                    $selected = ($func == $data['Fungsi']) ? ' selected' : '';?>
                                    <option<?= $selected;?> value="<?= $func;?>"><?= $func;?></option>
                                <?php endforeach;?>
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
                        <div class="col-5">
                            <select name="site" id="site" class="custom-select">
                                <?php foreach ($user_fungsi['sites'] as $key => $func) :
                                    $selected = ($func == $data['Site']) ? ' selected' : '';?>
                                    <option<?= $selected;?> value="<?= $func;?>"><?= $func;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-5">
                            <label for="KodeSPMB" class="d-block text-right">Kode SPMB</label>
                        </div>
                        <div class="col-5">
                            <input type="text" value="<?= old('KodeSPMB') ?? $data['KodeSPMB'];?>" class="form-control" id="KodeSPMB" name="KodeSPMB">
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
                        <div class="col-5">
                            <input type="text" value="<?= old('compid') ?? $data['CompId'];?>" class="form-control" id="compid" name="compid">
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
                        <div class="col-5">
                            <input type="text" value="<?= old('deptid') ?? $data['DeptId'];?>" class="form-control" id="deptid" name="deptid">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-5">
                            &nbsp;
                        </div>
                        <div class="col-5">
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