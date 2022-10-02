<div class="content">
   <div class="header">
      <h1 class="page-title"><?php echo $page_title; ?></h1>
   </div>
   <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
      <li class="active"><?php echo $page_title; ?></li>
   </ul>

   <div class="container-fluid">
      <?php if ($this->session->flashdata('msg')) { ?>
         <div class="alert alert-error alert-success alert-dismissible fade show">
            <?php echo $this->session->flashdata('msg'); ?>
            <button type="button" class="close" onclick="this.parentElement.style.display='none';" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
      <?php } ?>

      <div class="row-fluid">
         <a href="<?php echo base_url() . 'web/ruang_add'; ?>"> <button class="btn btn-primary pull-right"><i class="mdi mdi-plus"></i>Tambah Data</button></a>
         <!--
        <form class="form-inline" method="POST" action="<?php echo base_url() . 'web/ruang_search' ?>">
          <input type="text" placeholder="Nama" name="search_query" value="<?php echo isset($search_query) ? $search_query : ''; ?>">
          <button type="submit" class="btn">Cari</button>
          <a href="<?php echo base_url() . 'web/ruang'; ?>"><button type="button" class="btn">Clear</button> </a>
        </form>
		-->
         <br><br>
         <?php if ($rs_ruang->num_rows() === 0) : ?>
            <div class="alert alert-danger" role="alert">
               Tidak ada data, Silahkan inputkan data! <a class="alert-link" href="<?php echo base_url() . 'web/ruang_add'; ?> "> tambah data</a>
            </div>
         <?php else : ?>
            <div class="widget-content">
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kapasitas</th>
                        <th>Jenis</< /th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>

                     <?php
                     $i = 1;
                     foreach ($rs_ruang->result() as $ruang) { ?>
                        <tr>
                           <td><?php echo str_pad((int)$i, 2, 0, STR_PAD_LEFT); ?></td>
                           <td><?php echo $ruang->nama; ?></td>
                           <td><?php echo $ruang->kapasitas; ?></td>
                           <td><?php echo $ruang->jenis; ?></td>


                           <td>
                              <a href="<?php echo base_url() . 'web/ruang_edit/' . $ruang->kode; ?>" class="btn btn-primary text-white"><i class="mdi mdi-pencil"></i></a>
                              <a href="<?php echo base_url() . 'web/ruang_delete/' . $ruang->kode; ?>" class="btn btn-danger text-white" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="mdi mdi-delete-forever"></i></a>
                           </td>
                        </tr>
                     <?php $i++;
                     } ?>

                  </tbody>
               </table>
            </div>
         <?php endif; ?>
         <footer>
            <hr />
         </footer>
      </div>
   </div>
</div>