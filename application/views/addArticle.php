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
                <div class="layout-demo-placeholder col-12 d-flex flex-column align-items-start">

                    <div class="articleButtons w-100 text-end">
                        <a href="<?php echo base_url('admin/articleForm'); ?>" class="btn btn-primary me-5">
                            Add Article
                        </a>
                    </div>

                    <div class="w-100 mb-0 ms-3">
                        <h6 class="d-inline text-primary">Articles List</h6>
                    </div>

                    <!-- User table -->
                    <div class="userTable col-12 mt-3 ps-2">
                        <table class="table align-middle mb-0 bg-light w-100" id="articleTable">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-light">Article Title</th>
                                    <th class="text-light">Article Date</th>
                                    <th class="text-light">Short Descp</th>
                                    <th class="text-light">Content</th>
                                    <th class="text-light">Category</th>
                                    <th class="text-light">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-black">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!--/ Layout Demo -->
        </div>
        <!-- / Content -->

    </div>
</div>

<!-- Footer -->
<?php include('include/footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#articleTable').DataTable({

            "ajax": "<?php echo base_url('fetchData/fetch_article_data') ?>",
            "order": [],
        });

    })
</script>