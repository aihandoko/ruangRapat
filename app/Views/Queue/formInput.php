<?= $this->extend('theme')?>

<?= $this->section('title')?>

<?= $this->endSection();?>

<?= $this->section('content')?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <br><div class="alert alert-danger" role="alert">
    <?php echo session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?>    
 
<div class="subtitle"> Form Peminjaman Ruang </div>

<table class="table ">
<form action="<?php echo base_url('/pinjam/add');  ?>" method="post" enctype="multipart/form-data">
    <tr> 
      <td valign="top"> 
        <table width ="80%">
          <tr valign="middle"> 
            <td height="28" valign="middle"> Ruang</td>
            <td valign="middle" colspan="2">
              <select name="ruang" id="ruang" class="form-control">
                <?php
                  echo "<option value=''>Silakan Pilih</option>";
                  $file = fopen("ruang.txt", "r");
                  while(! feof($file)) {
                    $line = fgets($file);
                    if(old('ruang') == $line) { 
                        echo "<option value='".$line."' selected>$line</option>"; 
                    }
                    else{  
                        echo "<option value='".$line."'>$line</option>";
                    }
                  }
                  fclose($file);
                ?>
              </select>
            </td>
            <td height="28" valign="middle"> Tanggal</td>
            <td valign="middle">
            <input type="date" name="tgl" id="tgl" class="form-control" value="<?php echo old('tgl');?>" >
            </td> 
          </tr>
          <tr valign="middle"> 
            <td height="28" valign="middle"> Jam Mulai</td>
            <td valign="middle">
            <input type="time" name="mulai" id="mulai" class="form-control" value="<?php echo old('mulai');?>">
            </td>
            <td valign="middle" width="200"> </td>
            <td valign="middle"> Jam Selesai </td>
            <td valign="middle">
            <input type="time" name="selesai" id="selesai" class="form-control" value="<?php echo old('selesai');?>">
            </td>
          </tr>
          <tr valign="middle"> 
            <td valign="middle"> Unit </td>
            <td valign="middle" colspan="2">
            <select name="bag" id="bag" class="form-control">
                <?php
                  echo "<option value=''>Silakan Pilih</option>";
                  $file = fopen("bagian.txt", "r");
                  while(! feof($file)) {
                    $line = fgets($file);
                    if(old('bag') == $line) { 
                        echo "<option value='".$line."' selected>$line</option>"; 
                    }
                    else{  
                        echo "<option value='".$line."'>$line</option>";
                    }
                  }
                  fclose($file);
                ?>
              </select>
            </td>
            <td valign="middle"> Jumlah Peserta </td>
            <td valign="middle">
            <input type="number" name="peserta" id="peserta" class="form-control"  value="<?php echo old('peserta');?>"></td>
          </tr>
          <tr valign="middle"> 
            <td height="28" valign="middle">Acara</td>
            <td valign="middle">
              <select name="inex" id="inex" class="form-control">  
                <option value='I' selected>Internal</option>
                <option value='E'>Eksternal</option>
              </select>
            </td>
            <td valign="middle" colspan="3">
            <input type="text" name="acara" id="acara" class="form-control" value="<?php echo old('acara');?>">
            </td>
          </tr>
          <tr valign="middle"> 
            <td height="28" valign="middle">Perlengkapan</td>
            <td valign="middle" colspan="5">
              <input type="checkbox" name="lcd" id="lcd" value=1 <?php if(old('lcd') ==1 ) { echo "checked" ;} ?> >
              <label for="lcd">&nbsp;LCD &nbsp; &nbsp; &nbsp;</label>
              
              <input type="checkbox" name="mic" id="mic"  value=1 <?php if(old('mic') ==1 ) { echo "checked" ;} ?> >
              <label for="mic">&nbsp;Mic &nbsp; &nbsp; &nbsp;</label>
              
              <input type="checkbox" name="flip" id="flip" value=1 <?php if(old('flip') ==1 ) { echo "checked" ;} ?> >
              <label for="flip">&nbsp;Flipchart &nbsp; &nbsp; &nbsp;</label>
              
              <input type="checkbox" name="wboard" id="wboard" value=1 <?php if(old('wboard') ==1 ) { echo "checked" ;} ?> >
              <label for="wboard">&nbsp;Whiteboard &nbsp; &nbsp; &nbsp;</label>

              <input type="checkbox" name="ohp" id="ohp" value=1 <?php if(old('ohp') ==1 ) { echo "checked" ;} ?> >
              <label for="ohp">&nbsp;OHP &nbsp; &nbsp; &nbsp;</label>
            </td>
          </tr>
          <tr valign="middle"> 
            <td height="28" valign="middle">Konsumsi</td>
            <td  valign="middle" colspan="5">
              <input type="checkbox" name="air" id="air" value=1 <?php if(old('air') ==1 ) { echo "checked" ;} ?> >
              <label for="air">&nbsp;Air &nbsp; &nbsp; &nbsp;</label>
              
              <input type="checkbox" name="teh" id="teh" value=1 <?php if(old('teh') ==1 ) { echo "checked" ;} ?> >
              <label for="teh">&nbsp;Teh &nbsp; &nbsp; &nbsp;</label>

              <input type="checkbox" name="kopi" id="kopi" value=1 <?php if(old('kopi') ==1 ) { echo "checked" ;} ?> >
              <label for="kopi">&nbsp;Kopi &nbsp; &nbsp; &nbsp;</label>

              <input type="checkbox" name="gula" id="gula" value=1 <?php if(old('gula') ==1 ) { echo "checked" ;} ?> >
              <label for="gula">&nbsp;Gula &nbsp; &nbsp; &nbsp;</label>
              
              <input type="checkbox" name="creamer" id="creamer" value=1 <?php if(old('creamer') ==1 ) { echo "checked" ;} ?> >
              <label for="creamer">&nbsp;Creamer &nbsp; &nbsp; &nbsp;</label>
              
              <input type="checkbox" name="kue" id="kue" value=1 <?php if(old('kue') ==1 ) { echo "checked" ;} ?> >
              <label for="kue">&nbsp;Kue &nbsp; &nbsp; &nbsp;</label>
              
              <input type="checkbox" name="lunch" id="lunch" value=1 <?php if(old('lunch') ==1 ) { echo "checked" ;} ?> >
              <label for="lunch">&nbsp;Lunch &nbsp; &nbsp; &nbsp;</label>
            </td>
          </tr>
          </tr>
          <tr valign="middle"> 
            <td height="30" valign="middle">Keterangan</td>
            <td  valign="middle" colspan="5">
            <input type="text" name="ket" id="ket" class="form-control" value="<?php echo old('ket');?>">
            </td>
          </tr>
          <tr valign="middle"> 
            <td height="30" valign="middle">Susunan Meja</td>
            <td valign="middle" colspan="5">
                  <img src="<?= site_url("img/kursiaja.gif");?>" width="71" height="74"><input type="radio" name="meja" value="A" <?php if(old('meja') == "A") { echo "checked" ;} ?> >&nbsp; &nbsp; &nbsp;
                  <img src="<?= site_url("img/kursi-.gif");?>" width="71" height="74"><input type="radio" name="meja" value="B" <?php if(old('meja') == "B") { echo "checked" ;} ?> >&nbsp; &nbsp; &nbsp;
                  <img src="<?= site_url("img/kursi=.gif");?>" width="71" height="74"><input type="radio" name="meja" value="C" <?php if(old('meja') == "C") { echo "checked" ;} ?> >&nbsp; &nbsp; &nbsp;
                  <img src="<?= site_url("img/kursiO.gif");?>" width="71" height="74"><input type="radio" name="meja" value="D" <?php if(old('meja') == "D") { echo "checked" ;} ?> >&nbsp; &nbsp; &nbsp;
                  <img src="<?= site_url("img/kursiU.gif");?>" width="71" height="74"><input type="radio" name="meja" value="E" <?php if(old('meja') == "E") { echo "checked" ;} ?> >&nbsp; &nbsp; &nbsp;
            </td>
          </tr>
          <tr>
            <td></td>
            <td><button class="btn btn-primary">Simpan</button>&nbsp;&nbsp;
            <a onClick="history.go(-1);" class="btn btn-primary">&nbsp; Batal &nbsp;</a></td>
          </tr>
        </table></td>
    </tr>
  </form>
  </table>

  
<?= $this->endSection()?>