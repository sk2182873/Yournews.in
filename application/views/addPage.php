<?php include('include/header.php'); ?>

<!-- Layout container -->
<div class="layout-page">

	<?php include_once('include/navbar2.php'); ?>
	<!-- Content wrapper -->
	<div class="content-wrapper">
		<!-- Content -->

		<div class="container-xxl flex-grow-1 container-p-y mt-0">
			<!-- Layout Demo -->
			<div class="layout-demo-wrapper mt-0">
				<div class="layout-demo-placeholder col-12">

					<div class="articleForm">
						<div class="card mb-4 px-5">
							<div class="card-header d-flex align-items-center justify-content-between">
								<h5 class="mb-0 text-primary fs-4">Add Page</h5>
							</div>
							<div class="card-body">
								<p id="success" class="text-success text-center"></p>
								<p id="dbErr" class="text-danger text-center"></p>
								<!-- form starts -->

								<form id="addPage">
									<div class="row mb-3">
										<label class="col-sm-2 col-form-label text-dark" for="basic-icon-default-page-name">Page Name</label>
										<div class="col-sm-10">
											<div class="input-group input-group-merge">
												<input type="text" name="pagename" class="form-control" id="basic-icon-default-page-name" placeholder="">
											</div>
											<p id="p_name" class="text-danger"></p>
										</div>
									</div>
									<div class="row mb-3">
										<label class="col-sm-2 col-form-label text-dark" for="basic-icon-default-Description">Description</label>
										<div class="col-sm-10">
											<div class="input-group input-group-merge">
												<input type="text" name="descp" id="basic-icon-default-Description" class="form-control" placeholder="">
											</div>
											<p id="sdcp" class="text-danger"></p>
										</div>
									</div>

									<div class="row mb-3">
										<label class="col-sm-2 form-label text-dark" for="basic-icon-default-content">Content</label>
										<div class="col-sm-10">
											<div class="">
												<textarea name="content" id="editor" cols="30" rows="7" class="form-control" placeholder="Please! type your article here."></textarea>
											</div>
										</div>
										<p id="contentErr" class="text-danger text-center"></p>
									</div>

									<div class="row justify-content-end">
										<div class="col-sm-10">
											<button type="submit" class="btn btn-primary">Save</button>
											<a href="<?php echo base_url('admin/pages'); ?>" type="button" class="btn btn-outline-secondary">Back</a>
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
</div>

<!-- modal box -->
<div class="modalClass">
	<div class="modal fade" id="modalTop" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
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


<?php include('include/footer.php'); ?>


<script type="text/javascript">
	CKEDITOR.replace('editor');

	CKEDITOR.config.extraPlugins = "font, colorbutton, richcombo, indentblock, indent, lineheight";
	//CKEDITOR.config.lineheight ="0px;1px;1.1px;1.2px;1.3px;1.4px;1.5px" ;
	


	$(document).ready(function() {

		$('#addPage').submit(function(e) {
			e.preventDefault();

			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}

			$('#success').html('');
			$('#dbErr').html('');
			$('#p_name').html('');
			$('#sdcp').html('');
			$('#contentErr').html('');

			$.ajax({
				url: "<?php echo base_url() . 'admin/addPage' ?>",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function(res) {
					var data = JSON.parse(res);

					$('#addPage')[0].reset();
					$('#success').html(data['success']);
					$('#dbErr').html(data['error']);
					$('#p_name').html(data['pagename']);
					$('#sdcp').html(data['descp']);
					$('#contentErr').html(data['content']);
					

				}
				

			});
		})

	})
</script>
