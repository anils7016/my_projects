<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Category</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush datatable">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
					<?php $result = $this->back_model->categorylist();
						foreach($result as $data){
						?>
                  <tr>
                    <th scope="row">
                      <?= $data['name'];?>
                    </th>
                    <td>
                      <img src="<?= $data['icon'];?>" width="30">
                    </td>
                    <td>
                      <?php if($data['status'] == '1'){ echo 'Active';} else{ echo 'Deactivate';}?>
                    </td>
                   
                    
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>Action
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="<?= site_url('backend/edit_category/'.$data['id']);?>">Edit</a>
                          <a class="dropdown-item" href="<?= site_url('backend/delet_category'.$data['id']);?>">Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
						<?php } ?>
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>
    
      
    </div>