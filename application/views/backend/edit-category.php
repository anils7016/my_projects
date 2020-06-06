<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
	<?php if(!empty($data)){?>
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Edit Category</h3>
            </div>
				<form method="post" action="<?= site_url('backend/update_category');?>" enctype="multipart/form-data" style="margin-bottom:50px;">
				  <div class="row">  
					<div class="col-md-6">
					  <div class="form-group">
						<input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title" value="<?= $data->name;?>">
						<input type="hidden" name="id" value="<?= $data->id;?>">
					  </div>
					</div>
					<div class="col-md-6">
					  <div class="form-group">
						<img src="<?= $data->icon;?>" width="100" style="float:left;"/><input type="file" class="form-control" name="upload" style="width:auto">
						<input type="hidden" name="hid_upload" value="<?= $data->icon;?>">
					  </div>
					</div>
				  </div>
				  <div class="row">
					<div class="col-md-6">
					  <div class="form-group">
						<div class="input-group mb-4">
						  <label class="custom-toggle">
							  <input type="checkbox" name="status" value="1" <?php if($data->status == '1'){ echo 'checked';}?>>
							  <span class="custom-toggle-slider rounded-circle"></span> 
							</label>
							Status
						</div>
					  </div>
					</div>
					
				  </div>
				  
				  <input type="submit" class="btn btn-primary" value="Update">
				</form>
			</div>
		</div>
	</div>
	<?php } ?>
</div>	