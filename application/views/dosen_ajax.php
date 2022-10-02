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


       <div class="pagination" id="ajax_paging" aria-label="Page navigation example">
         <ul class=" pagination pagination-lg">
           <?php echo $this->pagination->create_links(); ?>
         </ul>
       </div>