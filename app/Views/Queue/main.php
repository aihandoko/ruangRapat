<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<h1 class="page-title"><?= $page_title;?></h1>

<div class="subtitle">
	Daftar SPMB Untuk Diproses <?= session()->get('Fungsi');?>
</div>

<table id="queueList" class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
			<th>No</th>
			<th>Site</th>
			<th>SPMB</th>
			<th>Unit Peminta</th>
			<th>Detail</th>
        </tr>
    </thead>
</table>

<div class="subtitle mt-5">
	Daftar SPMB Yang Ditolak
</div>

<table id="queueDenyList" class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
			<th>No</th>
			<th>Site</th>
			<th>SPMB</th>
			<th>Unit Peminta</th>
			<th>Detail</th>
        </tr>
    </thead>
</table>

<?= $this->endSection()?>