<form action="<?= site_url('Admin_con/addagency'); ?>" method="post" enctype="multipart/form-data">
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
                <h3 class="mb-0">Add New Agency</h3>
              </div>
              <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Create </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Agency information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Agency Name</label>
                    <input class="form-control form-control-alternative" placeholder="Company Name" name="com-name" type="text" required>
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Owner Name</label>
                    <input class="form-control form-control-alternative" placeholder="Name" name="owner-name" type="text">
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Address</label>
                    <textarea class="form-control form-control-alternative" placeholder="Address" name="add" type="text"></textarea>
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Mobile</label>
                    <input class="form-control form-control-alternative" placeholder="Mobile" name="mobile" type="number" maxlength="10" required>
                  </div>
                </div>
              </div>
			  
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Email</label>
                    <input class="form-control form-control-alternative" placeholder="Email" name="e-mail" type="email">
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-9">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Password</label>
                    <input class="form-control form-control-alternative" placeholder="Password" id="pwd" name="pass" type="password" required>
                  </div>
                </div>
				<div class="col-md-2">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address"></label>
                    <div class="custom-control custom-control-alternative custom-checkbox mb-3 mt-3">
					  <input class="custom-control-input" id="customCheck5" type="checkbox" name="show">
					  <label class="custom-control-label" for="customCheck5">Show</label>
					</div>
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">State</label>
                    <select class="form-control form-control-alternative" name="category" required>
						<option value="">Select Category</option>
						<?php $para = array('table'=>'state','select'=>'s_id,s_name'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
						<option value="<?= $val['s_id']; ?>"><?= $val['s_name']; ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Discount </label>
                    <input class="form-control form-control-alternative" placeholder="Mobile" name="dis" type="number">
                  </div>
                </div>
              </div>
			  <hr class="my-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Agency Logo</label>
                    <input class="form-control form-control-alternative" placeholder="Logo" name="logo" type="file">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
	$("input[name=show]").change(function() {//jQuery("input[name=show]").click(function() {
		var pwdType = jQuery("#pwd").attr("type");
	var newType = (pwdType === "password")?"text":"password";
	jQuery("#pwd").attr("type", newType);
});
</script>