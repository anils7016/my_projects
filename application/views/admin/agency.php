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
              <h3 class="mb-0">Agency Manage</h3>
            </div>
            <div class="col-4 text-right">
              <a href="<?= base_url('Admin_con/add_agency')?>" class="btn btn-sm btn-primary">Add New</a>
            </div>
          </div>
        </div>
        <?php
        $para = array(
          'table'=>'agency',
        );
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
                <th scope="col">Agency Name</th>
				<th scope="col">Mobile</th>
                <th scope="col">Email Id</th>
				<th scope="col">Created Date</th>
				<th scope="col">State</th>
				<th scope="col">Commision</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($page as $data) {
                $para = array(
                  'where'=>"and s_id = '".$data['state']."'",
                  'select'=>'s_name',
                  'table'=>'state',
                );
              $state = $this->Admin_model->getdata($para);
              /*$para = array(
                'where'=>"and id = '".$data['agent_id']."'",
                'select'=>'name',
                'table'=>'users',
              );
            $user = $this->Admin_model->getdata($para); */?>
              <tr>
                <th scope="row">
                  <?= $data['a_id']; ?>
                </th>
                <td>
                  <?= $data['a_name']; ?>
                </td>
                <td>
                  <?= $data['a_mobile']; ?>
                </td>
                <td>
                  <?= $data['a_email']; ?>
                </td>
				<td>
                  <?= $data['created_date']; ?>
                </td>
				<td>
                  <?= $state[0]['s_name']; ?>
                </td>
				<td>
                  <?= $data['discount']; ?>
                </td>


                <td>
                  <?php if($data['status'] == 1) { ?>
                    <a class="btn btn-sm btn-success"> Approved </a>
                  <?php } else { ?>
                    <a class="btn btn-sm btn-danger"> Pending </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <!-- <a class="btn btn-sm btn-primary" onclick="deletepage(<s?= $data['cmp_id']; ?>,0)" href="#"><i class="ni ni-check-bold"></i> Active </a>-->
                  <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/agency_edit/').$data['a_id']; ?>"><i class="ni ni-settings"></i> Edit </a>

                <!--div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a><td>
                  <?php //if(!empty($user)) {echo $user[0]['name'];} ?> ( <.?= $data['agent_id']; ?> )
                </td>
			<td>
                  <?php //if(!empty($cat)) {echo $cat[0]['name'];}  ?>
                </td>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" onclick="deletepage(<?= $data['cmp_id']; ?>,1,<?= $data['agent_id']; ?>)"><i class="ni ni-check-bold"></i> Approve </a>
                      <a class="dropdown-item" onclick="deletepage(<?= $data['cmp_id']; ?>,0,<?= $data['agent_id']; ?>)"><i class="ni ni-fat-remove"></i> Disapprove </a>
                      <a class="dropdown-item" href="<?= base_url('Admin_con/listing_edit/').$data['cmp_id']; ?>" ><i class="ni ni-settings"></i> Edit </a>
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
