<form action="<?= site_url('Admin_con/addconnectus'); ?>" method="post" enctype="multipart/form-data">
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
                <h3 class="mb-0">Edit Connect us</h3>
              </div>
              <!-- <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Update </button>
              </div> -->
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Connect us information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Office Address</label>
                    <input class="form-control form-control-alternative" placeholder="Office Address" name="office_address" type="text" required value="<?= $com->office_address; ?>">
                    <input type="hidden" name="cmp-id" value="<?= $com->id; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Contact No</label>
                    <input class="form-control form-control-alternative" placeholder="Contact No" name="contact_no" type="number" maxlength="10" required value="<?= $com->contact_no; ?>">
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
                    <label class="form-control-label" for="input-address">WhatsApp No</label>
                    <input class="form-control form-control-alternative" placeholder="WhatsApp No" name="whatsapp_no" type="number" maxlength="10" required value="<?= $com->whatsapp_no; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-address">Email 1</label>
                      <input class="form-control form-control-alternative" placeholder="Email 1" name="email_1" type="email" required="" value="<?= $com->email_1; ?>">
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-address">Email 2</label>
                      <input class="form-control form-control-alternative" placeholder="Email" name="email_2" type="email" value="<?= $com->email_2; ?>">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Website</label>
                    <input class="form-control form-control-alternative" placeholder="Website" name="website" type="text" required value="<?= $com->website; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Location</label>
                    <input class="form-control form-control-alternative" placeholder="Location" name="location" type="text" required value="<?= $com->location; ?>">
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
