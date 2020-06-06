<form action="<?= site_url('Admin_con/addstaff'); ?>" method="post" enctype="multipart/form-data">
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
                <h3 class="mb-0">Add New Staff</h3>
              </div>
              <!--
              <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Create </button>
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
                      <option value="<?= $val['id']; ?>"><?= $val['office_address']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Member Name</label>
                    <input class="form-control form-control-alternative" placeholder="Member Name" name="member_name" type="text" required>
                  </div>
                </div>
              </div>
			        <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Designation</label>
                    <select class="form-control form-control-alternative" name="designation" required>
                      <option value="">Select Designation</option>
                      <option value="Office staff">Office staff</option>
                      <option value="Associate">Associate</option>
                      <option value="Other">Other</option>
                    </select>
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
                    <label class="form-control-label" for="input-address">Whatsapp No</label>
                    <input class="form-control form-control-alternative" placeholder="Whatsapp No" name="whatsapp_no" type="number">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Date Of Birth</label>
                    <input class="form-control form-control-alternative datepicker" autocomplete="off" placeholder="Date Of Birth" name="date_of_birth" type="text" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Gender</label>
                    <select class="form-control form-control-alternative" name="gender" required>
                      <option value="">Select Designation</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Permanent Address</label>
                    <input class="form-control form-control-alternative" placeholder="Permanent Address" name="permanent_address" type="text" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">About</label>
                    <textarea class="form-control form-control-alternative" name="about"></textarea>
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
                <button class="btn btn-primary" type="submit">Create </button>
              </div>
            </div>  

          </div>
        </div>
      </div>
    </div>
  </div>
</form>
