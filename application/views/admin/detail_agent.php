<?php
$para = array('where'=>"and agent_id = '$com->agent_id'",'table'=>'manage_case');
$page = $this->Admin_model->getdata($para);
$para1 = array('where'=>"and id = '".$com->agent_id."'",'table'=>'users');
$detail = $this->Admin_model->getdata($para1);//echo $this->db->last_query();//print_r($detail);
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
            <h3 class="mb-0">Total Listing Of <?= $detail[0]['name']; ?></h3>
          </div>
          <div class="col-7 text-right">
                <a href="#" class="badge badge-primary">Balance</a>
                <button class="btn btn-primary"><?= $detail[0]['balance']; ?></button>
                <a href="#" class="badge badge-primary">Commision</a>
                <button class="btn btn-primary"><?= $detail[0]['commission']; ?></button>
                <a href="#" class="badge badge-primary">Daily Limit</a>
                <button class="btn btn-primary"><?= $detail[0]['daily_limit']; ?></button>
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
                <th scope="col">Listing Name</th>
                <th scope="col">Status</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($page as $data) {
                $para = array(
                  'where'=>"and cmp_id = '".$data['listing_id']."'",
                  'select'=>'title',
                  'table'=>'listing',
                );
              $listing = $this->Admin_model->getdata($para);
               ?>
              <tr>
                <th scope="row">
                  <?= $data['m_id']; ?>
                </th>
                <td>
                  <?= $listing[0]['title']; ?> ( <?= $data['listing_id']; ?> )
                </td>
                <td>
                  <?php if($data['status'] == 1) { ?>
                    <button class="btn btn-sm btn-success"> Payment Done </button>
                  <?php } else { ?>
                    <button class="btn btn-sm btn-danger"> Pending </button>
                  <?php } ?>
                </td>
                <td>
                  <?= $data['comission']; ?>
                </td>
                <td class="text-right">
                  <?php if($data['status'] != 1) { ?>
                  <a class="btn btn-sm btn-primary" onclick="deletepage(<?= $data['m_id']; ?>,1,<?= $data['agent_id'] ?>)" href="#"><i class="ni ni-check-bold"></i> Paid </a>
                <?php } ?>
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
<script>
function deletepage(pg_id,para,agnt){
  event.preventDefault();

  $.ajax({
    url: '<?= base_url('admin_con/aprove'); ?>',
    dataType: "html",
    data: {id:pg_id,para:para,agent:agnt,table:'manage_case'},
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
