<?= $this->extend('theme')?>

<?= $this->section('title')?>
<?= $page_title;?>
<?= $this->endSection();?>

<?= $this->section('content')?>

<?= $breadcrumbs?>
<div class="page-title-wrapper">
    <h3 class="page-title"><?= $page_title;?></h3>
</div>

<div class="row">
	<div class="col-lg-6 col-sm-12">
		<div class="dash__box">
			<div class="title">Profil user</div>
			<div class="ctn">
				<div class="row">
					<div class="col-4">
						Nama
					</div>
					<div class="col-8">
						<?= session()->get('Nama');?>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						NIK
					</div>
					<div class="col-8">
						<?= session()->get('NIK');?>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						Fungsi
					</div>
					<div class="col-8">
						<?= session()->get('Fungsi');?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-sm-12">
		<div class="dash__box">
			<div class="title">Status SPMB</div>
		</div>
	</div>
	<div class="col-lg-6 col-sm-12">
		<div class="dash__box">
			<div class="title">Antrian (untuk diproses)</div>
		</div>
	</div>
	<div class="col-lg-6 col-sm-12">
		<div class="dash__box">
			<div class="title">Antrian (yang ditolak)</div>
		</div>
	</div>
</div>


<?= $this->endSection()?>