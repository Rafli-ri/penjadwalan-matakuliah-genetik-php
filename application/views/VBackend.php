<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Nice lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Nice admin lite design, Nice admin lite dashboard bootstrap 5 dashboard template" />
    <meta name="description" content="Nice Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Penjadwlan</title>
    <!-- <link rel="canonical" href="https://www.wrappixel.com/templates/niceadmin-lite/" /> -->
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/images/favicon.png" />
    <!-- Custom CSS -->
    <!-- <link href="<?= base_url(); ?>assets/libs/chartist/dist/chartist.min.css" rel="stylesheet" /> -->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/dist/css/style.min.css" rel="stylesheet" />
    <!-- <link href="<?= base_url(); ?>/assets/dist/css/style2.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/lib/bootstrap/css/bootstrap.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/theme.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/badger.min.css" /> -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/datepicker/css/datepicker.css" />

    <script src="<?php echo base_url() ?>assets/lib/jquery-latest.min.js" type="text/javascript"></script>

    <!-- Demo page code -->
    <style type="text/css">
        body .frmModalMsg {
            /* new custom width */
            width: 740px;
            /* must be half of the width, minus scrollbar on the left (30px) */
            margin-left: -280px;
        }

        #line-chart {
            height: 300px;
            width: 800px;
            margin: 0px auto;
            margin-top: 1em;
        }

        .brand {
            font-family: georgia, serif;
        }

        .brand .first {
            color: #ccc;
            font-style: italic;
        }

        .brand .second {
            color: #fff;
            font-weight: bold;
        }

        #loading-div-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            background: #fff;
            width: 100%;
            height: 100%;
        }

        #loading-div {
            width: 300px;
            height: 150px;
            background-color: #fff;
            border: 5px solid #1468b3;
            text-align: center;
            color: #202020;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -150px;
            margin-top: -100px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#loading-div-background").css({
                opacity: 0.5
            });
            <?php if (isset($clear_text_box)) { ?>
                $('input[type=text]').each(function() {
                    $(this).val('');
                });
            <?php } ?>
        });

        function ShowProgressAnimation() {
            $("#loading-div-background").show();
        }

        function change_get() {
            var semester_tipe = document.getElementById('semester_tipe');
            var tahun_akademik = document.getElementById('tahun_akademik');
            window.location.href = "<?php echo base_url() . 'web/pengampu/' ?>" + semester_tipe.options[semester_tipe.selectedIndex].value + "/" + tahun_akademik.options[tahun_akademik.selectedIndex].value;
        }

        function change_dosen_tidak_bersedia() {

            var kode_dosen = document.getElementById('kode_dosen');
            window.location.href = "<?php echo base_url() . 'web/waktu_tidak_bersedia/' ?>" + kode_dosen.options[kode_dosen.selectedIndex].value;
        }

        function get_matakuliah() {
            var semester_tipe = document.getElementById('semester_tipe');
            //
            $.ajax({
                type: "POST",
                async: false,
                cache: false,
                url: "<?php echo base_url() ?>web/option_matakuliah_ajax/" + semester_tipe.options[semester_tipe.selectedIndex].value,
                success: function(msg) {
                    //alert(msg);
                    $('#option_matakuliah').html(msg);
                }
            });
            return false;
        }

        /*
	  $('#myTable tr').click({
		 $(this).remove();
		   return false;
	   };
		
		*/
        function delete_row(link, kode) {
            var answer = confirm('Anda yakin ingin menghapus data ini?');
            if (answer) {
                $.ajax({
                    type: "POST",
                    async: false,
                    cache: false,
                    url: "<?php echo base_url() ?>" + link + kode,
                    success: function(msg) {
                        //alert(msg);
                        //$('#option_matakuliah').html(msg);
                        var tr = $('#row_' + kode);
                        tr.css("background-color", "#FF3700");
                        tr.fadeOut(400, function() {
                            tr.remove();
                        });
                    }
                });

            }
            return false;
        }

        $(function() {
            applyPagination();

            function applyPagination() {
                $("#ajax_paging a").click(function() {

                    var url = $(this).attr("href");
                    $.ajax({
                        type: "POST",
                        data: "ajax=1",
                        url: url,
                        success: function(msg) {
                            $('#content_ajax').fadeOut(0, function() {
                                $('#content_ajax').html(msg);
                                $("#content_ajax").removeAttr("style");
                                applyPagination();
                            }).fadeIn(0);
                        }
                    });
                    return false;
                });
            }


        });
    </script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
    <!-- Le fav and touch icons -->

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-57-precomposed.png" />
    <![endif]-->
</head>

<body>
        <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <a href="index.html" class="logo">
                            <!-- Logo icon -->
                            <b class="logo-icon">
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                          
                        </a>
                    </div>
                 

                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                                <div class="d-flex align-items-center">
                                    
                                </div>
                            </a>
                         
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= base_url('assets/images/users/1.jpg'); ?> " alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" onClick="return confirm('Anda yakin ingin logout?')" href="<?= base_url('web/Logout');  ?>"><i class="mdi mdi-logout"></i>
                                    Logout</a>
                                    
                            </ul>
                        </li>
                                       <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
       
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('web/index'); ?>" aria-expanded="false">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>web/dosen" aria-expanded="false">
                                <i class="mdi mdi-account-network"></i>
                                <span class="hide-menu">Dosen</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>web/matakuliah" aria-expanded="false">
                                <i class="mdi mdi-library"></i>
                                <span class="hide-menu">Matakuliah</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>web/pengampu" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">Pengampu</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>web/ruang" aria-expanded="false">
                                <i class="mdi mdi-server"></i>
                                <span class="hide-menu">Ruang</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>web/jam" aria-expanded="false">
                                <i class="mdi mdi-clock"></i>
                                <span class="hide-menu">Jam</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>web/hari" aria-expanded="false">
                                <i class="mdi mdi-calendar-blank"></i>
                                <span class="hide-menu">Hari</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>web/asdos" aria-expanded="false">
                                <i class="mdi mdi-assistant"></i>
                                <span class="hide-menu">Asisten Dosen</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>web/waktu_tidak_bersedia" aria-expanded="false">
                                <i class="mdi mdi-alert"></i>
                                <span class="hide-menu">Waktu Tidak Bersedia</span>
                            </a>
                        </li>
                        <hr />
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>web/penjadwalan" aria-expanded="false">
                                <i class="mdi mdi-calendar-multiple"></i>
                                <span class="hide-menu">Penjadwalan</span>
                            </a>
                        </li>
                        <hr />
                        <li class="sidebar-item">
                            <div class="modal-body">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" onClick="return confirm('Anda yakin ingin logout?')" href="<?= base_url('web/Logout');  ?>" aria-expanded="false">
                                    <i class="mdi mdi-logout"></i>
                                    <span class="hide-menu">Logout</span>
                                 </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        
        <div class="page-wrapper">
           
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-body">
                            <?php
                            $page_name .= ".php";
                            include $page_name;
                            ?>
                            
                            </div>
                        </div>
                    </div>
    
                    <!-- <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Referral Earnings</h5>
                                <h3 class="font-light">$769.08</h3>
                                <div class="mt-3 text-center">
                                    <div id="earnings"></div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- ============================================================== -->
                    <!-- Recent comment and chats -->
                    <!-- ============================================================== -->
                </div>
               
                <footer class="footer text-center">
                    <!-- Penjadwalan Matakulaih -->
                    <a href="https://www.wrappixel.com"></a>.
                </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="<?= base_url();  ?>/assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="<?= base_url();  ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="<?= base_url();  ?>/assets/extra-libs/sparkline/sparkline.js"></script>
        <!--Wave Effects -->
        <script src="<?= base_url();  ?>/assets/dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="<?= base_url();  ?>/assets/dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="<?= base_url();  ?>/assets/dist/js/custom.min.js"></script>
        <!--This page JavaScript -->
        <!--chartis chart-->
        <script src="<?= base_url();  ?>/assets/libs/chartist/dist/chartist.min.js"></script>
        <script src="<?= base_url();  ?>/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
        <script src="<?= base_url();  ?>/assets/dist/js/pages/dashboards/dashboard1.js"></script>



         <script type="text/javascript" src="<?php echo base_url(); ?>assets/lib/jquery.slugit.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/lib/datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap-filestyle.min.js"> </script>

        <script type="text/javascript">
            $("[rel=tooltip]").tooltip();
            $(function() {
                $('.demo-cancel-click').click(function() {
                    return false;
                });
            });
       


        </script>
</body>

</html>