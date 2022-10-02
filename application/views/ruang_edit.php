<?php foreach ($rs_ruang->result() as $ruang) {
} ?>
<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li><a href="<?php echo base_url(); ?>web/ruang">Data Ruangan</a> <span class="divider">/</span></li>
    <li class="active">Ubah Data Ruangan</li>
  </ul>

  <div class="container-fluid">
    <div class="row-fluid">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-error alert-success alert-dismissible fade show">
          <?php echo $this->session->flashdata('msg'); ?>
          <button type="button" class="close" onclick="this.parentElement.style.display='none';" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } ?>



      <form class="form-horizontal mt-4 col-lg-5" id="tab" method="POST">
        <div class="form-group">
          <label>Nama</label>
          <input id="nama" type="text" value="<?php echo $ruang->nama; ?>" name="nama" class="form-control" />
        </div>
        <div class="form-group">
          <label>Kapasitas</label>
          <input id="kapasitas" type="text" value="<?php echo $ruang->kapasitas; ?>" name="kapasitas" class="form-control" />
        </div>
        <div class="form-group">
          <label>Kategori Kuliah</label>
          <select name="jenis" class="form-control">
            <option selected hidden>Pilih Kategori Kuliah....</option>
            <option value="TEORI" <?php echo $ruang->jenis === 'TEORI' ? 'selected' : ''; ?> /> TEORI
            <option value="LABORATORIUM" <?php echo $ruang->jenis === 'LABORATORIUM' ? 'selected' : ''; ?> /> LABORATORIUM
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