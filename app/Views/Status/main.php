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
            <div class="col-2">
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
            </div>
            <div class="col-2">
                <div class="caption">DeptId</div>
                <div class="forms">
                    <div class="item-form">
                        <input type="text" class="form-control" name="deptId">
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
                <td>
                    <?= $row['Step1'];
                    echo ($row['DateConverted'][0] != null) ? '<div class="acc-date">' . $row['DateConverted'][0] . '</div>' : '';
                    ?>
                </td>
                <td>
                    <?= $row['Step2'];
                    echo ($row['DateConverted'][1] != null) ? '<div class="acc-date">' . $row['DateConverted'][1] . '</div>' : '';
                    ?>
                </td>
                <td>
                    <?= $row['Step3'];
                    echo ($row['DateConverted'][2] != null) ? '<div class="acc-date">' . $row['DateConverted'][2] . '</div>' : '';
                    ?>
                </td>
                <td>
                    <?= $row['Step4'];
                    echo ($row['DateConverted'][3] != null) ? '<div class="acc-date">' . $row['DateConverted'][3] . '</div>' : '';
                    ?>
                </td>
                <td>
                    <?= $row['Step5'];
                    echo ($row['DateConverted'][4] != null) ? '<div class="acc-date">' . $row['DateConverted'][4] . '</div>' : '';
                    ?>
                </td>
                <td>
                    <?= $row['Step6'];
                    echo ($row['DateConverted'][5] != null) ? '<div class="acc-date">' . $row['DateConverted'][5] . '</div>' : '';
                    ?>
                </td>
                <td>
                    <?= $row['Step7'];
                    echo ($row['DateConverted'][7] != null) ? '<div class="acc-date">' . $row['DateConverted'][7] . '</div>' : '';
                    ?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?= $this->endSection()?>