<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<?= $breadcrumbs?>

<div class="page-title-wrapper">
    <h3 class="page-title"><?= $page_title;?></h3>
</div>

<div class="detail-marks-box mb-4 p-4">
    <div class="row">
        <div class="col-lg-5 col-md-12">
            <div class="item-mark">
                <div class="caption">
                    Site
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn font-weight-bold">
                    <?= $routes[0]->Site;?>
                </div>
            </div>
            <div class="item-mark">
                <div class="caption">
                    Request No
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn">
                    <?= $data[0]['ReqNo'];?>
                </div>
            </div>
            <div class="item-mark">
                <div class="caption">
                    Request Date
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn">
                    <?= $data[0]['ReqDate'];?>
                </div>
            </div>
            <div class="item-mark">
                <div class="caption">
                    Comp Id
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn">
                    <?= $data[0]['CompId'];?>
                </div>
            </div>
            <div class="item-mark cost-ctr">
                <div class="caption">
                    Cost Ctr
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn">
                    <?= $DeptName;?> (<?= $routes[0]->DeptId;?>)
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-12">
            <div class="item-mark">
                <div class="caption">
                    Req Dept
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn">
                    <?= $DeptName;?> (<?= $routes[0]->DeptId;?>)
                </div>
            </div>
            <div class="item-mark">
                <div class="caption">
                    Description
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn">
                    <?= $data[0]['ReqDescription'];?>
                </div>
            </div>
            <div class="item-mark">
                <div class="caption">
                    Route Otorisasi
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn">
                    <?= $route_otorisasi;?>
                </div>
            </div>
            <div class="item-mark mb-0">
                <div class="caption">
                    Attachment
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn">
                    &nbsp;
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
                <td data-label="No Item"><?= $val['ItemId'];?></td>
                <td data-label="Nama Barang"><?= $val['ItemName'];?></td>
                <td data-label="No Account"><?= $val['AccountNo'];?></td>
                <td data-label="Sat"><?= $val['UnitCode'];?></td>
                <td data-label="Qty"><?= $val['ItemQty'];?></td>
                <td data-label="Target"><?= $val['TargetDate'];?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<div class="stat-detail-section-box">
    <h3 class="title">Catatan-catatan</h3>
    <?php if(count($notes) > 0) :
        foreach($notes as $key => $note) :
            $mb = ($key == count($notes) - 1) ? ' mb-0' : '';
            if($note->Catatan != null || $note->Catatan != '') : ?>
            <div class="note-item<?= $mb;?>">
                <div class="position"><?= $note->Posisi;?></div>
                <div class="detail-notes">
                    <?= $note->Catatan;?>
                </div>
            </div>
            <?php endif;
        endforeach;
    else : ?>
        <div class="no-notes">
            Tidak ada catatan.
        </div>
    <?php endif;?>
</div>

<div class="stat-detail-section-box">
    <h3 class="title">Otorisasi</h3>
    <div class="authorization">
    <?php
    if($signature_name !== '') {
        if($signatures[0]->Tolak == 0 && $signatures[0]->Batal == 0) {
            $signature = $signatures[0]->Acc;
        } else {
            if($signatures[0]->Tolak == 1) {
                $signature = 'tolak';
            } else {
                $signature = 'batal';
            }
        }
        ?>
        <div class="auth-item">
            <div class="position"><?= $signatures[0]->Posisi;?></div>
            <div class="date"><?= $TglAcc;?></div>
            <div class="signature">
                <?php
                $paraf = "http://10.14.80.203/paraf/" . $signature . ".gif";
                if(stripos(get_headers($paraf)[0],"200 OK")) : ?>
                    <img src="<?= $paraf;?>" />
                <?php else : ?>
                    <div class="icon">
                        <i class="fas fa-ban"></i>
                    </div>
                <?php endif;?>
            </div>
            <div class="name"><?= $signature_name;?></div>
        </div>
    <?php
} ?>
    </div>
</div>

<div class="stat-detail-section-box mb-0">
    <h3 class="title text-danger">Follow Up Terhadap SPMB Yang Ditolak</h3>
    <?= form_open('queue/denyProcess');?>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <textarea maxlength="255" placeholder="Beri catatan bila diperlukan..." name="acc_notes" id="acc_notes" class="form-control" rows="5"></textarea>
            <div class="text-danger"><span id="current">255</span> karakter lagi</div>
            <input type="hidden" name="reqno" value="<?= $data[0]['ReqNo'];?>" />
            <input type="hidden" name="compid" value="<?= $data[0]['CompId'];?>" />
            <input type="hidden" name="spmbno" value="<?= $SPMBNo;?>" />
            <input type="hidden" name="kode_route" value="<?= $route_kode;?>" />
            <input type="hidden" name="site" value="<?= $routes[0]->Site;?>" />
        </div>
        <div class="col-lg-6 col-md-12">
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