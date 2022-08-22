<?= $this->extend('theme')?>

<?= $this->section('title')?>

<?= $this->endSection();?>

<?= $this->section('content')?>

<div class="subtitle">
	Form Peminjaman Ruang
</div>

<div class="container">
    <div class="row">
        <div class="col">

          <?php //echo $validation->listErrors(); ?>

         <form action="<?php echo base_url('/queue/add');  ?>" method="post" enctype="multipart/form-data">
          <?php csrf_field(); ?>    
           <div class=mb-3>
                <label class="form-label">Nama Penerbit</label>
                <input type="text" name="penerbit" class="form-control">
                <div class="invalid-feedback">
                    <?php //echo $validation->getError('nama'); ?>
                </div>
           <div class=mb-3>
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" >
           </div>
           <div class=mb-3>
                <label class="form-label">Telpon</label>
                <input type="text" name="telpon" id="telpon" class="form-control" >
          </div>
           <div class=mb-3>
                <button class="btn btn-primary">Simpan</button>
            
           </div>
          </form>
        </div>
    </div>
</div>

<?php echo $this->endSection();   ?>