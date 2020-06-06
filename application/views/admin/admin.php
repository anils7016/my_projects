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
              <h3 class="mb-0">Admin Manage</h3>
            </div>
            <div class="col-4 text-right">
              <a href="<?= base_url('Admin_con/add_admin')?>" class="btn btn-sm btn-primary">Add New</a>
            </div>
          </div>
        </div>
        <?php
		$role = $this->session->userdata('is_admin');
			$para = array(
			  'table'=>'admin',
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
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i=1;
              foreach($page as $data) { ?>
              <tr>
                <th scope="row">
                  <?= $i++; ?>
                </th>
                <td>
                  <?= $data['name']; ?>
                </td>
                <td>
                  <?= $data['email']; ?>
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
                  <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/admin_edit/').$data['admin_id']; ?>"><i class="ni ni-settings"></i> Edit </a>
                  <a class="btn btn-sm btn-danger delete_record" href="#" delete_id="<?=$data['admin_id']?>"><i class="ni ni-fat-remove"></i>Delete</a>
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
  $(document).on('click', '.delete_record', function(){  
     var delete_id = $(this).attr("delete_id");  
     var table_name = "admin";
     var field_name = "admin_id";
     if(confirm("Are you sure you want to delete this?"))  
     {  
          $.ajax({  
               url:"<?php echo base_url(); ?>admin_con/delete_single_user",  
               method:"POST",  
               data:{delete_id:delete_id,table_name:table_name,field_name:field_name},  
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