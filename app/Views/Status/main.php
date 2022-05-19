<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<?= $breadcrumbs?>
<div class="page-title-wrapper no-border mb-0">
    <h3 class="page-title"><?= $page_title;?></h3>
    <div class="filter-icon">
        <i class="fas fa-filter"></i>
    </div>
</div>

<?php if(session()->has('success')) : ?>
<div class="alert alert-success"><?= session()->get('success');?></div>
<?php endif;?>

<?php if(session()->has('error')) : ?>
<div class="alert alert-danger"><?= session()->get('error');?></div>
<?php endif;?>

<?php if(session()->has('warning')) : ?>
<div class="alert alert-warning"><?= session()->get('warning');?></div>
<?php endif;?>

<form name="spmb_filter">
<div class="status-box mb-4">
    <div class="stat-param">
        <div class="row align-items-end">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="caption unit upp">Unit</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="unit">
                    </div>
                    <div class="separator">-</div>
                    <div class="item-form">
                        <input type="text" class="form-control" name="unit2">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="caption no upp">No</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="no">
                    </div>
                    <div class="separator">-</div>
                    <div class="item-form">
                        <input type="text" class="form-control" name="no2">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-12">
                <div class="caption deptid">DeptId</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="deptId">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="form-btn">
                    <button type="submit" name="submit" class="btn btn-primary">
                        Tampilkan
                    </button>
                    <button type="button" class="btn btn-outline-primary clear">
                        Clear
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<h3 class="subtitle pt-2" id="subtitle">Status SPMB Dalam Proses ACC</h3>

<table id="statusList" class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
            <th width="40">#</th>
            <th>SPMB</th>
            <th>Site</th>
            <th>Step1</th>
            <th>Step2</th>
            <th>Step3</th>
            <th>Step4</th>
            <th>Step5</th>
            <th>Step6</th>
            <th>Step7</th>
            <?= (session()->get('Fungsi') == 'Admin') ? '<th>Pembatalan</th>' : '';?>
        </tr>
    </thead>
</table>

<?= $this->endSection()?>