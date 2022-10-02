		<div class="pagination" id="ajax_paging">
		   <ul>
		      <?php echo $this->pagination->create_links(); ?>
		   </ul>
		</div>

		<div class="widget-content">

		   <table class="table table-striped table-bordered">
		      <thead>
		         <tr>
		            <th>#</th>
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