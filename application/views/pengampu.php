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
         <a href="<?php echo base_url() . 'web/pengampu_add'; ?>"> <button class="btn btn-primary pull-right mb-3"><i class="mdi mdi-plus"></i> Tambah Data</button></a>

         <form class="form" method="POST" action="<?php echo base_url() . 'web/pengampu_search' ?>">
            <div class="form-group">
               <label class="col-sm-5">Semester</label>
               <div class="col-sm-5">
                  <select id="semester_tipe" name="semester_tipe" class="form-select shadow-none form-control-line" onchange=" change_get()">
                     <!--<option value="1" <?php echo isset($semester_tipe) ? ($semester_tipe === '1' ? 'selected' : '') : ''; ?> /> GANJIL-->
                     <!--<option value="0" <?php echo isset($semester_tipe) ? ($semester_tipe === '0' ? 'selected' : '') : ''; ?> /> GENAP-->
                     <option value="1" <?php echo $this->session->userdata('pengampu_semester_tipe') === '1' ? 'selected' : ''; ?> /> GANJIL
                     <option value="0" <?php echo $this->session->userdata('pengampu_semester_tipe') === '0' ? 'selected' : ''; ?> /> GENAP
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-5">Tahun Akademik</label>
               <div class="col-sm-5">
                  <select id="tahun_akademik" name="tahun_akademik" class="form-select shadow-none form-control-line" onchange="change_get()">
                     <!--<option value="2011-2012" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2011-2012' ? 'selected' : '') : ''; ?> /> 2011-2012-->
                     <!--<option value="2012-2013" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2012-2013' ? 'selected' : '') : ''; ?> /> 2012-2013-->
                     <!--<option value="2013-2014" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2013-2014' ? 'selected' : '') : ''; ?> /> 2013-2014-->
                     <!--<option value="2014-2015" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2014-2015' ? 'selected' : '') : ''; ?> /> 2014-2015-->
                     <!--<option value="2015-2016" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2015-2016' ? 'selected' : '') : ''; ?> /> 2015-2016-->
                     <!--<option value="2016-2017" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2016-2017' ? 'selected' : '') : ''; ?> /> 2016-2017-->
                     <!--<option value="2017-2018" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2017-2018' ? 'selected' : '') : ''; ?> /> 2017-2018-->
                     <!--<option value="2018-2019" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2018-2019' ? 'selected' : '') : ''; ?> /> 2018-2019-->
                     <!--<option value="2019-2020" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2019-2020' ? 'selected' : '') : ''; ?> /> 2019-2020-->
                     <!-- 
                     <option value="2011-2012" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2011-2012' ? 'selected' : ''; ?> /> 2011-2012
                     <option value="2021-2022" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2021-2022' ? 'selected' : ''; ?> /> 2021-2022 -->
                     <option value="2022-2023" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2022-2023' ? 'selected' : ''; ?> /> 2022-2023
                  </select>
               </div>
            </div>
            <div class="form-group col-lg mt-4 d-flex">
               <div class="form ">
                  <label>Dosen / Matakuliah</label>
                  <input type="text" name="search_query" placeholder="Cari ..." value="<?php echo isset($search_query) ? $search_query : ''; ?>">
                  <button type="submit" class="btn btn-info text-white">Cari</button>
                  <a href="<?php echo base_url() . 'web/pengampu'; ?>"><button type="button" class="btn btn-outline-danger">Clear</button> </a>
               </div>
            </div>
         </form>

         <?php if ($rs_pengampu->num_rows() === 0) : ?>
            <div class="alert alert-danger" role="alert">
               Tidak ada data, Silahkan inputkan data!<a class="alert-link" href="<?php echo base_url() . 'web/pengampu_add'; ?> "> tambah data</a>
            </div>
         <?php else : ?>

            <div id="content_ajax">
               <nav aria-label="Page navigation example">
                  <div class="pagination" id="ajax_paging">
                     <ul class="pagination">
                        <?php echo $this->pagination->create_links(); ?>
                     </ul>
                  </div>
               </nav>
               <br>
               <div class="widget-content">
                  <table class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Matakuliah</th>
                           <th>Dosen</th>
                           <th>Nama Asdos</th>
                           <th>Kelas</th>
                           <th>Tahun Akademik</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>

                        <?php
                        $i =  intval($start_number) + 1;
                        foreach ($rs_pengampu->result() as $pengampu) { ?>
                           <tr<?php echo ' id="row_' . $pengampu->kode . '"'; ?>>
                              <td><?php echo str_pad((int)$i, 3, 0, STR_PAD_LEFT); ?></td>
                              <td><?php echo $pengampu->nama_mk; ?></td>
                              <td><?php echo $pengampu->nama_dosen; ?></td>
                              <td><?php echo $pengampu->nama_asdos; ?></td>
                              <td><?php echo $pengampu->kelas; ?></td>
                              <td><?php echo $pengampu->tahun_akademik; ?></td>

                              <td>
                                 <a href="<?php echo base_url() . 'web/pengampu_edit/' . $pengampu->kode; ?>" class="btn btn-primary text-white"><i class="mdi mdi-pencil"></i></a>
                                 <a class="btn btn-danger text-with" onClick="delete_row('web/pengampu_delete/', <?php echo $pengampu->kode ?>)"><i class="mdi mdi-delete-forever text-white"></i></a>
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