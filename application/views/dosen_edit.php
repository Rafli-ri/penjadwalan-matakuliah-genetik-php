<?php foreach ($rs_dosen->result() as $dosen) {
} ?>

<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li><a href="<?php echo base_url(); ?>web/dosen">Modul Dosen</a> <span class="divider">/</span></li>
    <li class="active">Ubah Data</li>
  </ul>

  <div class="container-fluid">
    <div class="row-fluid">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <?php echo $msg; ?>
        </div>
      <?php } ?>



      <form class="form-horizontal mt-4" id="tab" method="POST">
        <div class="form-group">
          <label>NIDN</label>
          <input id="nidn" type="text" value="<?php echo $dosen->nidn; ?>" name="nidn" class="form-control" />
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input id="nama" type="text" value="<?php echo $dosen->nama; ?>" name="nama" class="form-control" />
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input id="alamat" type="text" value="<?php echo $dosen->alamat; ?>" name="alamat" class="form-control" />
        </div>
        <div class="form-group">
          <label>Telp</label>
          <input id="telp" type="text" value="<?php echo $dosen->telp; ?>" name="telp" class="form-control" />
        </div>


        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="<?php echo base_url() . 'web/dosen'; ?>"><button type="button" class="btn btn-danger text-white">Cancel</button></a>
        </div>
      </form>

      <footer>
        <hr />

      </footer>

    </div>
  </div>
</div>