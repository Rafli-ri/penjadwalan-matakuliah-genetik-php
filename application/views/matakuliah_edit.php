<?php foreach ($rs_mk->result() as $mk) {
} ?>
<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li><a href="<?php echo base_url(); ?>web/matakuliah">Modul Matakuliah</a> <span class="divider">/</span></li>
    <li class="active">Ubah Data</li>
  </ul>

  <div class="container-fluid">
    <div class="row-fluid">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">�</button>
          <?php echo $msg; ?>
        </div>
      <?php } ?>



      <form class="form-horizontal form-material mx-2" id="tab" method="POST">
        <div class="form-group">
          <label class="col-md-12">Kode Matakuliah</label>
          <input id="kode_mk" class="form-control form-control-line" type="text" value="<?php echo $mk->kode_mk; ?>" name="kode_mk" class="input-xlarge" />
        </div>
        <div class="form-group">
          <label class="col-md-12">Nama</label>
          <input id="nama" class="form-control form-control-line" type="text" value="<?php echo $mk->nama; ?>" name="nama" class="input-xlarge" />
        </div>
        <div class="form-group">
          <label class="col-sm-12">Category</label>
          <select name="jenis" class="form-select shadow-none form-control-line">
            <!-- <option selected hidden>Pilih Kategori kuliah...</option> -->
            <option value="TEORI" <?php echo $mk->jenis === 'TEORI' ? 'selected' : ''; ?> /> TEORI
            <option value="PRAKTIKUM" <?php echo $mk->jenis === 'PRAKTIKUM' ? 'selected' : ''; ?> /> PRAKTIKUM
          </select>
        </div>
        <div class="form-group">
          <label class="col-sm-12">SKS</label>
          <input id="sks" class="form-control form-control-line" type="text" value="<?php echo $mk->sks; ?>" name="sks" class="input-xsmall" />
        </div>
        <div class="form-group">
          <label class="col-sm-12">Semester</label>
          <input id="semester" class="form-control form-control-line" type="text" value="<?php echo $mk->semester; ?>" name="semester" class="input-xsmall" />
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