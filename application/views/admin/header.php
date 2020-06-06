<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title> Knowleddge Hub Global Dashboard </title>
  <!-- Favicon -->
  <link href="<?= base_url(); ?>assets/app-oicon.jpg" rel="icon" type="image/jpg">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="<?= base_url(); ?>assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="<?= base_url(); ?>assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- <link type="text/css" href="<z?= base_url(); ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet"> -->
   <link type="text/css" href="<?= base_url(); ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="<?= base_url(); ?>assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
</head>
<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="">
        <img src="<?= base_url(); ?>assets/logo.png" class="navbar-brand-img" style="max-height:6.5rem">
      </a>
      <!-- User -->
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item dropdown active">
            <a class="nav-link" href="<?= base_url('Admin_con') ?>">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>

          </li>
          <li class="nav-item <?php if ((strpos($actual_link,'students') !== false) || (strpos($actual_link, 'add_students') !== false) || (strpos($actual_link, 'students_edit') !== false))  { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/students'); ?>">
              <i class="ni ni-tv-2 text-primary"></i> Students Listing
            </a>
          </li>
          <li class="nav-item <?php if ((strpos($actual_link,'country') !== false) || (strpos($actual_link, 'add_country') !== false) || (strpos($actual_link, 'country_edit') !== false))  { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/country'); ?>">
              <i class="ni ni-tv-2 text-primary"></i> Country Listing
            </a>
          </li>
          <li class="nav-item <?php if ((strpos($actual_link,'associatecenters') !== false) || (strpos($actual_link, 'add_associatecenters') !== false) || (strpos($actual_link, 'associatecenters_edit') !== false))  { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/associatecenters'); ?>">
              <i class="ni ni-tv-2 text-primary"></i> Associates Details
            </a>
          </li>
          <li class="nav-item <?php if ((strpos($actual_link,'ouroffices') !== false) || (strpos($actual_link, 'add_office') !== false) || (strpos($actual_link, 'office_edit') !== false))  { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/ouroffices'); ?>">
              <i class="ni ni-tv-2 text-primary"></i> Our Offices
            </a>
          </li>
          <li class="nav-item <?php if ((strpos($actual_link,'staff') !== false) || (strpos($actual_link, 'add_staff') !== false) || (strpos($actual_link, 'staff_edit') !== false))  { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/staff'); ?>">
              <i class="ni ni-tv-2 text-primary"></i> Staff Member
            </a>
          </li>
          <li class="nav-item <?php if ((strpos($actual_link,'experts') !== false) || (strpos($actual_link, 'add_experts') !== false) || (strpos($actual_link, 'experts_edit') !== false))  { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/experts'); ?>">
              <i class="ni ni-tv-2 text-primary"></i> Experts List 
            </a>
          </li>
          <li class="nav-item <?php if ((strpos($actual_link,'ouroffices') !== false) || (strpos($actual_link, 'add_office') !== false) || (strpos($actual_link, 'office_edit') !== false))  { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/ouroffices'); ?>">
              <i class="ni ni-tv-2 text-primary"></i> Connect Us 
            </a>
          </li>
          <li class="nav-item <?php if ((strpos($actual_link,'banner') !== false) || (strpos($actual_link, 'ban_add') !== false) || (strpos($actual_link, 'ban_edit') !== false))  { echo 'active'; } ?>">
              <a class="nav-link" href="<?= base_url('admin_con/banner'); ?>">
                  <i class="ni ni-tv-2 text-primary"></i> Banner
              </a>
          </li>
          <li class="nav-item <?php if ((strpos($actual_link,'admin') !== false) || (strpos($actual_link, 'add_admin') !== false) || (strpos($actual_link, 'admin_edit') !== false))  { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/admin'); ?>">
              <i class="ni ni-tv-2 text-primary"></i> Admin
            </a>
          </li>
		  <?php /* $role = $this->session->userdata('is_admin'); if($role == 1) { ?>
          <li class="nav-item <?php if ((strpos($actual_link,'listing') !== false) || (strpos($actual_link, 'add_listing') !== false) || (strpos($actual_link, 'listing_edit') !== false))  { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/listing'); ?>">
              <i class="ni ni-planet text-blue"></i> Listing
            </a>
          </li>
				  <li class="nav-item <?php if ((strpos($actual_link,'agency') !== false) || (strpos($actual_link, 'agency_edit') !== false) || (strpos($actual_link, 'add_agency') !== false))  { echo 'active'; } ?>">
    			<a class="nav-link" href="<?= base_url('admin_con/agency'); ?>">
    			  <i class="ni ni-briefcase-24 text-pink"></i> Agency (State Wise)
    			</a>
    		  </li>
    		  <li class="nav-item <?php if ((strpos($actual_link,'french') !== false) || (strpos($actual_link, 'french_add') !== false) || (strpos($actual_link, 'french_edit') !== false))  { echo 'active'; } ?>">
    			<a class="nav-link" href="<?= base_url('admin_con/french'); ?>">
    			  <i class="ni ni-bag-17 text-blue"></i> Franchise (City Wise)
    			</a>
    		  </li>
    		  <li class="nav-item <?php if ((strpos($actual_link, 'comision') !== false) || (strpos($actual_link, 'detial_page') !== false))  { echo 'active'; } ?>">
    			<a class="nav-link" href="<?= base_url('admin_con/comision'); ?>">
    			  <i class="ni ni-money-coins text-blue"></i> Commision Management
    			</a>
    		  </li>
          <li class="nav-item <?php if ((strpos($actual_link, 'users') !== false) || (strpos($actual_link, 'user_edit') !== false)) { echo 'active'; } ?>">
              <a class="nav-link" href="<?= base_url('admin_con/users'); ?>">
                  <i class="ni ni-single-02 text-yellow"></i> Users
              </a>
          </li>
    		  <li class="nav-item <?php if ((strpos($actual_link, 'agents') !== false) || (strpos($actual_link, 'user_edit') !== false)) { echo 'active'; } ?>">
      			<a class="nav-link" href="<?= base_url('admin_con/agents'); ?>">
      			  <i class="ni ni-circle-08 text-orange"></i> Agents
      			</a>
    		  </li>
    		  <li id="shw" class="nav-item <?php if (strpos($actual_link, 'setting') !== false) { echo 'active'; } ?>">
      			<a class="nav-link" href="#">
      			  <i class="ni ni-settings-gear-65 text-orange"></i> Setting
      			  <i class="ni ni-bold-down text-orange text-right"></i>
      			</a>
    		  </li>
          
          <li id="shw2" class="nav-item <?php if (strpos($actual_link, 'setting') !== false) { echo 'active'; } ?>">
              <a class="nav-link" href="<?= base_url('admin_con/setting'); ?>">
                  <i class="ni ni-settings-gear-65 text-orange"></i> Admin Setting
              </a>
          </li>
          <li id="shw3" class="nav-item <?php if ((strpos($actual_link, 'cms_view') !== false) || (strpos($actual_link, 'cms_edit') !== false) || (strpos($actual_link, 'cms_add') !== false))  { echo 'active'; } ?>">
              <a class="nav-link" href="<?= base_url('admin_con/cms_view'); ?>">
                  <i class="ni ni-collection text-blue"></i> CMS Pages
              </a>
          </li>
          <li id="shw4" class="nav-item <?php if ((strpos($actual_link, 'category') !== false) || (strpos($actual_link, 'cat_edit') !== false) || (strpos($actual_link, 'cat_add') !== false))  { echo 'active'; } ?>">
              <a class="nav-link" href="<?= base_url('admin_con/category'); ?>">
                  <i class="ni ni-bullet-list-67 text-pink"></i> Category
              </a>
          </li>
		  <li id="shw5" class="nav-item <?php if ((strpos($actual_link, 'states') !== false) || (strpos($actual_link, 'state_edit') !== false))  { echo 'active'; } ?>">
			<a class="nav-link" href="<?= base_url('admin_con/states'); ?>">
			  <i class="ni ni-settings-gear-65 text-orange"></i> States
			</a>
		  </li>
      </ul>
		<?php } elseif($role == 2) { ?>
		  <li class="nav-item <?php if ((strpos($actual_link,'french') !== false) || (strpos($actual_link, 'french_add') !== false) || (strpos($actual_link, 'french_edit') !== false))  { echo 'active'; } ?>">
			<a class="nav-link" href="<?= base_url('admin_con/french'); ?>">
			  <i class="ni ni-bag-17 text-blue"></i> Franchise (City Wise)
			</a>
		  </li>
		  <li class="nav-item <?php if ((strpos($actual_link, 'comision') !== false) || (strpos($actual_link, 'detial_page') !== false))  { echo 'active'; } ?>">
			<a class="nav-link" href="<?= base_url('admin_con/comision'); ?>">
			  <i class="ni ni-money-coins text-blue"></i> Commision Management
			</a>
		  </li>
		  <li class="nav-item <?php if ((strpos($actual_link, 'agents') !== false) || (strpos($actual_link, 'user_edit') !== false)) { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/agents'); ?>">
              <i class="ni ni-circle-08 text-orange"></i> Agents
            </a>
          </li>
		<?php } else { ?>
			<li class="nav-item <?php if ((strpos($actual_link, 'comision') !== false) || (strpos($actual_link, 'detial_page') !== false))  { echo 'active'; } ?>">
				<a class="nav-link" href="<?= base_url('admin_con/comision'); ?>">
				  <i class="ni ni-money-coins text-blue"></i> Commision Management
				</a>
			  </li>
			  <li class="nav-item <?php if (strpos($actual_link, 'setting') !== false) { echo 'active'; } ?>">
			<a class="nav-link" href="<?= base_url('admin_con/setting'); ?>">
			  <i class="ni ni-settings-gear-65 text-orange"></i> Setting
			</a>
		  </li>
			<li class="nav-item <?php if ((strpos($actual_link, 'agents') !== false) || (strpos($actual_link, 'user_edit') !== false)) { echo 'active'; } ?>">
            <a class="nav-link" href="<?= base_url('admin_con/agents'); ?>">
              <i class="ni ni-circle-08 text-orange"></i> Agents
            </a>
          </li>
		<?php } */ ?>
        </ul>
        <!-- Divider -->
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h2 mb-0 text-white text-uppercase d-none d-lg-inline-block" style="margin-left:30%;"> Knowledge Hub Global </a>
        <!-- Form -->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                  <?php //print_r($_SESSION); ?>
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?= base_url(); ?>assets/img/agent.png">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <!-- <span class="mb-0 text-sm  font-weight-bold"> <z?= $_SESSION['admin_name']; ?> </span><br> -->
                  <small class="mb-0 text-sm  font-weight-bold"> <?= $_SESSION['email']; ?> </small>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <a href="<?= site_url('admin_con/logout') ?>" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-5 pt-5 pt-md-8" style="background: linear-gradient(87deg, #b19cd9 0, #b19cd9 100%) !important;">
    </div>
