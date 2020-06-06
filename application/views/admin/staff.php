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
              <h3 class="mb-0">Staff Manage</h3>
            </div>
            <div class="col-4 text-right">
              <a href="<?= base_url('Admin_con/add_staff')?>" class="btn btn-sm btn-primary">Add New</a>
            </div>
          </div>
        </div>
        <?php
        $para = array(
          'table'=>'staff',
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
                <th scope="col">Member Name</th>
                <th scope="col">Office</th>
                <th scope="col">Designation</th>
                <th scope="col">Mobile</th>
                <th scope="col">WhatsApp No</th>
                <th scope="col">DOB</th>
                <th scope="col">Gender</th>
                <th scope="col">Permenant Address</th>
                <th scope="col">About</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($page as $data) {
                $para = array(
                  'where'=>"and id = '".$data['office_id']."'",
                  'select'=>'office_address',
                  'table'=>'our_offices',
                );
              $office = $this->Admin_model->getdata($para);
              ?>
              <tr>
                <th scope="row">
                  <?= $data['id']; ?>
                </th>
                <td>
                  <?= $data['member_name']; ?>
                </td>
                <td>
                  <?php if(isset($office[0]['office_address'])){ echo $office[0]['office_address']; } ?>
                </td>
                <td>
                <?= $data['designation']; ?>
                </td>
                <td>
                <?= $data['mobile']; ?>
                </td>
                <td>
                <?= $data['whatsapp_no']; ?>
                </td>
                <td>
                <?= $data['date_of_birth']; ?>
                </td>
                <td>
                <?= $data['gender']; ?>
                </td>
                <td>
                <?= $data['permanent_address']; ?>
                </td>
                <td>
                <?= $data['about']; ?>
                </td>
                <td>
                  <image src="<?= $data['image']; ?>" style="border-radius: 50%; height: 55px; width: 55px;" >
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
                  <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/staff_edit/').$data['id']; ?>"><i class="ni ni-settings"></i> Edit </a>
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
<script type="text/javascript">
  $(document).on('click', '.delete_record', function(){  
     var delete_id = $(this).attr("delete_id");  
     var table_name = "staff";
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