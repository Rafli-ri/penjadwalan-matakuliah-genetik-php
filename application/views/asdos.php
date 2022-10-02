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
            <a href="<?php echo base_url() . 'web/asdos_add'; ?>"> <button class="btn btn-primary pull-right"><i class=" mdi mdi-plus"></i> Tambah Data</button></a>

            <br>
            <br>
            <?php if ($rs_asdos->num_rows() === 0) : ?>
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">�</button>
                    Tidak ada data.
                </div>
            <?php else : ?>
                <div class="widget-content">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 1;
                            foreach ($rs_asdos->result() as $asdos) { ?>
                                <tr>
                                    <td><?php echo str_pad((int)$i, 2, 0, STR_PAD_LEFT); ?></td>
                                    <td><?php echo $asdos->nama_asdos; ?></td>

                                    <td>
                                        <a href="<?php echo base_url() . 'web/asdos_edit/' . $asdos->kode; ?>" class="btn btn-primary"><i class=" mdi mdi-pencil"></i></a>
                                        <a href="<?php echo base_url() . 'web/asdos_delete/' . $asdos->kode; ?>" class="btn btn-danger text-white" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="mdi mdi-delete-forever text-white"></i></a>
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