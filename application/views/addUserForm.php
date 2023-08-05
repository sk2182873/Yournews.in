<?php include('include/header.php'); ?>

<!-- Layout container -->
<div class="layout-page">
  <?php include_once('include/navbar2.php'); ?>
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


      <!-- Layout Demo -->
      <div class="layout-demo-wrapper">
        <div class="layout-demo-placeholder col-12 d-flex justify-content-center">
          <div class="col">
            <div class="card mb-4">
              <div class="card-header">
                <h5 class="mb-0 text-primary text-center fs-4">Add User</h5>
                <p id="s_msg" class="text-center text-success"></p>
                <p id="d_Err" class="text-danger text-center"></p>
              </div>
              <div class="card-body">

                <!-- add user form -->
                <form id="adduserform">
                  <div class="row">
                    <div class="col-12 rowwrap d-flex">
                      <div class="col-md-6 ">
                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bxs-user"></i></span>
                          <input type="text" class="form-control" id="basic-icon-default-fullname" name="fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                        </div>
                        <p id="name" class="text-danger"></p>
                      </div>


                      <div class="col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text"><i class="bx bxs-envelope"></i></span>
                          <input type="email" id="basic-icon-default-email" class="form-control" name="email" placeholder="John Doe@xxxx.com" aria-label="john.doe" aria-describedby="basic-icon-default-email2">
                        </div>
                        <p id="mail" class="text-danger"></p>
                      </div>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col mt-3 rowwrap d-flex">
                      <div class="col-md-6">
                        <label class="form-label" for="basic-icon-default-phone">Phone</label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text"><i class='bx bxs-phone'></i></span>
                          <input type="number" id="basic-icon-default-phone" class="form-control" name="phone" placeholder="9985XXXXXX" aria-label="9985XXXXXX" aria-describedby="basic-icon-default-phone2">
                        </div>
                        <p id="phone" class="text-danger"></p>
                      </div>


                      <div class="col-md-6">
                        <label class="form-label" for="basic-icon-default-address">Address</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-address" class="input-group-text"><i class='bx bxs-user-badge'></i></span>
                          <input type="text" id="basic-icon-default-address" class="form-control" name="address" aria-describedby="basic-icon-default-position2">
                        </div>
                        <p id="address" class="text-danger"></p>
                      </div>
                      
                    </div>
                  </div>

                  <div class="row">
                    <div class="col mt-3 rowwrap d-flex">
                      <div class="col-md-6  form-password-toggle">
                        <label class="form-label" for="basic-icon-default-password">Password</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-password" class="input-group-text"><i class='bx bxs-key'></i></span>
                          <input type="password" id="basic-icon-default-password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        <p id="pass" class="text-danger"></p>
                      </div>


                      <div class="col-md-6 ">
                        <label class="form-label" for="basic-icon-default-position">Position</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-position" class="input-group-text"><i class='bx bxs-user-pin'></i></span>
                          <input type="text" id="basic-icon-default-position" class="form-control" name="position" placeholder="Senior Editor" aria-label="ACME Inc." aria-describedby="basic-icon-default-position2">
                        </div>
                        <p id="pos" class="text-danger"></p>
                      </div>
                     
                    </div>
                  </div>

                  <div class="row">
                    <div class="col ps-4">
                      <button type="submit" class="btn btn-primary mt-3">Add</button>
                    </div>
                  </div>
                </form>
                <!-- form end -->
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
<script>
  $(document).ready(function() {
    $('#adduserform').submit(function(e) {
      e.preventDefault();

      $('#name').html('');
      $('#mail').html('');
      $('#pos').html('');
      $('#pass').html('');
      $('#s_msg').html('');
      $('#d_Err').html('');
      $('#phone').html('');
          $('#address').html('');

      $.ajax({
        url: "<?php echo base_url() . "admin/add_user"; ?>",
        type: "POST",
        data: $(this).serializeArray(),
        success: function(res) {
          var data = JSON.parse(res);

          $('#name').html(data['name']);
          $('#mail').html(data['email']);
          $('#pos').html(data['pos']);
          $('#pass').html(data['pass']);
          $('#s_msg').html(data['success']);
          $('#d_Err').html(data['Derror']);
          $('#d_Err').html(data['exist']);
          $('#phone').html(data['phone']);
          $('#address').html(data['address']);
          $('#adduserform')[0].reset();
        }
      });
    });
  })
</script>