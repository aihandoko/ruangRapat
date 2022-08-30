<?= $this->extend('theme')?>

<?= $this->section('title')?>

<?= $this->endSection();?>

<?= $this->section('content')?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <br><div class="alert alert-success" role="alert">
    <?php echo session()->getFlashdata('pesan'); ?>
    </div><br>
<?php endif; ?>    

<div class="subtitle">
	Antrian Peminjaman Ruang
</div>

<table  class="table table-bordered table-striped">
    <thead>
        <tr>
			<th scope="col" width=20>No</th>
            <th scope="col" width=80>Ruang</th>
            <th scope="col" width=105>Tanggal</th>
            <th scope="col" width=110>Jam</th>
            <th scope="col" width=500>Acara</th>
            <th scope="col" width=300>Unit</th>
            <?php if(session()->get('NIK') == '96462' || session()->get('NIK') == '04040') : ?>
            <th colspan="2" scope="col">ACC</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pinjam as $key => $value) : ?>
        <tr>
            <th scope="row"><?php echo $key+1; ?></th>
            <td><?php echo $value['ruang'] ?></td>
            <td><?php echo date("d-m-Y", strtotime($value['tgl'])); ?></td>
            <td><?php echo $value['mulai']; echo("-"); echo $value['selesai'];?></td>
            <td><a href="<?php echo base_url('/queue/detil/'. $value['no']);?>"><?php echo $value['acara'] ?></a> </td>
            <td><?php echo $value['bag'] ?></td>
            <?php if(session()->get('NIK') == '96462' || session()->get('NIK') == '04040') : ?>
             <td>
                <form action="<?php echo base_url('/queue/acc');?>" method="post" >
                <input type="hidden" name="no" value="<?php echo $value['no'] ?>">
                <button type="submit" onclick="return confirm('Menyetujui Peminjaman Ruang?')" class="btn btn-success btn-sm">Y</a>
                </form>
             </td>
             <td>
                <form action="<?php echo base_url('/queue/tolak');?>" method="post" >
                <input type="hidden" name="no" value="<?php echo $value['no'] ?>">
                <button type="submit" onclick="return confirm('Peminjaman Ruang Ditolak?')" class="btn btn-danger btn-sm">T</a>
                </form>
             </td>
            <?php endif ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection()?>