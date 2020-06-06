<form action="<?= site_url('Admin_con/addstudents'); ?>" method="post" enctype="multipart/form-data">
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
                <h3 class="mb-0">Add New Student</h3>
              </div>
              <!--
                <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Create </button>
              </div>
              -->
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Student information</h6>
            <div class="pl-lg-4">
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Full Name</label>
                    <input class="form-control form-control-alternative" placeholder="Full Name" name="full_name" type="text" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Education</label>
                    <select class="form-control form-control-alternative" name="education" required>
          						<option value="">Select Education</option>
          						<!-- <?php $para = array('table'=>'agency','select'=>'a_id,a_name'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
          						<option value="<?= $val['a_id']; ?>"><?= $val['a_name']; ?></option>
          						<?php } ?> -->	
          						<option value="10th">10th</option>
          						<option value="10th">12th</option>
          						<option value="Diploma">Diploma</option>
          						<option value="Bachelor Degree">Bachelor Degree</option>
          						<option value="Master Degree">Master Degree</option>
          						<option value="Other">Other</option>
          					</select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Completion year</label>
                    <select class="form-control form-control-alternative" name="completion_year" required>
						<option value="">Select Completion year</option>
						<?php for($completion_year=1990;$completion_year<=2020;$completion_year++){ ?>
							<option value="<?= $completion_year ?>"><?= $completion_year ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">English test</label>
                    <select class="form-control form-control-alternative" name="english_test" required>
          						<option value="">Select English test</option>
          						<option value="IELTS">IELTS</option>
          						<option value="PTE">PTE</option>
          						<option value="None">None</option>
          						<option value="Other">Other</option>
          					</select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Your Age</label>
                    <select class="form-control form-control-alternative" name="age" required>
						<option value="">Select Your Age</option>
						<?php for($age=17;$age<=35;$age++){ ?>
							<option value="<?= $age ?>"><?= $age ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Associate</label>
                    <select class="form-control form-control-alternative" id="associate" name="associate_id" required >
						<option value="">Select Associate</option>
						<?php $para = array('table'=>'associate_center_details','select'=>'id,associate_name'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
						<option value="<?= $val['id']; ?>"><?= $val['associate_name']; ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
            </div>
			<div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Country</label>
                    <select class="form-control form-control-alternative" id="country" name="country" required >
						<option value="">Select Country</option>
						<?php $para = array('table'=>'countries','select'=>'id,name'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
						<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
            </div>
			<div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">State</label>
                    <select class="form-control form-control-alternative" id="State_dev" name="state" required >
                      <option value="">Select State</option>
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
                      <label class="form-control-label" for="input-address">City</label>
                      <select class="form-control form-control-alternative" name="city" required id="city">
                        <option value="">Select City</option>
                      </select>
                    </div>
                  </div>
              </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Email</label>
                    <input class="form-control form-control-alternative" placeholder="Email" name="email" type="email">
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
                    <label class="form-control-label" for="input-address">WhatsApp No</label>
                    <input class="form-control form-control-alternative" placeholder="WhatsApp No" name="whatsapp_no" type="number" maxlength="10" required>
                  </div>
                </div>
            </div>
			
            </div>

            <div class="row align-items-center">
              <div class="col-4 mt-2 text-left">
                <button class="btn btn-primary" type="submit">Create </button>
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