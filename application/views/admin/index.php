<div class="container-fluid mt--7">
    <div class="row">
        <div class="row mt-5">
            <?php
            $role =  $this->session->userdata('is_admin');
            if($role == 1) {
                $para = array('query'=>'SELECT COUNT(id) AS total FROM `studednts_profile` WHERE status = 1');
                $students = $this->Admin_model->getdata($para);
                // print_r($month);
                $para = array('query'=>'SELECT COUNT(id) AS total FROM `associate_center_details` WHERE status = 1');
                $associate = $this->Admin_model->getdata($para);
                // print_r($month);
                $para = array('query'=>'SELECT COUNT(id) AS total FROM `our_offices` WHERE status = 1');
                $offices = $this->Admin_model->getdata($para);
                // print_r($month);
                $para = array('query'=>'SELECT COUNT(id) AS total FROM `staff` WHERE status = 1');
                $staff = $this->Admin_model->getdata($para);
                // print_r($month);
            } elseif ($role == 2) {
                     $id =  $this->session->userdata('agnc_id');
                     $para = array('query'=>"SELECT COUNT(f_id) AS total FROM `franchise` WHERE status = 1 AND agency_id = '$id'");
                     $frnch = $this->Admin_model->getdata($para);
                     // print_r($month);
                     $para = array('query'=>"SELECT COUNT(id) AS total FROM `users` WHERE type = 1 AND agency_id = '$id'");
                     $agent = $this->Admin_model->getdata($para);
                     // print_r($month);
                     $agncy = '';
                     $user = '';
                     $frnch = '';
                }  else {
                    $id =  $this->session->userdata('frnch_id');
                    $para = array('query'=>"SELECT COUNT(id) AS total FROM `users` WHERE type = 1 AND franchise_id = '$id'");
                    $agent = $this->Admin_model->getdata($para);
                    // print_r($agent);
                    $para = array('query'=>"SELECT COUNT(id) AS total FROM `users` WHERE type = 0 AND franchise_id = '$id'");
                    $user = $this->Admin_model->getdata($para);
                    // print_r($user);
                    $agncy = '';
                    $frnch = '';
                    // exit;
                } if($students != '') {?>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Active Students</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $students[0]['total']; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } if ($associate != '') { ?>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Associate centers</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $associate[0]['total']; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } if ($offices != '') { ?>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Available Offices</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $offices[0]['total']; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } if ($staff != '') { ?>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Available Staff</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $staff[0]['total']; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
