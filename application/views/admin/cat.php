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
              <a href="<?= base_url('Admin_con/cat_add')?>" class="btn btn-sm btn-primary">Add New</a>
            </div>
          </div>
        </div>
        <?php
        $para = array(
          'where'=>'and status = 1',
          'table'=>'category'
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
                <th scope="col">Category Name</th>
                <th scope="col">Icon </th>
                <th scope="col">Stats </th>
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
                  <?= $data['name']; ?>
                </td>
                <td>
                  <img style="height: 60px;" src="<?= $data['icon']; ?>">
                </td>
                <td>
                  <?php if($data['status'] == 1) { ?>
                    <a class="btn btn-sm btn-success">Active</a>
                  <?php } else { ?>
                    <a class="btn btn-sm btn-danger">Not Active</a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/cat_edit/').$data['slug']; ?>"><i class="ni ni-settings"></i> Edit  </a>
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
