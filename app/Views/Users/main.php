<?= $this->extend('theme')?>

<?= $this->section('content')?>

<h1 class="page-title">Users</h1>

<table id="usersList" class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
            <th width="40">#</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Fungsi</th>
            <th>Site</th>
            <th>Kode SPMB</th>
            <th>CompId</th>
            <th>DeptId</th>
        </tr>
    </thead>
</table>

<?= $this->endSection()?>