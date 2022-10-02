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
         <a href="<?php echo base_url() . 'web/matakuliah_add'; ?>"> <button class="btn btn-primary pull-right"><i class="mdi mdi-plus"></i>Tambah Data</button></a>

         <form class="form-inline" method="POST" action="<?php echo base_url() . 'web/matakuliah_search' ?>">
            <div class="form-group col-lg-4  d-flex">
               <input type="text" class="form-control" placeholder="Cari..." name="search_query" value="<?php echo isset($search_query) ? $search_query : ''; ?>">
               <button type="submit" class="btn btn-primary text-white mx-2">Cari</button>
               <a href="<?php echo base_url() . 'web/matakuliah'; ?>"><button type="button" class="btn btn-outline-danger">Clear</button> </a>
            </div>
         </form>

         <?php if ($rs_mk->num_rows() === 0) : ?>
            <div class="alert alert-warning" role="alert">
               Tidak ada data.
            </div>
         <?php else : ?>
            <div id="content_ajax">
               <div class="pagination" id="ajax_paging">
                  <ul>
                     <?php echo $this->pagination->create_links(); ?>
                  </ul>
               </div>

               <div class="widget-content">

                  <table class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Kode MK</th>
                           <th>Nama</th>
                           <th>SKS</th>
                           <th>Semester</th>
                           <th>Jenis</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>

                        <?php
                        $i =  intval($start_number) + 1;
                        foreach ($rs_mk->result() as $mk) { ?>
                           <tr>
                              <td><?php echo str_pad((int)$i, 2, 0, STR_PAD_LEFT); ?></td>
                              <td><?php echo $mk->kode_mk; ?></td>
                              <td><?php echo $mk->nama; ?></td>
                              <td><?php echo $mk->sks; ?></td>
                              <td><?php echo $mk->semester; ?></td>
                              <td><?php echo $mk->jenis; ?></td>

                              <td>
                                 <a href="<?php echo base_url() . 'web/matakuliah_edit/' . $mk->kode; ?>" class="btn btn-primary text-white"><i class="mdi mdi-pencil"></i></a>
                                 <a href="<?php echo base_url() . 'web/matakuliah_delete/' . $mk->kode; ?>" class="btn btn-danger text-white" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="mdi mdi-delete-forever"></i></a>
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