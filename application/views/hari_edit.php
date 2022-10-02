<?php foreach ($rs_hari->result() as $hari) {
} ?>
<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li><a href="<?php echo base_url(); ?>web/hari">Data Hari</a> <span class="divider">/</span></li>
    <li class="active">Edit Data Hari</li>
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
          <label>Nama Hari</label>
          <input id="nama" type="text" value="<?php echo $hari->nama; ?>" name="nama" class="form-control" />
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="<?php echo base_url() . 'web/hari'; ?>"><button type="button" class="btn btn-danger text-white">Cancel</button></a>
        </div>
      </form>

      <footer>
        <hr />
      </footer>
    </div>
  </div>
</div>