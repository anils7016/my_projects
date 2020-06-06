<form action="<?= site_url('Admin_con/addlisting'); ?>" method="post" enctype="multipart/form-data">
<div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            </div>
            <div class="card-body pt-0 pt-md-4">
			<div class="row">
              <div class="col-sm-12 text-center">
                <div class="ag-img card-profile-image">
                    <?php if(!empty($com->profile)) { $logo = $com->profile; } else { $logo = base_url().'assets/company/company.png';} ?>
                    <img src="<?= $logo; ?>">
                </div>
              </div>
            </div>
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading"><?= $com->mobile; ?></span>
                      <span class="description">Mobile</span>
                    </div>
                  </div>
                </div>
              </div>
              <div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit <?= $com->title; ?></h3>
                </div>
                <div class="col-4 text-right">
                  <button class="btn btn-primary" id="updt_btn" type="submit">Update </button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Company information</h6>
                <div class="pl-lg-4">
				
				<div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Company Name</label>
                    <input class="form-control form-control-alternative" placeholder="Company Name" name="com-name" type="text" required value="<?= $com->title; ?>">
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Owner Name</label>
                    <input class="form-control form-control-alternative" placeholder="Name" name="owner-name" type="text" value="<?= $com->owner; ?>">
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Address</label>
                    <textarea class="form-control form-control-alternative" placeholder="Address" name="add" type="text"><?= $com->address; ?></textarea>
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
                    <label class="form-control-label" for="input-address">Email</label>
                    <input class="form-control form-control-alternative" placeholder="Email" name="e-mail" type="email">
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Latitude</label>
                    <input class="form-control form-control-alternative" step="any" placeholder="23.023970" name="lat" type="number" required value="<?= $com->latitude; ?>">
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Longitude</label>
                    <input class="form-control form-control-alternative" step="any" placeholder="72.562046" name="long" type="number" required value="<?= $com->longitude; ?>">
					<input type="hidden" name="cmp-id" value="<?= $com->cmp_id; ?>">
					<input type="hidden" name="img" value="<?= $com->image; ?>">
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
						<option value="<?= $val['id']; ?>" <?php if(($com->cat_id) == $val['id']) {echo "selected";} ?>><?= $val['name']; ?></option>
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
                <!--div class="pl-lg-4">
                  <div class="form-group focused">
                    <button class="btn btn-primary" type="button">Button</button>
                  </div>
                </div-->
            </div>
          </div>
        </div>
      </div>
          </div>
        </form>