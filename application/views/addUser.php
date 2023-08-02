<?php include('include/header.php'); ?>

<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->

<?php include('include/navbar2.php'); ?>

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


            <!-- Layout Demo -->
            <div class="layout-demo-wrapper">
                <div class="layout-demo-placeholder col-12 d-flex flex-column justify-content-center  ">

                    <!-- Add User buttons -->
                    <div class="Userbuttons text-end">
                        <a href="<?php echo base_url('admin/addusers'); ?>" class="btn btn-primary me-5">
                            Add User
                        </a>
                    </div>

                    <div class="w-100 mb-0 ms-3">
                        <h6 class="d-inline text-primary">Users List</h6>
                    </div>


                    <!-- user table -->
                    <div class="usertable col-12 mt-3 ps-2">
                        <table class="table align-middle w-100 text-center mb-0" id="mytable">
                            <thead >
                                <tr class="text-center bg-dark"> 
                                    <th class="text-white text-center">Name</th>
                                    <th class="text-white text-center">Email</th>
                                    <th class="text-white text-center">address</th>
                                    <th class="text-white text-center">Phone</th>
                                    <th class="text-white text-center">Position</th>
                                    <th class="text-white text-center">Status</th>
                                    <th class="text-white text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr>
                                    <td class="fw-bold mb-1">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                              
                            </tbody>
                        </table>
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
    $(document).ready(function(){
        $('#mytable').DataTable({

            "ajax": "<?php echo base_url('admin/fetch_user_data') ?>",
            "order":[],
        });
    })
</script>