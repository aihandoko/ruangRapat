<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<?= $breadcrumbs?>
<div class="page-title-wrapper">
    <h3 class="page-title"><?= $page_title;?></h3>
</div>

<div class="subtitle">
	Daftar SPMB Untuk Diproses <?= session()->get('Fungsi');?>
</div>

<?php $arr_fungsi = ['PPSU', 'Perbekalan', 'CFM', 'admin'];?>

<table id="queueList" class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
			<th style="width: 25px;">No</th>
			<th>Site</th>
			<th>SPMB</th>
			<th>Unit Peminta</th>
			<th>Detail</th>
			<?= (in_array(session()->get('Fungsi'), $arr_fungsi) || substr(session()->get('Fungsi'), 0, 4) === 'Log ') ? '<th>&nbsp;</th>' : '';?>
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