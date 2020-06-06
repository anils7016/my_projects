<form action="<?= site_url('Admin_con/addlisting'); ?>" method="post" enctype="multipart/form-data">
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
                <h3 class="mb-0">Add New Company</h3>
              </div>
              <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Create </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Category information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Company Name</label>
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
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Latitude</label>
                    <input class="form-control form-control-alternative" step="any" placeholder="23.023970" name="lat" type="number" required>
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Longitude</label>
                    <input class="form-control form-control-alternative" step="any" placeholder="72.562046" name="long" type="number" required>
					<input type="hidden" name="cmp-id" value="0">
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Category</label>
                    <select class="form-control form-control-alternative" name="category" required>
						<option value="">Select Category</option>
						<?php $para = array('table'=>'category','select'=>'id,name','where'=>'and status = 1'); $data = $this->Admin_model->getdata($para); foreach($data as $val) { ?>
						<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
              </div>
			  <hr class="my-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">company Logo</label>
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
