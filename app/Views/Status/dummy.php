<?= $this->extend('theme')?>

<?= $this->section('content')?>

<div class="page-title-wrapper no-border mb-0">
    <h3 class="page-title">Status SPMB</h3>
    <div class="filter-icon">
        <i class="fas fa-filter"></i>
    </div>
</div>

<form name="dummyShowForm">
<div class="status-box mb-4">
    <div class="stat-param">
        <div class="row align-items-end">
            <div class="col-4">
                <div class="caption">Unit</div>
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
            <div class="col-3">
                <div class="caption">No</div>
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
            <!-- <div class="col-2">
                <div class="caption">Tahun</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="tahun">
                    </div>
                    <div class="separator">-</div>
                    <div class="item-form">
                        <input type="text" class="form-control" name="tahun2">
                    </div>
                </div>
            </div> -->
            <div class="col-2">
                <div class="caption">DeptId</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="deptId">
                    </div>
                </div>
            </div>
            <div class="col-3">
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
</form>

<h3 class="subtitle pt-2" id="subtitle">Status SPMB Dalam Proses ACC</h3>

<table id="dummyStatusList" class="table table-bordered table-striped" style="width: 100%">
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
        </tr>
    </thead>
</table>

<?= $this->endSection()?>