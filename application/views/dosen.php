<div class="content">
   <div class="header">
      <h1 class="page-title"><?php echo $page_title; ?></h1>
   </div>
   <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>">Dashboard</a> <span class="divider">/</span></li>
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
         <a href="<?php echo base_url() . 'web/dosen_add'; ?>"> <button class="btn btn-primary pull-right"><i class="mdi mdi-plus"></i> Tambah Baru</button></a>

         <form class="form-inline" method="POST" action="<?php echo base_url() . 'web/dosen_search' ?>">
            <div class="form-group col-lg-4 mt-4 d-flex">
               <input type="text" class="form-control" name="search_query" value="<?php echo isset($search_query) ? $search_query : ''; ?>" placeholder="Cari ...">
               <button type="submit" class="btn btn-primary mx-2">Cari</button>
               <a href="<?php echo base_url() . 'web/dosen'; ?>"><button type="button" class="btn btn-info text-white">Clear</button> </a>
            </div>
         </form>

         <?php if ($rs_dosen->num_rows() === 0) : ?>
            <div class=" alert alert-error">
               <button type="button" class="close" data-dismiss="alert">�</button>
               Tidak ada data.
            </div>
         <?php else : ?>
            <div id="content_ajax">

               <div class="pagination" id="ajax_paging" aria-label="Page navigation example">
                  <ul class=" pagination pagination-lg">
                     <?php echo $this->pagination->create_links(); ?>
                  </ul>
               </div>

               <div class="widget-content">
                  <table class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>NIDN</th>
                           <th>Nama</th>
                           <th>Telp</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>

                        <?php
                        $i =  intval($start_number) + 1;
                        foreach ($rs_dosen->result() as $dosen) { ?>
                           <tr>
                              <td><?php echo str_pad((int)$i, 2, 0, STR_PAD_LEFT); ?></td>
                              <td><?php echo $dosen->nidn; ?></td>
                              <td><?php echo $dosen->nama; ?></td>
                              <td><?php echo $dosen->telp; ?></td>

                              <td>
                                 <a href="<?php echo base_url() . 'web/dosen_edit/' . $dosen->kode; ?>" class="btn btn-small btn-info text-white"><i class="mdi mdi-pencil"></i></a>
                                 <a href="<?php echo base_url() . 'web/dosen_delete/' . $dosen->kode; ?>" class="btn btn-small btn-danger text-white" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class=" mdi mdi-delete-forever"></i></a>
                              </td>
                           </tr>
                        <?php $i++;
                        } ?>

                     </tbody>
                  </table>
               </div>


               <div class="pagination" id="ajax_paging">
                  <ul>
                     <?php echo $this->pagination->create_links(); ?>
                  </ul>
               </div>
            </div>
         <?php endif; ?>
         <footer>
            <hr />

         </footer>
      </div>
   </div>
</div>
<script>
   $(".alert").alert('close')
</script>