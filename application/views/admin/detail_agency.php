<?php
$para = array('query'=>"SELECT *,SUM(comission) as total FROM `manage_case` where agency_id = '$com->a_id' GROUP BY franchise_id");
$page = $this->Admin_model->getdata($para); // print_r($page);// EXIT;
?>
<div class="container-fluid mt--7">
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
            <h3 class="mb-0">Total Franchise Of <?= $com->a_name; ?></h3>
          </div>
        </div>
      </div>
      <div class="col-xl-12">
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush" id="table_french">
            <thead class="thead-light">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Franchise Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($page as $data) {
                $para = array('where'=>"and f_id = '".$data['franchise_id']."'",'select'=>'f_name','table'=>'franchise');
                $detail = $this->Admin_model->getdata($para);
                ?>
              <tr>
                <th scope="row">
                  <?= $data['franchise_id']; ?>
                </th>
                <td>
                  <?= $detail[0]['f_name']; ?>
                </td>
                <td>
                  <?= $data['total']; ?>
                </td>
                <td class="text-right">
                  <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/detial_page/').'franchise/'.$data['franchise_id']; ?>"><i class="ni ni-settings"></i> Details </a>
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
</div>
