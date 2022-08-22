<?= $this->extend('theme')?>

<?= $this->section('title')?>

<?= $this->endSection();?>

<?= $this->section('content')?>

<div class="subtitle">
	Jadwal Pemakaian Ruang
</div>

<table  class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
			<th scope="col" width=20>No</th>
            <th scope="col" width=80>Ruang</th>
            <th scope="col" width=110>Tanggal</th>
            <th scope="col" width=50>Mulai</th>
            <th scope="col" width=20>Durasi</th>
            <th scope="col" width=500>Acara</th>
            <th scope="col" width=300>Unit</th>
            <th scope="col" width=80></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pinjam as $key => $value) : ?>
        <tr>
            <th scope="row"><?php echo $key+1; ?></th>
            <td><?php echo $value['ruang'] ?></td>
            <td><?php echo date("d-m-Y", strtotime($value['tgl'])); ?></td>
            <td><?php echo $value['mulai'] ?></td>
            <td><?php echo round($value['no'], 2)   ?></td>
            <td><a href="<?php echo base_url('/queue/detil/'. $value['no']);?>"><?php echo $value['acara'] ?></a> </td>
            <td><?php echo $value['bag'] ?></td>
            <td><button type="button" class="btn btn-danger btn-sm">X</button></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection()?>