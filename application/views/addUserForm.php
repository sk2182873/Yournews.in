<?php include('include/header.php'); ?>

<!-- Layout container -->
<div class="layout-page">
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


            <!-- Layout Demo -->
            <div class="layout-demo-wrapper">
                <div class="layout-demo-placeholder col-12 d-flex justify-content-center">
                <div class="col-6">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0 text-primary fs-4">Add User</h5>
                    
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bxs-user"></i></span>
                            <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-envelope"></i></span>
                            <input type="email" id="basic-icon-default-email" class="form-control" placeholder="John Doe" aria-label="john.doe" aria-describedby="basic-icon-default-email2">
                            <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                          </div>
                          <div class="form-text">You can use letters, numbers &amp; periods</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-company">Position</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bxs-user-badge'></i></span>
                            <input type="text" id="basic-icon-default-company" class="form-control" placeholder="Senior Editor" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2">
                          </div>
                        </div>
                       
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Password</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-phone2" class="input-group-text"><i class='bx bxs-key'></i></span>
                            <input type="password" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="abAb12@&_">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <a href="<?php echo base_url('Views/addUser'); ?>" class="btn btn-outline-secondary">Back</a>
                      </form>
                    </div>
                  </div>
                </div>
                </div>
            </div>
        </div>
    </div>




</div>
</div>
<!--/ Layout Demo -->
</div>
<!-- / Content -->

<!-- Footer -->
<?php include('include/footer.php'); ?>