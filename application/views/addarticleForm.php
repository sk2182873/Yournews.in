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

                    <div class="articleForm">
                        <div class="card mb-4 px-5">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 text-primary fs-4">Add Article</h5>
                            </div>
                            <div class="card-body">
                                <p id="success" class="text-success text-center"></p>
                                <p id="dbErr" class="text-danger text-center"></p>
                                <!-- form starts -->
                                <form id="formauthentication" >
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label text-dark" for="basic-icon-default-title">Article Title</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="Atitle" class="form-control" id="basic-icon-default-title" placeholder="" aria-label="" aria-describedby="basic-icon-default-fullname2">
                                            </div>
                                            <p id="title" class="text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label text-dark" for="basic-icon-default-Short-Description">Short Description</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="Sdescp" id="basic-icon-default-Short-Description" class="form-control" placeholder="" aria-label="" aria-describedby="basic-icon-default-company2">
                                            </div>
                                            <p id="sdcp" class="text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label text-dark" for="basic-icon-default-category">Choose Category</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <select name="Category" id="basic-icon-default-category" class="form-control">
                                                    <option value="">--Select--</option>
                                                    <option value="Lifestyle">Lifestyle</option>
                                                    <option value="Technology">Technology</option>
                                                    <option value="Fashion">Fashion</option>
                                                    <option value="Sports">Sports</option>
                                                </select>
                                            </div>
                                            <p id="category" class="text-danger"></p>
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
                                                <input type="file" name="image" id="basic-icon-default-file" size="24000000">
                                            </div>
                                            <p id="Image" class="text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label text-dark" for="basic-icon-default-content">Content</label>
                                        <div class="col-sm-10">
                                            <div class="">
                                                <textarea name="content" id="basic-icon-default-content" cols="30" rows="10" class="form-control" placeholder="Please! type your article here."></textarea>
                                            </div>
                                        </div>
                                        <p id="contentErr" class="text-danger text-center"></p>
                                    </div>

                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="<?php echo base_url('admin/addArticle'); ?>" type="button" class="btn btn-outline-secondary">Back</a>
                                        </div>
                                    </div>
                                </form>
                                <!-- form ends -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--/ Layout Demo -->
        </div>
        <!-- / Content -->
    </div>

    <!-- modal box -->
    <div class="modalClass">
        <div class="modal modal-top fade" id="modalTop" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" id="categoryForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTopTitle">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <p id="success2" class="text-success text-center fs-6"></p>
                    <p id="exist" class="text-warning text-center fs-6"></p>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="titleSlideTop" class="form-label text-primary fs-6">Category Title</label>
                                <input type="text" id="titleSlideTop" class="form-control" name="CatTitle" placeholder="" />
                                <p id="catTitle" class="text-danger fs-6"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="shortdscpslideTop" class="form-label text-primary fs-6">Short Description</label>
                                <input type="text" id="shortdscpslideTop" class="form-control" name="Sdecp" placeholder="" />
                            </div>
                            <p id="sdErr" class="text-danger fs-6"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / modal box -->


    <!-- Footer -->
    <?php include('include/footer.php'); ?>
    <script>
        $(document).ready(function() {

            $('#formauthentication').submit(function(event) {
                event.preventDefault();

                $('#success').html('');
                $('#imgErr').html('');
                $('#title').html('');
                $('#sdcp').html('');
                $('#category').html('');
                $('#contentErr').html('');
                $('#dbErr').html('');
                $('#Image').html('');

                $.ajax({
                    url: "<?php echo base_url('insertData/add_article'); ?>",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(res) {
                        var data = JSON.parse(res);

                        $('#formauthentication')[0].reset();
                        $('#title').html(data['atitle']);
                        $('#sdcp').html(data['sdecp']);
                        $('#category').html(data['categ']);
                        $('#contentErr').html(data['cont']);
                        $('#success').html(data['success']);
                        $('#Image').html(data['imageErr']);

                    }
                });

            });


            $('#categoryForm').submit(function(event) {
                event.preventDefault();

                $('#catTitle').html('');
                $('#sdErr').html('');
                $('#exist').html('');
                $('#success2').html('');


                $.ajax({
                    url: "<?php echo base_url('insertData/insert_category'); ?>",
                    type: "POST",
                    data: $('#categoryForm').serializeArray(),
                    success: function(res) {
                        var data = JSON.parse(res);

                        $('#catTitle').html(data['cate']);
                        $('#sdErr').html(data['Sdecp']);
                        $('#success2').html(data['success']);
                        $('#exist').html(data['exist']);

                        $('#categoryForm')[0].reset();

                    }
                });
            })



        });
    </script>