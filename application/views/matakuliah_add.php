<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li><a href="<?php echo base_url(); ?>web/matakuliah">Modul Matakuliah</a> <span class="divider">/</span></li>
    <li class="active">Tambah Data</li>
  </ul>

  <div class="container-fluid">
    <div class="row-fluid">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">�</button>
          <?php echo $msg; ?>
        </div>
      <?php } ?>



      <form class="form-horizontal mt-4 col-lg-5" id="tab" method="POST">
        <div class="form-group">
          <label>Kode Matakuliah</label>
          <input id="kode_mk" type="text" class="form-control" value="<?php echo set_value('kode_mk'); ?>" name="kode_mk" />
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input id="nama" type="text" class="form-control" value="<?php echo set_value('nama'); ?>" name="nama" />
        </div>
        <div class="form-group">
          <label>Kategori Kuliah</label>
          <select name="jenis" class="form-select shadow-none col-12">
            <option selected hidden>Pilih Kategori kuliah...</option>
            <option value="TEORI" <?php echo set_select('jenis', 'TEORI'); ?> /> TEORI
            <option value="PRAKTIKUM" <?php echo set_select('jenis', 'PRAKTIKUM'); ?> /> PRAKTIKUM
          </select>
        </div>
        <div class="form-group">
          <label>SKS</label>
          <input id="sks" type="text" value="<?php echo set_value('sks'); ?>" name="sks" class="form-control" />
        </div>
        <div class="form-group">
          <label>Semester</label>
          <input id="semester" type="text" value="<?php echo set_value('semester'); ?>" name="semester" class="form-control" />
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="<?php echo base_url() . 'web/matakuliah'; ?>"><button type="button" class="btn btn-danger text-white">Cancel</button></a>
        </div>
      </form>

      <footer>
        <hr />
      </footer>

    </div>
  </div>
</div>