<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li><a href="<?php echo base_url(); ?>web/pengampu">Data Pengampu</a> <span class="divider">/</span></li>
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
          <label>Semester</label>
          <select id="semester_tipe" name="semester_tipe" class="form-select shadow-none col-12" onchange="get_matakuliah();">
            <option selected hidden>Pilih Jenis Semester....</option>
            <option value="1" <?php echo isset($semester_tipe) ? ($semester_tipe === '1' ? 'selected' : '') : ''; ?> /> GANJIL
            <option value="0" <?php echo isset($semester_tipe) ? ($semester_tipe === '0' ? 'selected' : '') : ''; ?> /> GENAP
          </select>
        </div>
        <div class="form-group">
          <label>Matakuliah</label>
          <select name="kode_mk" class="form-select shadow-none col-12" id="option_matakuliah">
            <?php foreach ($rs_mk->result() as $mk) { ?>
              <option selected hidden>Pilih Nama matakuliah....</option>
              <option value="<?php echo $mk->kode; ?>" <?php echo set_select('kode_mk', $mk->kode); ?> /> <?php echo $mk->nama; ?>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Dosen</label>
          <select name="kode_dosen" class="form-select shadow-none col-12">
            <?php foreach ($rs_dosen->result() as $dosen) { ?>
              <option selected hidden>Pilih Nama Dosen....</option>
              <option value="<?php echo $dosen->kode; ?>" <?php echo set_select('kode_dosen', $dosen->kode); ?> /> <?php echo $dosen->nama; ?>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Asisten Dosen</label>
          <select name="kode_asdos" class="form-select shadow-none col-12">
            <?php foreach ($rs_asdos->result() as $asdos) { ?>
              <option selected hidden>Pilih Nama Asisten Dosen....</option>
              <option value="<?php echo $asdos->kode; ?>" <?php echo set_select('kode_asdos', $asdos->kode); ?> /> <?php echo $asdos->nama_asdos; ?>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Kelas</label>
          <input id="kelas" type="text" value="<?php echo set_value('kelas'); ?>" name="kelas" class="form-control" />
        </div>
        <div class="form-group">
          <label>Tahun Akademik</label>
          <select id="tahun_akademik" name="tahun_akademik" class="form-select shadow-none col-12">
            <option selected hidden>pilih Tahun</option>
            <option value="2022-2023" <?php echo set_select('tahun_akademik', '2022-2023'); ?> /> 2022-2023
          </select>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="<?php echo base_url() . 'web/pengampu'; ?>"><button type="button" class="btn btn-danger text-white">Cancel</button></a>
        </div>
      </form>

      <footer>
        <hr />
      </footer>

    </div>
  </div>
</div>