<div class="container-fluid mt--7">
  <div class="row mt-5">
    <?php $error = $this->session->flashdata('msg'); if(!empty($error)) { ?>
    <div class="col-xl-12">
      <?= $error; ?>
    </div>
    <?php } ?>
    <div class="col-xl-12">
      <div class="card shadow">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Manage Pages</h3>
            </div>
            <div class="col-4 text-right">
              <a href="<?= base_url('Admin_con/cms_add')?>" class="btn btn-sm btn-primary">Add New</a>
            </div>
          </div>
        </div>
        <?php
        $para = array(
          'table'=>'cms'
        );
        $page = $this->Admin_model->getdata($para);
        ?>
		<div class="col-xl-12">
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush" id="table_user">
            <thead class="thead-light">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Page Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($page as $data) { ?>
              <tr>
                <th scope="row">
                  <?= $data['c_id']; ?>
                </th>
                <td>
                  <?= $data['c_name']; ?>
                </td>
                <td>
                  <?php if($data['status'] == 1) { ?>
                    <a class="btn btn-sm btn-success"> Approved </a>
                  <?php } else { ?>
                    <a class="btn btn-sm btn-danger"> Pending </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <a class="btn btn-primary" href="<?= base_url('Admin_con/cms_edit/').$data['c_slug']; ?>"><i class="ni ni-settings"></i> Edit  </a>
                <!--div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="<z?= base_url('Admin_con/cms_edit/').$data['cp_term']; ?>"><i class="ni ni-settings"></i> Edit  </a>
                    </div>
                </div-->
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
	function deletepage1(pg_id,para){
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
