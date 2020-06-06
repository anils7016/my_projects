<form action="<?= site_url('Admin_con/addassociatecenters'); ?>" method="post" enctype="multipart/form-data">
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
                <h3 class="mb-0">Add New Associates Centers</h3>
              </div>
              <!-- <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Create </button>
              </div> -->
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Associates Centers information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Associate Name</label>
                    <input class="form-control form-control-alternative" placeholder="Associate Name" name="associate_name" type="text" required>
                  </div>
                </div>
              </div>
			        <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Company Name</label>
                    <input class="form-control form-control-alternative" placeholder="Company Name" name="company_name" type="text">
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
                    <input class="form-control form-control-alternative" placeholder="Email" name="email" type="email">
                  </div>
                </div>
              </div>
      	      <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">State</label>
                    <select class="form-control form-control-alternative" id="State_dev" name="state" required >
                      <option value="">Select State</option>
                      <?php $para = array('where'=>'and s_desc = 101','table'=>'state','select'=>'s_id,s_name'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
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
                    <label class="form-control-label" for="input-address">Categoty</label>
                    <select class="form-control form-control-alternative" name="associate_category" required>
                      <option value="">Select Categoty</option>
                      <option value="Gold">Gold</option>
                      <option value="Platinum">Platinum</option>
                      <option value="Diamond">Diamond</option>
                    </select>
                  </div>
                </div>
              </div>
			        <!-- <hr class="my-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Associates Image</label>
                    <input class="form-control form-control-alternative" placeholder="Image" name="image" type="file">
                  </div>
                </div>
              </div> -->
              <hr class="my-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Certificate (pdf)</label>
                    <input class="form-control form-control-alternative" placeholder="Certificate" name="certificate" type="file" accept="application/pdf">
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