<form action="<?= site_url('Admin_con/update_user'); ?>" method="post">
  <div class="container-fluid mt--7">
    <div class="row">
       <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
          <div class="card-body pt-0 pt-md-4">
            <div class="row">
              <div class="col-sm-12 text-center">
                <div class="ag-img card-profile-image">
                    <?php if(!empty($com->profile)) { $logo = $com->profile; } else { $logo = base_url().'assets/profile/def-image.png';} ?>
                    <img src="<?= $logo; ?>">
                </div>
              </div>
            </div>
			<?php if((!empty($com->balance)) || (!empty($com->commission))) { ?>
			<div class="row">
              <div class="col-sm-12 text-center">
			  <div class="card-profile-stats d-flex justify-content-center">
                    <?php if(!empty($com->daily_limit)) { ?><div>
                      <span class="heading"><?= $com->balance; ?></span>
                      <span class="description">Agent Balance</span>
                    </div>
					<?php } if(!empty($com->commission)) {?>
					<div>
                    <span class="heading"><?= $com->commission; ?></span>
                    <span class="description">Agent Commission</span>
                  </div>
					<?php } ?>
                  </div>
              </div>
            </div>
			<?php } ?>
			<?php if((!empty($com->daily_limit)) || (!empty($com->discount))) { ?>
			<div class="row">
              <div class="col-sm-12 text-center">
			  <div class="card-profile-stats d-flex justify-content-center">
                    <?php if(!empty($com->daily_limit)) { ?><div>
                      <span class="heading"><?= $com->daily_limit; ?></span>
                      <span class="description">Daily Limit</span>
                    </div>
					<?php } if(!empty($com->daily_limit)) { ?>
					<div>
                      <span class="heading"><?= $com->discount; ?> % </span>
                      <span class="description">Commission</span>
                    </div>
					<?php } ?>
                  </div>
              </div>
            </div>
			<?php } ?>
            <div class="row">
              <div class="col-sm-12 text-center pt-8 pt-md-4 pb-0 pb-md-4">
			  <?php if($com->type == 1) { ?>
                  <a class="btn btn-success"> Agent </a>
                <?php } else if($com->type == 2){ ?>
                  <a class="btn btn-success"> Blocked </a>
                <?php } else if($com->type == 0){ ?>
                  <a class="btn btn-success"> User </a>
                <?php } else { ?>
                  <a class="btn btn-danger"> Pending </a>
                <?php } ?>
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
                <h3 class="mb-0"> Edit User / Agent </h3>
              </div>
              <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Update </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Contact information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address"> Mobile </label>
                    <input class="form-control form-control-alternative" placeholder="Url"  value="<?= $com->mobile; ?>" readonly type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address"> Name </label>
                    <input class="form-control form-control-alternative" placeholder="Url" name="name"  value="<?= $com->name; ?>" type="text">
					<small>Enter In Percentage</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address"> Email </label>
                    <input class="form-control form-control-alternative" placeholder="Url" name="e-mail"  value="<?= $com->email; ?>" type="email">
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address"> Discount </label>
                    <input class="form-control form-control-alternative" placeholder="Url" name="discount"  value="<?= $com->discount; ?>" type="number">
					<input type="hidden" name="com-id" value="<?= $com->id;?>">
                  </div>
                </div>
              </div>
			  <?php $role = $this->session->userdata('is_admin'); if($role == 1) { ?>
			<div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Agency</label>
                    <select class="form-control form-control-alternative" name="agncy" required id="State_dev">
						<option value="">Select Agency</option>
						<?php $para = array('table'=>'agency','select'=>'a_id,a_name'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
						<option value="<?= $val['a_id']; ?>" <?php if(($com->agency_id) == $val['a_id']) {echo "selected";} ?>><?= $val['a_name']; ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Franchise</label>
                    <select class="form-control form-control-alternative" name="frnch" required id="city">
						<option value="">Select Franchise</option>
						<?php $para = array('table'=>'franchise','select'=>'f_id,f_name'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
						<option value="<?= $val['f_id']; ?>" <?php if(($com->franchise_id) == $val['f_id']) {echo "selected";} ?>><?= $val['f_name']; ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
              </div>
			<?php } elseif($role == 3) { $id = $this->session->userdata('frnch_id');
			$para = array('where'=>"and f_id = '$id'",'select'=>'agency_id','table'=>'franchise','return'=>1);$agency = $this->Admin_model->getdata($para)->agency_id; ?>
			<input type="hidden" value="<?= $id; ?>" name="agncy">
			<input type="hidden" value="<?= $agency; ?>" name="frnch">
			<?php } else { $id = $this->session->userdata('agnc_id'); $para = array('where'=>"and agency_id = '$id' and status = 1",'select'=>'f_id,f_name','table'=>'franchise'); $data = $this->Admin_model->getdata($para); ?>
			<input type="hidden" value="<?= $id; ?>" name="agncy">
			<div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Franchise</label>
                    <select class="form-control form-control-alternative" name="frnch" required id="city">
						<option value="">Select Franchise</option>
						<?php foreach($data as $val) { ?>
						<option value="<?= $val['f_id']; ?>"><?= $val['f_name']; ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
              </div>
			<?php } ?>
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
		url: '<?= base_url('admin_con/getfrench'); ?>',
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
</script>
