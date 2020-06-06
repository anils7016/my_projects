<div class="container-fluid mt--7">
  <?php $role = $this->session->userdata('is_admin'); if($role == 1) { ?>
    <div class="row mt-5">
      <?php $error = $this->session->flashdata('msg'); if(!empty($error)) { ?>
        <div class="col-xl-12">
          <?= $error; ?>
        </div>
      <?php } ?>
      <div class="col-xl-12">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Agency Commission</h3>
              </div>
            </div>
          </div>
          <?php
          $para = array('query'=>"SELECT *,SUM(comission) AS total FROM `manage_case` GROUP BY agency_id ");
          $page = $this->Admin_model->getdata($para); ?>
          <div class="col-xl-12">
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush" id="table_user">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Agency Name</th>
                    <th scope="col">Agent Name ( Id )</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($page as $data) {
                    if($data['agency_id'] != 0) {
                      $para = array(
                        'where'=>"and a_id = '".$data['agency_id']."'",
                        'select'=>'a_id,a_name',
                        'table'=>'agency',
                      );
                      $agency = $this->Admin_model->getdata($para);
                    }
                    $para = array(
                      'where'=>"and id = '".$data['agent_id']."'",
                      'select'=>'name',
                      'table'=>'users',
                    );
                    $user = $this->Admin_model->getdata($para); ?>
                    <tr>
                      <th scope="row">
                        <?php if($data['agency_id'] != 0) { echo $agency[0]['a_id']; } else { echo '-'; } ?>
                      </th>
                      <td>
                        <?php if($data['agency_id'] != 0) { echo $agency[0]['a_name']; } else { echo 'Admin'; } ?>
                      </td>
                      <td>
                        <?php if(!empty($user)) {echo $user[0]['name'];} ?> ( <?= $data['agent_id']; ?> )
                      </td>
                      <td class="text-right">
                        <button type="button" class="btn btn-secondary"><?= $data['total']; ?></button>
                      </td>
                      <td class="text-right">
                        <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/detial_page/').'agency/'.$agency[0]['a_id']; ?>"><i class="ni ni-settings"></i> Details </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-xl-12">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Franchise Commission</h3>
              </div>
            </div>
          </div>
          <?php
          $para = array('query'=>"SELECT *,SUM(comission) AS total FROM `manage_case` GROUP BY franchise_id ");
          $page = $this->Admin_model->getdata($para); ?>
          <div class="col-xl-12">
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush" id="table_french">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Franchise Name</th>
                    <th scope="col">Agent Name ( Id )</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($page as $data) {
                    if($data['franchise_id'] != 0) {
                      $para = array(
                        'where'=>"and f_id = '".$data['franchise_id']."'",
                        'select'=>'f_id,f_name',
                        'table'=>'franchise',
                      );
                      $agency = $this->Admin_model->getdata($para);
                    }
                    $para = array(
                      'where'=>"and id = '".$data['agent_id']."'",
                      'select'=>'name',
                      'table'=>'users',
                    );
                    $user = $this->Admin_model->getdata($para); ?>
                    <tr>
                      <th scope="row">
                        <?php if($data['franchise_id'] != 0) { echo $agency[0]['f_id']; } else { echo '-'; } ?>
                      </th>
                      <td>
                        <?php if($data['franchise_id'] != 0) { echo $agency[0]['f_name']; } else { echo 'Admin'; } ?>
                      </td>
                      <td>
                        <?php if(!empty($user)) {echo $user[0]['name'];} ?> ( <?= $data['agent_id']; ?> )
                      </td>
                      <td class="text-right">
                        <button type="button" class="btn btn-secondary"><?= $data['total']; ?></button>
                      </td>
                      <td class="text-right">
                        <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/detial_page/').'franchise/'.$agency[0]['f_id']; ?>"><i class="ni ni-settings"></i> Details </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } elseif($role == 2) { $id = $this->session->userdata('agnc_id'); ?>
  <div class="row mt-5">
    <?php $error = $this->session->flashdata('msg'); if(!empty($error)) { ?>
      <div class="col-xl-12">
        <?= $error; ?>
      </div>
    <?php } ?>
    <div class="col-xl-12">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Franchise Commission</h3>
            </div>
          </div>
        </div>
        <?php
        $para = array('query'=>"SELECT *,SUM(comission) AS total FROM `manage_case` GROUP BY franchise_id HAVING agency_id = '$id'");
        $page = $this->Admin_model->getdata($para); ?>
        <div class="col-xl-12">
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="table_french">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Franchise Name</th>
                  <th scope="col">Agent Name ( Id )</th>
                  <th scope="col">Total</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($page as $data) {
                  if($data['franchise_id'] != 0) {
                    $para = array(
                      'where'=>"and f_id = '".$data['franchise_id']."'",
                      'select'=>'f_id,f_name',
                      'table'=>'franchise',
                    );
                    $agency = $this->Admin_model->getdata($para);
                  }
                  $para = array(
                    'where'=>"and id = '".$data['agent_id']."'",
                    'select'=>'name',
                    'table'=>'users',
                  );
                  $user = $this->Admin_model->getdata($para); ?>
                  <tr>
                    <th scope="row">
                      <?php if($data['franchise_id'] != 0) { echo $agency[0]['f_id']; } else { echo '-'; } ?>
                    </th>
                    <td>
                      <?php if($data['franchise_id'] != 0) { echo $agency[0]['f_name']; } else { echo 'Admin'; } ?>
                    </td>
                    <td>
                      <?php if(!empty($user)) {echo $user[0]['name'];} ?> ( <?= $data['agent_id']; ?> )
                    </td>
                    <td class="text-right">
                      <button type="button" class="btn btn-secondary"><?= $data['total']; ?></button>
                    </td>
                    <td class="text-right">
                      <?php if($data['franchise_id'] != 0) { ?><a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/detial_page/').'franchise/'.$agency[0]['f_id']; ?>"><i class="ni ni-settings"></i> Details </a><?php } else {  ?><button type="button" class="btn btn-secondary">Admin</button> <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php ?>
<?php } else { $id = $this->session->userdata('frnch_id'); ?>
<div class="row mt-5">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Agent Commission</h3>
          </div>
        </div>
      </div>
      <?php
      $para = array('query'=>"SELECT *,SUM(comission) AS total FROM `manage_case` GROUP BY agent_id HAVING franchise_id = '$id'");
      $page = $this->Admin_model->getdata($para);//echo $this->db->last_query(); //print_r($page); ?>
      <div class="col-xl-12">
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush" id="table_french">
            <thead class="thead-light">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Franchise Name</th>
                <th scope="col">Agent Name ( Id )</th>
                <th scope="col">Total</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($page as $data) {
                $para = array(
                  'where'=>"and id = '".$data['agent_id']."'",
                  'select'=>'name,id',
                  'table'=>'users',
                );
                $user = $this->Admin_model->getdata($para); ?>
                <tr>
                  <th scope="row">
                    <?= $user[0]['id']; ?>
                  </th>
                  <td>
                    <?= $user[0]['name']; ?>
                  </td>
                  <td>
                    <?php if(!empty($user)) {echo $user[0]['name'];} ?> ( <?= $data['agent_id']; ?> )
                  </td>
                  <td class="text-right">
                    <button type="button" class="btn btn-secondary"><?= $data['total']; ?></button>
                  </td>
                  <td class="text-right">
                    <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/detial_page/').'agent/'.$user[0]['id']; ?>"><i class="ni ni-settings"></i> Details </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
</div>
<script>
function deletepage(pg_id,para,agnt){
  event.preventDefault();

  $.ajax({
    url: '<?= base_url('admin_con/aprove'); ?>',
    dataType: "html",
    data: {id:pg_id,para:para,agent:agnt,table:'listing'},
    type: "POST",
    error: function () {
      alert('An Error Ocurred.');
    },
    success: function (response) {
      //console.log(response);
      window.location.href='';
    }
  });
}
</script>
