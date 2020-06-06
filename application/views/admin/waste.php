if($role == 1) {
    ?>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Active Agency</h5>
                        <span class="h2 font-weight-bold mb-0"><?= $agncy[0]['total']; ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $para = array('query'=>'SELECT COUNT(f_id) AS total FROM `franchise` WHERE status = 1');
    $frnch = $this->Admin_model->getdata($para); ?>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Active Franchise</h5>
                        <span class="h2 font-weight-bold mb-0"><?= $frnch[0]['total']; ?></span>
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
    <?php $para = array('query'=>'SELECT COUNT(id) AS total FROM `users` WHERE type = 1');
    $agent = $this->Admin_model->getdata($para); ?>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">agents</h5>
                        <span class="h2 font-weight-bold mb-0"><?= $agent[0]['total']; ?></span>
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
    <?php $para = array('query'=>'SELECT COUNT(id) AS total FROM `users` WHERE type = 0');
    $user = $this->Admin_model->getdata($para); ?>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">listing</h5>
                        <span class="h2 font-weight-bold mb-0"><?= $user[0]['total']; ?></span>
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
<?php } elseif($role == 2) { ?>
    <?php $para = array('query'=>'SELECT COUNT(f_id) AS total FROM `franchise` WHERE status = 1');
    $frnch = $this->Admin_model->getdata($para); ?>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Active Franchise</h5>
                        <span class="h2 font-weight-bold mb-0"><?= $frnch[0]['total']; ?></span>
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
    <?php $para = array('query'=>'SELECT COUNT(id) AS total FROM `users` WHERE type = 1');
    $agent = $this->Admin_model->getdata($para); ?>
    <div class="col-xl-6 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">agents</h5>
                        <span class="h2 font-weight-bold mb-0"><?= $agent[0]['total']; ?></span>
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
<?php } else { ?>
    <?php $para = array('query'=>'SELECT COUNT(id) AS total FROM `users` WHERE type = 1');
    $agent = $this->Admin_model->getdata($para); ?>
    <div class="col-xl-12 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">agents</h5>
                        <span class="h2 font-weight-bold mb-0"><?= $agent[0]['total']; ?></span>
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
