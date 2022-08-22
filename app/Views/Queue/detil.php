<?= $this->extend('theme')?>

<?= $this->section('title')?>

<?= $this->endSection();?>

<?= $this->section('content')?>

<div class="subtitle"> Detil Pemakaian Ruang </div>

  <table class="table table-bordered table-striped" >
    <tr> 
      <td></td>
      <td colspan="3" valign="top"> 
        <table width="81%">
          <tr valign="middle"> 
            <td width="123" height="28" valign="middle"> Ruang</td>
            <td colspan="2" valign="middle">: <?= $pinjam[0]['ruang'];?></td>
            <td width="126" valign="middle"> Pengguna </td>
            <td width="415" valign="middle"> : <?= $pinjam[0]['bag'];?></td>
          </tr>
          <tr valign="middle"> 
            <td width="123" height="28" valign="middle"> Tanggal</td>
            <td colspan="2" valign="middle">: <?= date("d-m-Y", strtotime($pinjam[0]['tgl']));?></td> 
            <td width="126" valign="middle"> Peminjam </td>
            <td width="415" valign="middle"> : <?= $pinjam[0]['nama'];?></td>
          </tr>
          <tr valign="middle"> 
            <td width="123" height="28" valign="middle"> Jam / Durasi</td>
            <td colspan="2" valign="middle">: <?= $pinjam[0]['mulai'];?> / <?= round($pinjam[0]['durasi'],1);?> jam </td>
            <td width="126" valign="middle"> Jumlah Peserta </td>
            <td width="415" valign="middle"> : <?= $pinjam[0]['peserta'];?></td>
          </tr>
          <tr valign="middle"> 
            <td height="28" valign="middle">Acara</td>
            <td colspan="5" valign="middle">: <?= $pinjam[0]['acara'];?></td>
          </tr>
          <tr valign="middle"> 
            <td height="28" valign="middle">Perlengkapan</td>
            <td colspan="5" valign="middle">: 
            <?php if($pinjam[0]['ohp'] == 1) : ?> OHP ,   <?php endif; ?>
            <?php if($pinjam[0]['lcd'] == 1) : ?> LCD ,   <?php endif; ?>
            <?php if($pinjam[0]['wboard'] == 1) : ?> Flipchart ,   <?php endif; ?>
            <?php if($pinjam[0]['flip'] == 1) : ?> Whiteboard ,   <?php endif; ?>
            <?php if($pinjam[0]['flip'] == 1) : ?> Mic  <?php endif; ?>
            </td>
          </tr>
          <tr valign="middle"> 
            <td height="28" valign="middle">Konsumsi</td>
            <td colspan="5" valign="middle">: 
            <?php if($pinjam[0]['air'] == 1) : ?>Air , <?php endif; ?>
            <?php if($pinjam[0]['teh'] == 1) : ?>Teh , <?php endif; ?>
            <?php if($pinjam[0]['kopi'] == 1) : ?>Kopi , <?php endif; ?>
            <?php if($pinjam[0]['gula'] == 1) : ?>Gula , <?php endif; ?>
            <?php if($pinjam[0]['creamer'] == 1) : ?>Creamer, <?php endif; ?>    
            <?php if($pinjam[0]['kue'] == 1) : ?>Kue, <?php endif; ?> 
            <?php if($pinjam[0]['lunch'] == 1) : ?>Lunch<?php endif; ?> 
            </td>
          </tr>
          </tr>
          <tr valign="middle"> 
            <td height="30" valign="middle">Keterangan</td>
            <td colspan="5" valign="middle">: <?= $pinjam[0]['ket'];?></td>
          </tr>
          <tr valign="middle"> 
            <td height="30" valign="middle">Susunan Meja</td>
            <td colspan="5" valign="middle">: 
                <?php if($pinjam[0]['meja'] == 'A') : ?><img src="<?= site_url("img/kursiaja.gif");?>" width="71" height="74"><?php endif; ?>    
                <?php if($pinjam[0]['meja'] == 'B') : ?><img src="<?= site_url("img/kursi-.gif");?>" width="71" height="74"><?php endif; ?>    
                <?php if($pinjam[0]['meja'] == 'C') : ?><img src="<?= site_url("img/kursi=.gif");?>" width="71" height="74"><?php endif; ?>    
                <?php if($pinjam[0]['meja'] == 'D') : ?><img src="<?= site_url("img/kursiO.gif");?>" width="71" height="74"><?php endif; ?>    
                <?php if($pinjam[0]['meja'] == 'E') : ?><img src="<?= site_url("img/kursiU.gif");?>" width="71" height="74"><?php endif; ?>    
            </td>
          </tr>
        </table></td>
    </tr>
    <tr valign="middle"> 
        <td height="30" valign="middle"><a href="<?php echo base_url('/Queue/index');?>" class="btn btn-primary">Kembali</a></td>
    </tr>
  </table>

<?= $this->endSection()?>