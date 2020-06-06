<form action="<?= site_url('Admin_con/addstaff'); ?>" method="post" enctype="multipart/form-data">
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
          <div class="card-body pt-1 pt-md-4">
		        <div class="row">
              <div class="col-sm-12 text-center pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="ag-img card-profile-image">
                    <?php if(!empty($com->image)) { $image = $com->image; } else { $image = base_url().'assets/staff/associates.png';} ?>
                    <img src="<?= $image; ?>">
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
                <h3 class="mb-0">Edit Staff</h3>
              </div>
              <!--
                <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Update </button>
              </div>
              -->
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Staff information</h6>
            <div class="pl-lg-4">
			        <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Office</label>
                    <select class="form-control form-control-alternative" name="office_id" required>
                      <option value="">Select Office</option>
                      <?php $para = array('table'=>'our_offices','select'=>'id,office_address'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
                      <option value="<?= $val['id']; ?>" <?php if(($com->office_id) == $val['id']) {echo "selected";} ?>><?= $val['office_address']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Member Name</label>
                    <input class="form-control form-control-alternative" placeholder="Member Name" name="member_name" type="text" required value="<?= $com->member_name; ?>">
                <input type="hidden" name="cmp-id" value="<?= $com->id; ?>">
                <input type="hidden" name="img" value="<?= $com->image; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Designation</label>
                    <select class="form-control form-control-alternative" name="designation" required>
                      <option value="">Select Designation</option>
                      <option value="Office staff" <?php if(($com->designation) == "Office staff") {echo "selected";} ?>>Office staff</option>
                      <option value="Associate" <?php if(($com->designation) == "Associate") {echo "selected";} ?>>Associate</option>
                      <option value="Other" <?php if(($com->designation) == "Other") {echo "selected";} ?>>Other</option>
                    </select>
                  </div>
                </div>
              </div>
             <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Mobile</label>
                    <input class="form-control form-control-alternative" placeholder="Mobile" name="mobile" type="number" maxlength="10" required value="<?= $com->mobile; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Whatsapp No</label>
                    <input class="form-control form-control-alternative" placeholder="Whatsapp No" name="whatsapp_no" type="number" value="<?= $com->whatsapp_no; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Date Of Birth</label>
                    <input class="form-control form-control-alternative datepicker" autocomplete="off" placeholder="Date Of Birth" name="date_of_birth" type="text" required value="<?php echo date("d-m-Y",strtotime($com->date_of_birth));  ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Gender</label>
                    <select class="form-control form-control-alternative" name="gender" required>
                      <option value="">Select Gender</option>
                      <option value="Male" <?php if(($com->gender) == "Male"){echo "selected";} ?>>Male</option>
                      <option value="Female" <?php if(($com->gender) == "Female"){echo "selected";} ?>>Female</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Permanent Address</label>
                    <input class="form-control form-control-alternative" placeholder="Permanent Address" name="permanent_address" type="text" required value="<?= $com->permanent_address; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">About</label>
                    <textarea class="form-control form-control-alternative" name="about"><?= $com->about; ?></textarea>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Photo</label>
                    <input class="form-control form-control-alternative" placeholder="Image" name="image" type="file">
                  </div>
                </div>
              </div>

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

/*  $('.datepicker').datepicker({
    format: 'd-m-yy',
  });*/

</script>