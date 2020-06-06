<div class="container-fluid mt--7">
  <div class="row mt-5">
    <div class="col-xl-12">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Manage Agents</h3>
            </div>
          </div>
        </div>
        <?php
		$role = $this->session->userdata('is_admin');
		if($role == 1) {
			$para = array(
			'where'=>'and type = 1',
			'table'=>'users'
			);
		} elseif($role == 2) {
			$id = $this->session->userdata('agnc_id');
			$para = array(
			'where'=>"and type = 1 and agency_id = '$id'",
			'table'=>'users'
			);
		} else {
			$id = $this->session->userdata('frnch_id');
			$para = array(
			'where'=>"and type = 1 and franchise_id = '$id'",
			'table'=>'users'
			);
		}
        $page = $this->Admin_model->getdata($para);
        ?>
        <div class="col-xl-12">
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="table_agent">
              <thead class="thead-light">
                <tr>
                  <th scope="col">User Id</th>
                  <th scope="col">Mobile No.</th>
                  <th scope="col">Users</th>
                  <th scope="col">Users Email Id</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($page as $data) { ?>
                  <tr>
                    <th scope="row">
                      <?= $data['id']; ?>
                    </th>
                    <td>
                      <?= $data['mobile']; ?>
                    </td>
                    <td>
                      <?= $data['name']; ?>
                    </td>
                    <td>
                      <?= $data['email']; ?>
                    </td>
                    <td class="text-right">
                      <!-- <a class="btn btn-sm btn-primary" href="<z?= base_url('Admin_con/cms_edit/').$data['id']; ?>"><i class="ni ni-settings"></i> Edit  </a> -->
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" onclick="deletepage(<?= $data['id']; ?>,0)"><i class="ni ni-fat-remove"></i> Make user </a>
                          <!--a class="dropdown-item" onclick="deletepage(<b?= $data['id']; ?>,1)"><i class="ni ni-check-bold"></i> Make Agent </a-->
                          <a class="dropdown-item" onclick="deletepage(<?= $data['id']; ?>,2)"><i class="ni ni-fat-remove"></i> Block </a>
                          <a class="dropdown-item" href="<?= base_url('Admin_con/user_edit/').$data['id']?>"><i class="ni ni-badge"></i> Edit </a>
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
</div>
<script>
function deletepage(pg_id,para){
  event.preventDefault();

  $.ajax({
    url: '<?= base_url('admin_con/user_status'); ?>',
    dataType: "html",
    data: {page:pg_id,sta:para},
    type: "POST",
    error: function () {
      alert('An Error Ocurred.');
    },
    success: function (response) {
      window.location.href='';
    }
  });
}
</script>
