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
                    PALMERAH
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
                    10783
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
                    2019-01-09 00:00:00.000
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
                    020
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
                    PAL Pre Press (62001)
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
                    PAL Pre Press (62001)
                </div>
            </div>
            <div class="item-mark">
                <div class="caption">
                    Description
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn"></div>
            </div>
            <div class="item-mark">
                <div class="caption">
                    Route Otorisasi
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn">
                    Manager Peminta > GM Peminta > Manager Logistic > GM GA > Manager AB > GM AB > Director > PPSU  
                </div>
            </div>
            <div class="item-mark mb-0">
                <div class="caption">
                    Attachment
                </div>
                <div class="colon">
                    :
                </div>
                <div class="ctn"></div>
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
            <tr>
                <td data-label="No Item">ZA201595</td>
                <td data-label="Nama Barang">GEMBOK ATS 30mm</td>
                <td data-label="Sat">620-01-44110</td>
                <td data-label="Qty">BH</td>
                <td data-label="Qty">1</td>
                <td data-label="Target">2019-01-09 00:00:00.000</td>
            </tr>
    </tbody>
</table>

<div class="stat-detail-section-box">
<h3 class="title">Catatan-catatan</h3>
    <!-- <div class="no-notes">
        Tidak ada catatan.
    </div> -->
            <div class="note-item">
                <div class="position">Manager Peminta</div>
                <div class="detail-notes">
                    Ini note dari manager peminta
                </div>
            </div>
            <div class="note-item mb-0">
                <div class="position">Logistic</div>
                <div class="detail-notes">
                    Ini note dari logistic
                </div>
            </div>
</div>

<div class="stat-detail-section-box">
<h3 class="title">Otorisasi</h3>
<div class="authorization">
        <div class="auth-item">
            <div class="position">Logistic</div>
            <div class="date">2019-01-09 15:13:57.000</div>
            <div class="signature">
                <div class="icon">
                    <i class="fas fa-ban"></i>
                </div>
            </div>
            <div class="name">PANCA</div>
        </div>
        <div class="auth-item">
            <div class="position">Manager peminta</div>
            <div class="date">2019-01-09 15:13:57.000</div>
            <div class="signature">
                <div class="icon">
                    <i class="fas fa-ban"></i>
                </div>
            </div>
            <div class="name">PANCA 2</div>
        </div>
    </div>
</div>

<div class="stat-detail-section-box">
    <h3 class="title">Catatan</h3>
    <?= form_open('status/accProcess');?>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <textarea placeholder="Beri catatan bila diperlukan..." name="acc_notes" id="acc_notes" class="form-control" rows="5"></textarea>
            <div id="display_count"></div>
            <input type="hidden" name="reqno" value="" />
            <input type="hidden" name="compid" value="" />
            <input type="hidden" name="spmbno" value="" />
            <input type="hidden" name="kode_route" value="" />
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