
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
                        <table class="table align-middle mb-0 bg-light">
                            <thead class="bg-dark ">
                                <tr>
                                    <th class="text-light">Article Title</th>
                                    <th class="text-light">Article Date</th>
                                    <th class="text-light">Short Descp</th>
                                    <th class="text-light">Content</th>
                                    <th class="text-light">Tags</th>
                                    <th class="text-light">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="text-muted">Delhi Floods Update</p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-muted">2023-10-11</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Lorem ipsum dolor sit .......</p>
                                    </td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In cupiditate dolor nulla quisquam. Eveniet est voluptate magnam. Eius rerum aliquid voluptate eaque dolor? Mollitia nulla sapiente sunt dolorum blanditiis molestias.</td>
                                    <td>
                                        <p class="badge bg-info text-dark">Digital Marketing</p>
                                        <p class="badge bg-info text-dark">Information Technology</p>
                                        <p class="badge bg-info text-dark">SEO</p>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-link btn-sm btn-rounded">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="text-muted">Delhi Floods Update</p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-muted">2023-10-11</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Lorem ipsum dolor sit .......</p>
                                    </td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In cupiditate dolor nulla quisquam. Eveniet est voluptate magnam. Eius rerum aliquid voluptate eaque dolor? Mollitia nulla sapiente sunt dolorum blanditiis molestias.</td>
                                    <td>
                                        <p class="badge bg-info text-dark">Digital Marketing</p>
                                        <p class="badge bg-info text-dark">Information Technology</p>
                                        <p class="badge bg-info text-dark">SEO</p>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-link btn-sm btn-rounded">
                                            Edit
                                        </button>
                                    </td>
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


        <!-- Footer -->
<?php include('include/footer.php'); ?>