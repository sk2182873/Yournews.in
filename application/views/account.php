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
                        <form id="formAccountSettings">
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                </div>
                            </div>

                            <hr class="my-0">

                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Full Name</label>
                                        <p class="text-primary">Shiva Kant</p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <p class="text-primary">sk2182873@gmail.com</p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <p class="text-primary">9865365689</p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="alteremail" class="form-label">Alternative E-mail</label>
                                        <p class="text-primary">sd2182863@gmail.com</p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="organization" class="form-label">Organization</label>
                                        <p class="text-primary">aznews</p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="position" class="form-label">Position</label>
                                        <p class="text-primary">Admin</p>
                                    </div>
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
    $(document).ready(function() {

        $('#formAccountSettings').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url('admin/update_profile') ?>",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    var data = JSON.parse(res);
                    console.log(data);

                }
            });
        })




    })
</script>