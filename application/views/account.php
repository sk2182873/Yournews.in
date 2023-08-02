<?php include('include/header.php'); ?>

<div class="layout-page">
    <!-- Navbar -->

    <?php include('include/navbar2.php'); ?>

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                <div class="button-wrapper">
                                <form id="formAccountSettings">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span  class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" name="profile" hidden="">
                                    </label>

                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-0">

                        <div class="card-body">
                            
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Full Name</label>
                                        <input class="form-control" type="text" id="firstName" name="firstName" value="<?php echo $_SESSION['name'] ?>" autofocus="">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email" value="<?php echo $_SESSION['email'] ?>" placeholder="john.doe@example.com">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="organization" class="form-label">Organization</label>
                                        <input type="text" class="form-control" id="organization" value="aznews">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="language" class="form-label">Position</label>
                                        <input type="text" class="form-control" id="position" value="<?php echo $_SESSION['position']; ?>">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

    </div>
    <!-- Content wrapper -->
</div>

<?php include('include/footer.php') ?>
<script>
    $(document).ready(function(){

        $('#formAccountSettings').submit(function(event){
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url('insertData/update_profile') ?>",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(res){
                    console.log(res);
                }
            });
        })


    })
</script>