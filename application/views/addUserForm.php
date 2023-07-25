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
          <div class="col-6">
            <div class="card mb-4">
              <div class="card-header">
                <h5 class="mb-0 text-primary text-center fs-4">Add User</h5>
                <p id="s_msg" class="text-center text-success"></p>
                <p id="d_Err" class="text-danger text-center"></p>
              </div>
              <div class="card-body">

                <!-- add user form -->
                <form id="adduserform">
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bxs-user"></i></span>
                      <input type="text" class="form-control" id="basic-icon-default-fullname" name="fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                    </div>
                  </div>
                  <p id="name" class="text-danger"></p>

                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i class="bx bxs-envelope"></i></span>
                      <input type="email" id="basic-icon-default-email" class="form-control" name="email" placeholder="John Doe@xxxx.com" aria-label="john.doe" aria-describedby="basic-icon-default-email2">
                    </div>
                    <div class="form-text">You can use letters, numbers &amp; periods</div>
                  </div>
                  <p id="mail" class="text-danger"></p>

                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-position">Position</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-position" class="input-group-text"><i class='bx bxs-user-badge'></i></span>
                      <input type="text" id="basic-icon-default-position" class="form-control" name="position" placeholder="Senior Editor" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2">
                    </div>
                  </div>
                  <p id="pos" class="text-danger"></p>

                  <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="basic-icon-default-password">Password</label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="basic-icon-default-password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                  <p id="pass" class="text-danger"></p>

                  <button type="submit" class="btn btn-primary">Add</button>
                  <a href="<?php echo base_url('admin/addUser'); ?>" class="btn btn-outline-secondary">Back</a>
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

      $.ajax({
        url: "<?php echo base_url() . "insertData/add_user"; ?>",
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
          $('#adduserform')[0].reset();
        }
      });
    });
  })
</script>