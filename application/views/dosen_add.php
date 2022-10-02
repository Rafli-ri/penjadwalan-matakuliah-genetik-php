<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li><a href="<?php echo base_url(); ?>web/dosen">Data Dosen</a> <span class="divider">/</span></li>
    <li class="active">Tambah Data</li>
  </ul>

  <div class="container-fluid">
    <div class="row-fluid">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?php echo $msg; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } ?>

      <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <form class="form-horizontal mt-4" id="tab" method="POST">

        <div class="form-group">
          <label>NIDN</label>
          <input id="nidn" type="text" value="<?php echo set_value('nidn'); ?>" name="nidn" class="form-control" />
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input id="nama" type="text" value="<?php echo set_value('nama'); ?>" name="nama" class="form-control" />
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input id="alamat" type="text" value="<?php echo set_value('alamat'); ?>" name="alamat" class="form-control" />
        </div>
        <div class="form-group">
          <label>Telp</label>
          <input id="telp" type="text" value="<?php echo set_value('telp'); ?>" name="telp" class="form-control" />
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="<?php echo base_url() . 'web/dosen'; ?>"><button type="button" class="btn btn-danger text-white">Cancel</button></a>
        </div>
      </form>

      <footer>
        <hr />
        <!-- <p class="pull-right">Design by <a href="http://www.portnine.com" target="_blank">Penjadwalan</a></p>
        <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p> -->
      </footer>

    </div>
  </div>
</div>