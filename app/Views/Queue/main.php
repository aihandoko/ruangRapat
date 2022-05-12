<?= $this->extend('theme')?>

<?= $this->section('content')?>

<h1 class="page-title">Antrian</h1>

<div class="subtitle">
	Daftar SPMB Untuk Diproses <?= session()->get('Fungsi');?>
</div>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Site</th>
			<th>SPMB</th>
			<th>Unit Peminta</th>
			<th>Detail</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($data) > 0) :
			$arr_fungsi = ['PPSU', 'Perbekalan', 'CFM'];
			foreach ($data as $key => $value) :
				$show_link = (in_array(session()->get('Fungsi'), $arr_fungsi) || substr(session()->get('Fungsi'), 0, 4) === 'Log ') ? 'detail' : 'acc';
				?>
				<tr>
					<td><?= $key + 1;?></td>
					<td><?= $value['Site'];?></td>
					<td><?= $value['SPMBNo'];?></td>
					<td><?= $value['Unit'];?></td>
					<td><a href="<?= site_url('status/'.$show_link.'/'.$value['SPMBNo']);?>">Tampilkan</td>
				</tr>
			<?php endforeach;?>
		<?php else : ?>
		<tr>
			<td colspan="5">Data tidak tersedia.</td>
		</tr>
		<?php endif;?>
	</tbody>
</table>

<div class="subtitle">
	Daftar SPMB Yang Ditolak
</div>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Site</th>
			<th>SPMB</th>
			<th>Unit Peminta</th>
			<th>Detail</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($deny) > 0) :
			foreach ($deny as $k => $v) : ?>
				<tr>
					<td><?= $k + 1;?></td>
					<td><?= $v['Site'];?></td>
					<td><?= $v['SPMBNo'];?></td>
					<td><?= $v['Unit'];?></td>
					<td><a href="<?= site_url('status/acc/'.$v['SPMBNo']);?>">Tampilkan</a></td>
				</tr>
			<?php endforeach;?>
		<?php else : ?>
		<tr>
			<td colspan="5">Data tidak tersedia.</td>
		</tr>
		<?php endif;?>
	</tbody>
</table>

<?= $this->endSection()?>