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
              <h3 class="mb-0">Station List</h3>
            </div>
            <div class="col-4 text-right">
              <a href="<?= base_url('Admin/add_station')?>" class="btn btn-sm btn-primary">Add New</a>
            </div>
          </div>
        </div>
        <?php
		$para = array('table'=>'station_list');
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
                <th scope="col">Station Name</th>
                <th scope="col">Station Description</th>
                <th scope="col">Status</th>
                <th scope="col">Order No.</th>
                <th scope="col">Start / End Point</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($page as $data) { ?>
              <tr>
                <th scope="row"><?= $data['s_id']; ?></th>
                <td><?= $data['station_name']; ?></td>
                <td><?= $data['station_desc']; ?></td>
                <td>
                    <?php if($data['status'] == 1) { ?>
                        <a class="btn btn-sm btn-success"> Active </a>
                    <?php } else { ?>
                        <a class="btn btn-sm btn-danger"> Not Active </a>
                    <?php } ?>
                </td>
                <td><?= $data['sorting_order']; ?></td>
                <td>
                    <?php if($data['status'] == 1) { ?>
                        <a class="btn btn-sm btn-success"> Active </a>
                    <?php } else { ?>
                        <a class="btn btn-sm btn-danger"> Not Active </a>
                    <?php } ?>
                </td>
                <td><?php if(!empty($cat)) {echo $cat[0]['name'];}  ?></td>
                <td><?php if(!empty($user)) {echo $user[0]['name'];} ?> ( <?= $data['agent_id']; ?> )</td>
                <td class="text-right">
                    <a class="btn btn-sm btn-primary" onclick="deletepage(<s?= $data['cmp_id']; ?>,0)" href="#"><i class="ni ni-check-bold"></i> Active </a>
                    <!-- <a class="btn btn-sm btn-primary" href="<s?= base_url('Admin_con/listing_edit/').$data['cmp_id']; ?>"><i class="ni ni-settings"></i> Edit </a> -->

                <!-- <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <z?php if($data['status'] != 1) { ?>
						  <a class="dropdown-item" onclick="deletepage(<z?= $data['cmp_id']; ?>,1,<z?= $data['agent_id']; ?>)"><i class="ni ni-check-bold"></i> Approve </a>
					  <z?php } ?>
                      <a class="dropdown-item" onclick="deletepage(<z?= $data['cmp_id']; ?>,0,<z?= $data['agent_id']; ?>)"><i class="ni ni-fat-remove"></i> Disapprove </a>
                      <a class="dropdown-item" href="<z?= base_url('Admin_con/listing_edit/').$data['cmp_id']; ?>" ><i class="ni ni-settings"></i> Edit </a>
                    </div>
                </div> -->
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
