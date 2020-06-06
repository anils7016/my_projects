<form action="<?= site_url('Admin_con/addcurrency'); ?>" method="post"  enctype="multipart/form-data">
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
		<div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <?php  $img =  base_url()."assets/front/img/trofy.png";  ?>
                    <img src="<?= $img; ?>">
                  </a>
                </div>
              </div>
            </div>
          <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          </div>
          <div class="card-body pt-0 pt-md-4">
            <div class="row">
              <div class="col-sm-6 text-center">
                <h4 class="mb-0">Is Active</h4>
              </div>
              <div class="col-sm-6 text-center">
                <label class="custom-toggle">
                  <input type="checkbox" name="is-active" value="1" >
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
                <h3 class="mb-0">Edit  <?= $com->c_name; ?></h3>
              </div>
              <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Update </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Currency information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Currency Name</label>
                    <input class="form-control form-control-alternative" placeholder="Currency Name" name="page-name" type="text">
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <!-- Description -->
			<hr class="my-4">
			<div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">logo</label>
                    <input class="form-control form-control-alternative" name="curency" type="file">
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>