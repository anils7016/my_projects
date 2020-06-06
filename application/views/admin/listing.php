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
              <h3 class="mb-0">Page visits</h3>
            </div>
            <div class="col-4 text-right">
              <a href="<?= base_url('Admin_con/add_listing')?>" class="btn btn-sm btn-primary">Add New</a>
            </div>
          </div>
        </div>
        <?php
		$role = $this->session->userdata('is_admin');
		if($role == 1) {
			$para = array(
			  'table'=>'listing',
			);
		} elseif($role == 2) {
			$id = $this->session->userdata('agnc_id');
			$para = array(
			'query'=>"SELECT * FROM `listing` INNER JOIN users on listing.agent_id = users.id INNER JOIN agency ON users.agency_id = agency.a_id WHERE users.type = 1 and users.agency_id = '$id'",
			);
		} else {
			$id = $this->session->userdata('frnch_id');
			$para = array(
			'query'=>"SELECT * FROM `listing` INNER JOIN users on listing.agent_id = users.id INNER JOIN franchise ON users.franchise_id = franchise.f_id WHERE users.type = 1 and users.franchise_id = '$id'",
			);
		}
        $page = $this->Admin_model->getdata($para);
        //echo $this->db->last_query();
        ?>
		<div class="col-xl-12">
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush" id="table_user">
            <thead class="thead-light">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Company Name</th>
                <th scope="col">Email Id</th>
                <th scope="col">Owner Name</th>
                <th scope="col">Category</th>
                <th scope="col">Agent Name ( Id )</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($page as $data) {
                $para = array(
                  'where'=>"and id = '".$data['cat_id']."'",
                  'select'=>'name',
                  'table'=>'category',
                );
              $cat = $this->Admin_model->getdata($para);
              $para = array(
                'where'=>"and id = '".$data['agent_id']."'",
                'select'=>'name',
                'table'=>'users',
              );
            $user = $this->Admin_model->getdata($para); ?>
              <tr>
                <th scope="row">
                  <?= $data['cmp_id']; ?>
                </th>
                <td>
                  <?= $data['title']; ?>
                </td>
                <td>
                  <?= $data['email']; ?>
                </td>
                <td>
                  <?= $data['owner']; ?>
                </td>
                <td>
                  <?php if(!empty($cat)) {echo $cat[0]['name'];}  ?>
                </td>
                <td>
                  <?php if(!empty($user)) {echo $user[0]['name'];} ?> ( <?= $data['agent_id']; ?> )
                </td>
                <td>
                  <?php if($data['status'] == 1) { ?>
                    <a class="btn btn-sm btn-success"> Approved </a>
                  <?php } else { ?>
                    <a class="btn btn-sm btn-danger"> Pending </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <!-- <a class="btn btn-sm btn-primary" onclick="deletepage(<s?= $data['cmp_id']; ?>,0)" href="#"><i class="ni ni-check-bold"></i> Active </a>
                  <a class="btn btn-sm btn-primary" href="<s?= base_url('Admin_con/listing_edit/').$data['cmp_id']; ?>"><i class="ni ni-settings"></i> Edit </a> -->

                <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?php if($data['status'] != 1) { ?>
						  <a class="dropdown-item" onclick="deletepage(<?= $data['cmp_id']; ?>,1,<?= $data['agent_id']; ?>)"><i class="ni ni-check-bold"></i> Approve </a>
					  <?php } ?>
                      <a class="dropdown-item" onclick="deletepage(<?= $data['cmp_id']; ?>,0,<?= $data['agent_id']; ?>)"><i class="ni ni-fat-remove"></i> Disapprove </a>
                      <a class="dropdown-item" href="<?= base_url('Admin_con/listing_edit/').$data['cmp_id']; ?>" ><i class="ni ni-settings"></i> Edit </a>
                    </div>
                </div>
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
      console.log(response);
      //window.location.href='';
		}
	});
}
</script>
