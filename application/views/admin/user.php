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
              <h3 class="mb-0">Manage Users</h3>
            </div>

          </div>
        </div>
        <?php
        $para = array(
          'where'=>'and type = 0',
          'table'=>'users'
        );
        $page = $this->Admin_model->getdata($para);
        ?>
        <div class="col-xl-12">
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="table_user">
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
                          <!--a class="dropdown-item" onclick="deletepage(<,?= $data['id']; ?>,0)"><i class="ni ni-fat-remove"></i> Make user </a-->
                          <a class="dropdown-item" onclick="deletepage(<?= $data['id']; ?>,1)"><i class="ni ni-check-bold"></i> Make Agent </a>
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
  <div class="row mt-5">
    <div class="col-xl-12">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Manage Blocked Users</h3>
            </div>

          </div>
        </div>
        <?php
        $para = array(
          'where'=> 'and type = 2',
          'table'=>'users'
        );
        $page = $this->Admin_model->getdata($para);
        ?>
        <div class="col-xl-12">
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="table_block">
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
                          <a class="dropdown-item" onclick="deletepage(<?= $data['id']; ?>,1)"><i class="ni ni-check-bold"></i> Make Agent </a>
                          <!--a class="dropdown-item" onclick="deletepage(<,?= $data['id']; ?>,2)"><i class="ni ni-fat-remove"></i> Block </a-->
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
