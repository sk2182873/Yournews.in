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
                <div class="layout-demo-placeholder col-12">
                    
                <div class="blogForm">
                        <div class="card mb-4 px-5">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 text-primary fs-4">Add Blog</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label text-dark" for="basic-icon-default-title">Blog Title</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="Atitle" class="form-control" id="basic-icon-default-title" placeholder="" aria-label="" aria-describedby="basic-icon-default-fullname2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label text-dark" for="basic-icon-default-Short-Description">Short Description</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="Sdescp" id="basic-icon-default-Short-Description" class="form-control" placeholder="" aria-label="" aria-describedby="basic-icon-default-company2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label text-dark" for="basic-icon-default-category">Choose Category</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <select name="Category" id="basic-icon-default-category" class="form-control">
                                                    <option value="select">--Select--</option>
                                                    <option value="">Lifestyle</option>
                                                    <option value="">Technology</option>
                                                    <option value="">Fashion</option>
                                                    <option value="">Sports</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="w-100 text-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTop">
                                            Add Category
                                        </button>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label text-dark" for="basic-icon-default-file">Upload Image</label>
                                        <div class="col-sm-10">
                                            <div class="text-primary input-group input-group-merge">
                                                <input type="file" name="pictures" id="basic-icon-default-file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label text-dark" for="content">Content</label>
                                        <div class="col-sm-10">
                                            <div class="">
                                                <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="Please! type your article here."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="<?php echo base_url('admin/addBlog'); ?>" type="button" class="btn btn-outline-secondary">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--/ Layout Demo -->
        </div>
        <!-- / Content -->

          <!-- modal box -->
    <div class="modalClass">
        <div class="modal modal-top fade" id="modalTop" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTopTitle">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="titleSlideTop" class="form-label text-primary fs-6">Category Title</label>
                                <input type="text" id="titleSlideTop" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="shortdscpslideTop" class="form-label text-primary fs-6">Short Description</label>
                                <input type="text" id="shortdscpslideTop" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="dateSlideTop" class="form-label text-primary fs-6">Date</label>
                                <input type="date" id="dateSlideTop" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / modal box -->

        <!-- Footer -->
        <?php include('include/footer.php'); ?>