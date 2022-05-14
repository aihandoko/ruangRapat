<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<h3 class="page-title"><?= $page_title;?></h3>

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
            ?>
            <div class="note-item<?= $mb;?>">
                <div class="position"><?= $note['Posisi'];?></div>
                <?php if($note['Catatan'] != null || $note['Catatan'] != '') : ?>
                    <div class="detail-notes">
                        <?= $note['Catatan'];?>
                    </div>
                <?php endif;?>
            </div>
            <?php
        }
    }
    ?>
</div>

<h3 class="subtitle">Otorisasi</h3>

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

<h3 class="subtitle mt-5">Catatan</h3>

<div class="notes-box">
    <?= form_open('status/accProcess');?>
    <div class="row">
        <div class="col-6">
            <textarea name="acc_notes" id="acc_notes" class="form-control" rows="5"></textarea>
            <div id="display_count"></div>
            <input type="hidden" name="reqno" value="<?= $data[0]['ReqNo'];?>" />
            <input type="hidden" name="compid" value="<?= $data[0]['CompId'];?>" />
            <input type="hidden" name="spmbno" value="<?= $id;?>" />
            <input type="hidden" name="kode_route" value="<?= $route_kode;?>" />
        </div>
        <div class="col-6">
            <div class="form-check mt-3">
                <input class="form-check-input" type="radio" name="approval" id="approval_acc" value="acc" checked>
                <label class="form-check-label" for="approval_acc">
                    ACC
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="approval" id="approval_tolak" value="tolak">
                <label class="form-check-label" for="approval_tolak">
                    Tolak <span class="font-italic text-danger">(perlu follow up)</span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="approval" id="approval_batal" value="batal">
                <label class="form-check-label" for="approval_batal">
                    Batal <span class="font-italic text-danger">(tidak perlu follow up)</span>
                </label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-3">Proses</button>
        </div>
    </div>
    </form>
</div>

<?= $this->endSection()?>