<form action="<?= site_url('Admin_con/addstate'); ?>" method="post" enctype="multipart/form-data">
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
          <div class="card-body pt-1 pt-md-4">
            <div class="row">
              <div class="col-sm-6 text-center">
                <h4 class="mb-0">Is Active</h4>
              </div>
              <div class="col-sm-6 text-center">
                <label class="custom-toggle">
                  <input type="checkbox" name="is-active" value="1">
                  <span class="custom-toggle-slider rounded-circle"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Add New State</h3>
              </div>
              <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Create </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">State information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">State Name</label>
                    <input class="form-control form-control-alternative" placeholder="state Name" name="page-name" type="text" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
          </div>
        </div>
        <?php
        $para = array('table'=>'state');
        $page = $this->Admin_model->getdata($para);?>
		<div class="col-xl-12">
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush" id="table_user">
            <thead class="thead-light">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">State Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($page as $data) { ?>
              <tr>
                <th scope="row">
                  <?= $data['s_id']; ?>
                </th>
                <td>
                  <?= $data['s_name']; ?>
                </td>
                <td>
                  <?php if($data['s_desc'] == 1) { ?>
                    <a class="btn btn-sm btn-success"> Active </a>
                  <?php } else { ?>
                    <a class="btn btn-sm btn-danger"> In Active </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/state_edit/').$data['s_id']; ?>"><i class="ni ni-settings"></i> Edit </a>
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
</form>