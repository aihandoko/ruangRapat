<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<?= $breadcrumbs?>

<div class="page-title-wrapper">
    <h3 class="page-title"><?= $page_title;?></h3>
</div>

<div class="status-box mb-4 p-4">
    <div class="row">
        <div class="col-5">
            <div class="row mb-2">
                <div class="col-5">
                    Site
                </div>
                <div class="col-7">
                    : <?= $routes[0]['Site'];?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    Request No
                </div>
                <div class="col-7">
                    : <?= $data[0]['ReqNo'];?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    Request Date
                </div>
                <div class="col-7">
                    : <?= $data[0]['ReqDate'];?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    Comp Id
                </div>
                <div class="col-7">
                    : <?= $data[0]['CompId'];?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    Cost Ctr
                </div>
                <div class="col-7">
                    : <?= $DeptName;?> (<?= $routes[0]['DeptId'];?>)
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="row mb-2">
                <div class="col-5">
                    Req Dept
                </div>
                <div class="col-7">
                    : <?= $DeptName;?> (<?= $routes[0]['DeptId'];?>)
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    Description
                </div>
                <div class="col-7">
                    : <?= $data[0]['ReqDescription'];?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    Route Otorisasi
                </div>
                <div class="col-7">
                    : <?= $route_otorisasi;?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    Attachment
                </div>
                <div class="col-7">
                    : &nbsp;
                </div>
            </div>
        </div>
    </div>

    
</div>

<table class="table table-bordered table-striped mb-5">
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

<h3 class="subtitle">Catatan-catatan</h3>
<div class="notes-box mb-5">
    <?php
    if(count($notes) > 0) {
        foreach($notes as $key => $note) {
            $mb = ($key !== count($notes) - 1) ? ' mb-4' : '';
            if($note['Catatan'] != null || $note['Catatan'] != '') : ?>
            <div class="note-item<?= $mb;?>">
                <div class="position"><?= $note['Posisi'];?></div>
                    <div class="detail-notes">
                        <?= $note['Catatan'];?>
                    </div>
            </div>
            <?php
            endif;
        }
    }
    ?>
</div>

<h3 class="subtitle">Otorisasi</h3>

<div class="authorization-box">
    <?php //foreach($otorisasi as $auth_item) :
    if($otorisasi !== '') {
        if($auth_res[0]['Tolak'] == 0 && $auth_res[0]['Batal'] == 0) {
            $signature = $auth_res[0]['Acc'];
        } else {
            if($auth_res[0]['Tolak'] == 1) {
                $signature = 'tolak';
            } else {
                $signature = 'batal';
            }
        }
        ?>
        <div class="auth-item">
            <div class="position"><?= $auth_res[0]['Posisi'];?></div>
            <div class="date"><?= $auth_res[0]['TglAcc'];?></div>
            <div class="signature">
                <?php if(file_exists("http://10.14.80.203/paraf/<?= $signature;?>.gif")) : ?>
                    <img src="http://10.14.80.203/paraf/<?= $signature;?>.gif" />
                <?php else : ?>
                    <div class="icon">
                        <i class="fas fa-ban"></i>
                    </div>
                <?php endif;?>
            </div>
            <div class="name"><?= $otorisasi;?></div>
        </div>
    <?php
}
//endforeach;?>
</div>

<?= $this->endSection()?>