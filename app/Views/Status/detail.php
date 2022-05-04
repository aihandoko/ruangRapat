<?= $this->extend('theme')?>

<?= $this->section('content')?>

<h3 class="page-title">ACC SPMB</h3>

<div class="status-box mb-4 pt-3 pb-3">
    <div class="row mb-2">
        <div class="col-5 text-right">
            Site
        </div>
        <div class="col-7">
            &nbsp;
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-5 text-right">
            Request No
        </div>
        <div class="col-7">
            <?= $data[0]['ReqNo'];?>
        </div>
    </div>
    <div class="row">
        <div class="col-5 text-right">
            Request Date
        </div>
        <div class="col-7">
            <?= $data[0]['ReqDate'];?>
        </div>
    </div>
    <div class="row">
        <div class="col-5 text-right">
            Comp Id
        </div>
        <div class="col-7">
            <?= $data[0]['CompId'];?>
        </div>
    </div>
    <div class="row">
        <div class="col-5 text-right">
            Cost Ctr
        </div>
        <div class="col-7">
            <?= $DeptName;?> (<?= $routes[0]['DeptId'];?>)
        </div>
    </div>
    <div class="row">
        <div class="col-5 text-right">
            Req Dept
        </div>
        <div class="col-7">
            <?= $DeptName;?> (<?= $routes[0]['DeptId'];?>)
        </div>
    </div>
    <div class="row">
        <div class="col-5 text-right">
            Description
        </div>
        <div class="col-7">
            <?= $data[0]['ReqDescription'];?>
        </div>
    </div>
    <div class="row">
        <div class="col-5 text-right">
            Route Otorisasi
        </div>
        <div class="col-7">
            <?= $route_otorisasi;?>
        </div>
    </div>
    <div class="row">
        <div class="col-5 text-right">
            Attachment
        </div>
        <div class="col-7">
            &nbsp;
        </div>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No Item</th>
            <th>Nama Barang</th>
            <th>No Account</th>
            <th>Sat</th>
            <th>Qty</th>
            <th>Target</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $val) : ?>
            <tr>
                <td><?= $val['ItemId'];?></td>
                <td><?= $val['ItemName'];?></td>
                <td><?= $val['AccountNo'];?></td>
                <td><?= $val['UnitCode'];?></td>
                <td><?= $val['ItemQty'];?></td>
                <td><?= $val['TargetDate'];?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<h3 class="">Otorisasi</h3>

<div class="authorization-box">
    <?php foreach($otorisasi as $auth_item) :
        if($auth_item['Tolak'] == 0 && $auth_item['Batal'] == 0) {
            $signature = $auth_item['Acc'];
        } else {
            if($auth_item['Tolak'] == 1) {
                $signature = 'tolak';
            } else {
                $signature = 'batal';
            }
        }
        ?>
        <div class="auth-item">
            <div class="position"><?= $auth_item['Posisi'];?></div>
            <div class="date"><?= $auth_item['TglAcc'];?></div>
            <div class="signature">
                <img src="http://10.14.80.203/paraf/<?= $signature;?>.gif" />
            </div>
            <div class="name"><?= $auth_item['Nama'];?></div>
        </div>
    <?php endforeach;?>
</div>

<?= $this->endSection()?>