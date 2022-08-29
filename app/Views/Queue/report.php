<?= $this->extend('theme')?>

<?= $this->section('title')?>

<?= $this->endSection();?>

<?= $this->section('content')?>


<table width=100%>
<form action="<?php echo base_url('/queue/laporan'); ?>" method="post" enctype="multipart/form-data">
    <tr>
        <td width="50%" class="subtitle">Laporan Peminjaman Ruang</td>  
        <td >Periode</td> 
        <td ><input type="date" name="dari" id="dari" class="form-control" value="<?php if (isset($tgl1)) { echo $tgl1 ; } ?>" > </td> 
        <td >sd</td> 
        <td ><input type="date" name="sd" id="sd" class="form-control" value="<?php if (isset($tgl2)) { echo $tgl2 ; } ?>" > </td> 
        <td><button class="btn btn-primary">OK</button></td> 
    </tr>
</form>    
</table> 

<br><br>
<table  class="table table-bordered table-striped">
    <thead>
        <tr>
			<th scope="col" >No</th>
            <th scope="col" >Ruang</th>
            <th scope="col" >Tanggal</th>
            <th scope="col" >Mulai</th>
            <th scope="col" >Durasi</th>
            <th scope="col" >Acara</th>
            <th scope="col" >Unit</th>
            <th scope="col" >Peminjam</th>
            <th scope="col" >Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pinjam as $key => $value) : ?>
        <tr>
            <th scope="row"><?php echo $key+1; ?></th>
            <td><?php echo $value['ruang'] ?></td>
            <td><?php echo date("d-m-Y", strtotime($value['tgl'])); ?></td>
            <td><?php echo $value['mulai'] ?></td>
            <td><?php echo round($value['durasi'], 2)?></td>
            <td><?php echo $value['acara'] ?></td>
            <td><?php echo $value['bag'] ?></td>
            <td><?php echo $value['nama'] ?></td>
            <td><?php echo $value['ket'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection()?>