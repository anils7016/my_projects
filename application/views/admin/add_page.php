<form action="<?= site_url('Admin_con/addcmspages'); ?>" method="post">
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
          <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          </div>
          <div class="card-body pt-0 pt-md-4">
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
                <h3 class="mb-0">Add New Page</h3>
              </div>
              <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Create </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Page information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Page Name</label>
                    <input class="form-control form-control-alternative" placeholder="Name" name="page-name" type="text">
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <!-- Description -->
            <h6 class="heading-small text-muted mb-4">Description</h6>
            <div class="pl-lg-4">
              <div class="form-group focused">
                <textarea rows="4" name="lng-desc" id="editor1" class="form-control form-control-alternative" placeholder="A few words about Page ..."></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
ClassicEditor
.create( document.querySelector( '#editor1' ) )
.then( editor => {
  console.log( editor );
} )
.catch( error => {
  console.error( error );
} );
</script>
