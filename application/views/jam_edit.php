<?php foreach ($rs_jam->result() as $jam) {
} ?>
<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li><a href="<?php echo base_url(); ?>web/jam">Data Jam</a> <span class="divider">/</span></li>
    <li class="active">Form Edit Data</li>
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
          <label>Range Jam</label>
          <input id="range_jam" type="text" value="<?php echo $jam->range_jam; ?>" name="range_jam" class="form-control" />
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="<?php echo base_url() . 'web/jam'; ?>"><button type="button" class="btn btn-danger text-white">Cancel</button></a>
        </div>
      </form>

      <footer>
        <hr />
      </footer>
    </div>
  </div>
</div>