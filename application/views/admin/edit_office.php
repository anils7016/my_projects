<form action="<?= site_url('Admin_con/addoffice'); ?>" method="post" enctype="multipart/form-data">
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
          <div class="card-body pt-1 pt-md-4">
		        <div class="row">
              <div class="col-sm-12 text-center pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="ag-img card-profile-image">
                    <?php if(!empty($com->image)) { $logo = $com->image; } else { $logo = base_url().'assets/company/company.png';} ?>
                    <img src="<?= $logo; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 text-center">
                <h4 class="mb-0">Is Active</h4>
              </div>
              <div class="col-sm-6 text-center">
                <label class="custom-toggle">
                  <input type="checkbox" name="is-active" value="1" <?php if($com->status =='1') { echo ' checked="checked"'; } ?>>
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
                <h3 class="mb-0">Edit Office</h3>
              </div>
              <!-- <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Update </button>
              </div> -->
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Office information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">City</label>
                    <input class="form-control form-control-alternative" placeholder="City" name="city" type="text" required  value="<?= $com->city; ?>">
                    <input type="hidden" name="cmp-id" value="<?= $com->id; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Office Address</label>
                    <input class="form-control form-control-alternative" placeholder="Office Address" name="office_address" type="text" required  value="<?= $com->office_address; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">State</label>
                    <input class="form-control form-control-alternative" placeholder="state" name="state" type="text" required  value="<?= $com->state; ?>">
                  </div>
                </div>
              </div>

          <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Offce Email</label>
                    <input class="form-control form-control-alternative" placeholder="Office Email" name="office_email" type="email" value="<?= $com->office_email; ?>">
                  </div>
                </div>
            </div>
      <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Office Phone No</label>
                    <input class="form-control form-control-alternative" placeholder="Office Phone No" name="office_phone" type="text" required value="<?= $com->office_phone; ?>">
                  </div>
                </div>
            </div>
             <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Office Head</label>
                    <input class="form-control form-control-alternative" placeholder="Office Head" name="office_head" type="text" required value="<?= $com->office_head; ?>">
                  </div>
                </div>
              </div>
            <?php /*  
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">State</label>
                    <select class="form-control form-control-alternative" name="category" required id="State_dev">
            <option value="">Select State</option>
            <?php $para = array('table'=>'state','select'=>'s_id,s_name'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
            <option value="<?= $val['s_id']; ?>" <?php if(($com->state) == $val['s_id']) {echo "selected";} ?>><?= $val['s_name']; ?></option>
            <?php } ?>
          </select>
                  </div>
                </div>
              </div>
        <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">City</label>
                    <select class="form-control form-control-alternative" name="city" required id="city">
            <option value="">Select City</option>
            <?php $para = array('table'=>'city','select'=>'c_id,c_name','where'=>"and c_state = '".$com->state."'"); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
            <option value="<?= $val['c_id']; ?>" <?php if(($com->city) == $val['c_id']) {echo "selected";} ?>><?= $val['c_name']; ?></option>
            <?php } ?>
          </select>
                  </div>
                </div>
              </div>
              */ ?>
			         
			        
            </div>

            <div class="row align-items-center">
              <div class="col-4 mt-2 text-left">
                <button class="btn btn-primary" type="submit">Update </button>
              </div>
            </div> 
            
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
	$('#State_dev').on('change', function() {
	var sam = $(this).val(); //alert(sam);
	$.ajax({
		url: '<?= base_url('admin_con/getcity'); ?>',
		dataType: "html",
		data: {state:sam},
		type: "POST",
		error: function () {
			alert('An Error Ocurred.');
		},
		success: function (response) {
			$('#city').empty();
			//console.log(response);
			$("#city").append(response);
			// window.location.href='';
		}
	});
	});
	$("input[name=show]").change(function() {//jQuery("input[name=show]").click(function() {
		var pwdType = jQuery("#pwd").attr("type");
	var newType = (pwdType === "password")?"text":"password";
	jQuery("#pwd").attr("type", newType);
});
</script>