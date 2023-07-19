<?php include('include/header.php'); ?>

<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->

    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                    <a class="github-button" href="https://github.com/themeselection/sneat-html-admin-template-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">John Doe</span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <span class="d-flex align-items-center align-middle">
                                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                    <span class="flex-grow-1 align-middle">Billing</span>
                                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="auth-login-basic.html">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

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