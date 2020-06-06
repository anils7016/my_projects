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
              <h3 class="mb-0">Students Profile Manage</h3>
            </div>
            <div class="col-4 text-right">
              <a href="<?= base_url("admin_con/add_students")?>" class="btn btn-sm btn-primary">Add New</a>
                <a href="<?= base_url("admin_con/exportCsvStudents")?>" class="btn btn-sm btn-primary">Export CSV</a>    
            </div>
          </div>
        </div>

        <div class="card-header border-0">
            <form action="<?= site_url('Admin_con/students/'); ?>" method="GET" enctype="multipart/form-data">
              <div class="row align-items-center">
                <div class="col">
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="Start date" type="text" name="start_date" autocomplete="off" required="">
                    </div>
                </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="End date" type="text" name="end_date" autocomplete="off" required="">
                    </div>
                  </div>
                </div>
                <div class="col-4"> <!-- text-right -->
                  <div class="form-group">
                    <input class="btn btn-sm btn-primary" name="filter" type="submit" value="FILTER">
                     <a href="<?= site_url('Admin_con/students/'); ?>" class="btn btn-sm btn-primary">Refresh</a>
                  </div>
                </div>

              </div>
          </form>
        </div>

        <?php
		$role = $this->session->userdata('is_admin');
		if($role == 1) {
			/*$para = array(
			  'table'=>'studednts_profile',
			);*/
		} else {
			$id = $this->session->userdata('agnc_id');
			$para = array(
			'query'=>"SELECT * FROM `studednts_profile` WHERE id = '$id'",
			);
		}
      if(isset($_GET['filter'])){
        if(isset($_GET['start_date'])){
            $start_date = date("Y-m-d",strtotime($_GET['start_date']));
        }
        if(isset($_GET['end_date'])){
            $end_date = date("Y-m-d",strtotime($_GET['end_date']));
        }else{
            $end_date = date("Y-m-d",strtotime($_GET['start_date']));
        }
        $para = array(
            'query'=>"SELECT * FROM `studednts_profile`  WHERE DATE(created_date) BETWEEN '".$start_date."' AND '".$end_date."' ",
            );
      }else{
        $para = array(
              'table'=>'studednts_profile',
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
                <th scope="col">Full Name</th>
                <th scope="col">Education</th>
                <th scope="col">Completion Year</th>
                <th scope="col">English Test</th>
                <th scope="col">Age</th>
                <th scope="col">Associate Name</th>
                <th scope="col">Country</th>
                <th scope="col">State</th>
                <th scope="col">City</th>
                <th scope="col">E-mail</th>
                <th scope="col">Mobile</th>
                <th scope="col">WhatsApp no</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $i=1;
                foreach($page as $data) {
                $para = array(
                  'where'=>"and c_id = '".$data['city']."' ",
                  'select'=>'c_name',
                  'table'=>'city',
                );
               $city = $this->Admin_model->getdata($para);

              $para2 = array(
                  'where'=>"and s_id = '".$data['state']."'",
                  'select'=>'s_name',
                  'table'=>'state',
                );
              $state = $this->Admin_model->getdata($para2);
               $para3 = array(
                  'where'=>"and id = '".$data['country']."'",
                  'select'=>'name',
                  'table'=>'countries',
                );
              $country = $this->Admin_model->getdata($para3);
              $para4 = array(
                  'where'=>"and id = '".$data['associate_id']."'",
                  'select'=>'associate_name',
                  'table'=>'associate_center_details',
                );
              $associate = $this->Admin_model->getdata($para4);
              ?>
              <tr>
                <th scope="row">
                  <?= $i++; ?>
                </th>
                <td>
                  <?= $data['full_name']; ?>
                </td>
                <td>
                  <?= $data['education']; ?>
                </td>
                <td>
                  <?= $data['completion_year']; ?>
                </td>
                <td>
                  <?= $data['english_test']; ?>
                </td>
                <td>
                <?= $data['age']; ?>
                </td>
                <td>
                <?php if(isset($associate[0]['associate_name'])){ echo $associate[0]['associate_name']; } ?>
                </td>
                <td>
                <?php if(isset($country[0]['name'])){ echo $country[0]['name']; } ?>
                </td>
                <td>
                <?php if(isset($state[0]['s_name'])){ echo $state[0]['s_name']; } ?>
                </td>
                <td>
                <?php if(isset($city[0]['c_name'])){ echo $city[0]['c_name']; } ?>
                </td>
                <td>
                <?= $data['email']; ?>
                </td>
                <td>
                <?= $data['mobile']; ?>
                </td>
                <td>
                <?= $data['whatsapp_no']; ?>
                </td>
                <td>
                <?= date("d-m-Y", strtotime($data['created_date'])) ; ?>
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
                  <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/students_edit/').$data['id']; ?>"><i class="ni ni-settings"></i> Edit </a>
                  <a class="btn btn-sm btn-danger delete_record" href="#" delete_id="<?=$data['id']?>"><i class="ni ni-fat-remove"></i>Delete</a>    
                <!--div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a><td>
                  <?php //if(!empty($user)) {echo $user[0]['name'];} ?> ( <.?= $data['agent_id']; ?> )
                </td>
			<td>
                  <?php //if(!empty($cat)) {echo $cat[0]['name'];}  ?>
                </td>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-	arrow">
                      <a class="dropdown-item" onclick="deletepage(<x?= $data['cmp_id']; ?>,1,<x?= $data['agent_id']; ?>)"><i class="ni ni-check-bold"></i> Approve </a>
                      <a class="dropdown-item" onclick="deletepage(<x?= $data['cmp_id']; ?>,0,<x?= $data['agent_id']; ?>)"><i class="ni ni-fat-remove"></i> Disapprove </a>
                      <a class="dropdown-item" href="<x?= base_url('Admin_con/listing_edit/').$data['cmp_id']; ?>" ><i class="ni ni-settings"></i> Edit </a>
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
<script type="text/javascript">
  /*$('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
  });*/
  
$(document).on('click', '.delete_record', function(){  
     var delete_id = $(this).attr("delete_id");  
     var table_name = "studednts_profile";
     if(confirm("Are you sure you want to delete this?"))  
     {  
          $.ajax({  
               url:"<?php echo base_url(); ?>admin_con/delete_single_user",  
               method:"POST",  
               data:{delete_id:delete_id,table_name:table_name},  
               success:function(data)  
               {  
                    //alert(data);  
                    //dataTable.ajax.reload();
                    setInterval('location.reload()', 1000);    
               }  
          });  
     }  
     else  
     {  
          return false;       
     }  
});  
</script>