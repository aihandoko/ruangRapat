<?= $this->extend('theme')?>

<?= $this->section('content')?>

<?= $breadcrumbs?>

<div class="page-title-wrapper">
    <h3 class="page-title"><?= $page_title;?></h3>
</div>

<p>ID SPMB tidak ditemukan di database NLS.</p>

<p><a href="<?= site_url('status');?>" />Kembali</a></p>

<?= $this->endSection()?>