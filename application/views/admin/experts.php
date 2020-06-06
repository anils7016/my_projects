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
              <h3 class="mb-0">Expert Manage</h3>
            </div>
            <div class="col-4 text-right">
              <a href="<?= base_url('Admin_con/add_experts')?>" class="btn btn-sm btn-primary">Add New</a>
              <a href="<?= base_url("admin_con/exportCsvExperts")?>" class="btn btn-sm btn-primary">Export CSV</a>
            </div>
          </div>
        </div>
        <?php
        $para = array(
          'table'=>'experts',
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
                <th scope="col">Expert Name</th>
                <th scope="col">Expert Image</th>
                <th scope="col">Status</th>
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
                  <?= $data['expert_name']; ?>
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
                  <a class="btn btn-sm btn-primary" href="<?= base_url('Admin_con/experts_edit/').$data['id']; ?>"><i class="ni ni-settings"></i> Edit </a>
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
     var table_name = "experts";
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