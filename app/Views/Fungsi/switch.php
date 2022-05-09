<?= $this->extend('theme')?>

<?= $this->section('content')?>

<h1 class="page-title">Switch fungsi</h1>

<?php if(session()->has('success')) : ?>
<div class="alert alert-success"><?= session()->get('success');?></div>
<?php endif;?>

<?php if(session()->has('error')) : ?>
<div class="alert alert-danger"><?= session()->get('error');?></div>
<?php endif;?>

<div class="row">
	<div class="col-4">
		<div class="boxed-el">
			<?= form_open('fungsi/process');?>
			<div class="caption font-weight-bold mb-2">
				Fungsi
			</div>
			<select class="form-control mb-2" name="fungsi">
				<?php foreach ($functions as $key => $value) :
					$selected = ($key == session()->get('selected_key')) ? ' selected' : '';
					?>
					<option<?= $selected;?> value="<?= $key;?>"><?= $value['Site'] . ' - ' . $value['Fungsi'];?></option>
				<?php endforeach;?>
			</select>
			<button type="submit" class="btn btn-primary" name="submit">
				Switch
			</button>
			</form>
		</div>
	</div>
</div>

<?= $this->endSection()?>