<form action="<?= site_url('Admin_con/update_setting'); ?>" method="post" enctype="multipart/form-data">
  <div class="container-fluid mt--7">
    <?php $error = $this->session->flashdata('msg'); if(!empty($error)) { ?>
      <div class="col-xl-12">
        <?= $error; ?>
      </div>
    <?php } $role =  $this->session->userdata('is_admin');
	if($role == 1) {
	$para = array('table'=>'setting');
    $data = $this->Admin_model->getdata($para); 
    ?>
    <div class="row">
      <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Main Admin Setting</h3>
              </div>
			  <?php if(is_array($data)) { ?>
              <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Update </button>
              </div>
			  <?php } ?>
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Setting information</h6>
            <div class="pl-lg-4">
			<?php 
			$i=1;$k=1;$j=1;
			if(is_array($data)) {
			foreach($data as $value) { ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-address"> <?= $value['s_name']; ?> </label>
                      <input class="form-control form-control-alternative" placeholder="Name" name="para[]" type="text" value="<?= $value['s_para']?>">
                      <small> <?= $value['s_desc']; ?> </small>
					  <input type="hidden" name="setting[]" value="<?= $value['s_id']; ?>">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-address"> Edit Description  </label>
                      <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ..." name="desc[]"><?= $value['s_desc']; ?></textarea>
                    </div>
                  </div>
                </div>
			<?php } } else { ?>
				<div class="row">
				<div class="col-md-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-address">No Setting Available For You. </label>
                    </div>
                  </div>
                </div>
				</div>
			<?php }?>
            </div>
          </div>
        </div>
      </div>
	<?php } else { $id =  $this->session->userdata('frnch_id');
		$para = array('table'=>'franchise','where'=>"and f_id = '$id'",'select'=>'f_id,agent_discount');
    $value = $this->Admin_model->getdata($para); ?>
	<div class="row">
      <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Main Admin Setting</h3>
              </div>
			  <?php if(is_array($value)) { ?>
              <div class="col-4 text-right">
                <button class="btn btn-primary" type="submit">Update </button>
              </div>
			  <?php } ?>
            </div>
          </div>
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Setting information</h6>
            <div class="pl-lg-4">
			<?php if(is_array($value)) {//print_r($value); ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-address"> Agent Discount </label>
                      <input class="form-control form-control-alternative" placeholder="Name" name="para" type="text" value="<?= $value[0]['agent_discount']?>">
                      <small> This Discount By Default Apply on every Agent </small>
					  <input type="hidden" name="setting" value="<?= $value[0]['f_id']; ?>">
                    </div>
                  </div>
			<?php } else { ?>
				<div class="row">
				<div class="col-md-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="input-address">No Setting Available For You. </label>
                    </div>
                  </div>
                </div>
				</div>
			<?php }?>
            </div>
          </div>
        </div>
      </div>
	<?php } ?>
    </div>
  </div>
</form>
