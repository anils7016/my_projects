<form action="<?= site_url('Admin_con/addexperts'); ?>" method="post" enctype="multipart/form-data">
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
                <h3 class="mb-0">Add New Experts</h3>
              </div>
              <!-- <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Create </button>
              </div> -->
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Experts information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Experts Name</label>
                    <input class="form-control form-control-alternative" placeholder="Experts Name" name="expert_name" type="text" required>
                  </div>
                </div>
              </div>
			        <hr class="my-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Experts Image</label>
                    <input class="form-control form-control-alternative" placeholder="Experts Image" name="image" type="file" required="">
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
