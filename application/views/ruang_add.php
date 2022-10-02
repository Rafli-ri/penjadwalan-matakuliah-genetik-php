<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li><a href="<?php echo base_url(); ?>web/ruang">Data Ruangan</a> <span class="divider">/</span></li>
    <li class="active">Tambah Data Ruangan</li>
  </ul>

  <div class="container-fluid">
    <div class="row-fluid">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <?php echo $msg; ?>
        </div>
      <?php } ?>



      <form class="form-horizontal mt-4 col-lg-5" id="tab" method="POST">
        <div class="form-group">
          <label>Nama</label>
          <input id="nama" type="text" value="<?php echo set_value('nama'); ?>" name="nama" class="form-control" />
        </div>
        <div class="form-group">
          <label>Kapasitas</label>
          <input id="kapasitas" type="text" value="<?php echo set_value('kapasitas'); ?>" name="kapasitas" class="form-control" />
        </div>
        <div class="form-group">
          <label>Category</label>
          <select name="jenis" class="form-select shadow-none col-12">
            <option selected hidden>Pilih Kategori Kuliah....</option>
            <option value="TEORI" <?php echo set_select('jenis', 'TEORI'); ?> /> TEORI
            <option value="LABORATORIUM" <?php echo set_select('jenis', 'LABORATORIUM'); ?> /> LABORATORIUM
          </select>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="<?php echo base_url() . 'web/ruang'; ?>"><button type="button" class="btn btn-danger text-white">Cancel</button></a>
        </div>
      </form>

      <footer>
        <hr />
      </footer>

    </div>
  </div>
</div>