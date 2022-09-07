<?= $this->extend('theme')?>

<?= $this->section('title')?>

<?= $this->endSection();?>

<?= $this->section('content')?>


<table width=100%>
<form id="pilihtgl" action="<?php echo base_url('/queue/jadwalHarian'); ?>" method="post" enctype="multipart/form-data">
    <tr>
        <td width="50%" class="subtitle">Jadwal Pemakaian Ruang 
        <?php
        if($tgl <> date('m-d-Y')) {
			echo " Tanggal "; echo date("d-m-Y", strtotime($tgl));
		} else {
			echo " Hari Ini";
		} ?>
        </td>  
        <td width="40%"></td> 
        <td ><input type="date" name="tgl" id="tgl" class="form-control" value="<?php echo $tgl; ?>" onchange="pilihtgl.submit()"> </td> 
    </tr>
</form>    
</table> 

<br><br>
<table  class="table table-bordered ">
    <thead>
        <tr>
        <td scope="col" >No</td>
            <td scope="col" >Ruang</td>
            <td scope="col" >07 30</td>
            <td scope="col" >08 00</td>
            <td scope="col" >08 30</td>
            <td scope="col" >09 00</td>
            <td scope="col" >09 30</td>
            <td scope="col" >10 00</td>
            <td scope="col" >10 30</td>
            <td scope="col" >11 00</td>
            <td scope="col" >11 30</td>
            <td scope="col" >12 00</td>
            <td scope="col" >12 30</td>
            <td scope="col" >13 00</td>
            <td scope="col" >13 30</td>
            <td scope="col" >14 00</td>
            <td scope="col" >14 30</td>
            <td scope="col" >15 00</td>
            <td scope="col" >15 30</td>
            <td scope="col" >16 00</td>
            <td scope="col" >16 30</td>
            <td scope="col" >17 00</td>
            <td scope="col" >17 30</td>
            <td scope="col" >18 00</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pinjam as $key => $value) : ?>
        <tr>
            <td scope="row"><?php echo $key+1; ?></td>
            <th><?php echo $value['Ruang'] //data-toggle="tooltip" data-placement="top" title="Tooltip on top" ?></th>
            <td <?php if ($value['J0730']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J0730'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J0800']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J0800'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J0830']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J0830'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J0900']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J0900'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J0930']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J0930'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1000']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1000'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1030']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1030'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1100']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1100'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1130']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1130'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1200']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1200'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1230']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1230'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1300']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1300'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1330']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1330'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1400']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1400'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1430']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1430'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1500']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1500'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1530']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1530'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1600']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1600'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1630']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1630'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1700']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1700'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1730']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1730'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
            <td <?php if ($value['J1800']<>'') { echo "bgcolor=#9E8559 data-toggle=tooltip data-placement=top title='" . $value['J1800'] . "'" ; } else { echo "bgcolor=#E8E8E8" ; } ?>></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection()?>