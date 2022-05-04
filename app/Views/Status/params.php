<?= $this->extend('theme')?>

<?= $this->section('content')?>

<h3 class="page-title">Status SPMB</h3>

<?= form_open('status/withParams');?>
<div class="status-box mb-4">
    <div class="stat-param">
        <div class="row align-items-end">
            <div class="col-3">
                <div class="caption">Unit</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="unit" value="<?= $dataPost['unit'];?>">
                    </div>
                    <div class="separator">-</div>
                    <div class="item-form">
                        <input type="text" class="form-control" name="unit2" value="<?= $dataPost['unit2'];?>">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="caption">No</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="no" value="<?= $dataPost['no'];?>">
                    </div>
                    <div class="separator">-</div>
                    <div class="item-form">
                        <input type="text" class="form-control" name="no2" value="<?= $dataPost['no2'];?>">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="caption">Tahun</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="tahun" value="<?= $dataPost['tahun'];?>">
                    </div>
                    <div class="separator">-</div>
                    <div class="item-form">
                        <input type="text" class="form-control" name="tahun2" value="<?= $dataPost['tahun2'];?>">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="caption">DeptId</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="deptId" value="<?= $dataPost['deptId'];?>">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">
                    Tampilkan
                </button>
            </div>
        </div>
    </div>
</div>
</form>

<h3 class="subtitle pt-2">Status SPMB Dalam Proses ACC</h3>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 30px;">No</th>
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
    <tbody>
        <?php foreach($data as $key => $row) : ?>
            <tr>
                <td><?= $key + 1;?></td>
                <td><a href="<?= site_url('status/detail/'.$row['SPMBNo']);?>"><?= $row['SPMBNo'];?></a></td>
                <td><?= $row['Site'];?></td>
                <td><?= $row['Step1'];?></td>
                <td><?= $row['Step2'];?></td>
                <td><?= $row['Step3'];?></td>
                <td><?= $row['Step4'];?></td>
                <td><?= $row['Step5'];?></td>
                <td><?= $row['Step6'];?></td>
                <td><?= $row['Step7'];?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?= $this->endSection()?>