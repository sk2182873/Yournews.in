<?php include('include/header.php'); ?>
<!-- Layout container -->
<div class="layout-page">
	<!-- Navbar -->

	<?php include_once('include/navbar2.php'); ?>

	<!-- / Navbar -->

	<!-- Content wrapper -->
	<div class="content-wrapper">
		<!-- Content -->

		<div class="container-xxl flex-grow-1 container-p-y">
			<div class="row">
				<div class="col-lg-12 mb-4 order-0">
					<div class="card">
						<div class="d-flex align-items-end row">
							<div class="col-sm-7">
								<div class="card-body">
									<h5 class="card-title text-primary">Welcome <?php echo $_SESSION['name']; ?>! 🎉</h5>
									<p class="mb-4">
										This is your dashboard. You have everything on this panel.
									</p>
								</div>
							</div>
							<div class="col-sm-5 text-center text-sm-left">
								<div class="card-body pb-0 px-0 px-md-4">
									<img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-12 col-md-4 order-1">
					<div class="row">
						<div class="col-lg-6 col-md-12 col-6 mb-4">
							<div class="card">
								<div class="card-body">
									<div class="card-title d-flex align-items-start justify-content-between">
										<div class="avatar flex-shrink-0">
											<img src="../assets/img/icon/article.png" width="5px" height="5px" alt="chart success" class="rounded" />
										</div>
									</div>
									<span class="fw-semibold d-block mb-1">Artilces</span>
									<h3 class="card-title mb-2" id="articlenum"></h3>

								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-6 mb-4">
							<div class="card">
								<div class="card-body">
									<div class="card-title d-flex align-items-start justify-content-between">
										<div class="avatar flex-shrink-0">
											<img src="../assets/img/icon/category.png" width="5px" height="5px" alt="Credit Card" class="rounded" />
										</div>
									</div>
									<span class="fw-semibold d-block mb-1">Categories</span>
									<h3 class="card-title text-nowrap mb-1" id="categorynum">$4,679</h3>

								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-6 mb-4">
							<div class="card">
								<div class="card-body">
									<div class="card-title d-flex align-items-start justify-content-between">
										<div class="avatar flex-shrink-0">
											<img src="../assets/img/icon/content.png" alt="page-icon" width="5px" height="5px" />
										</div>
									</div>
									<span class="fw-semibold d-block mb-1">Pages</span>
									<h3 class="card-title text-nowrap mb-2" id="pagenum"></h3>

								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-6 mb-4">
							<div class="card">
								<div class="card-body">
									<div class="card-title d-flex align-items-start justify-content-between">
										<div class="avatar flex-shrink-0">
											<img src="../assets/img/icon/users.png" width="5px" height="5px" alt="Credit Card" class="rounded" />
										</div>
									</div>
									<span class="fw-semibold d-block mb-1">Users</span>
									<h3 class="card-title mb-2" id="usernum"></h3>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- / Content -->



		<?php include('include/footer.php'); ?>

		<script type="text/javascript">

			function fetch_total_articles() {
				$.ajax({
					url: "<?php echo base_url('admin/fetch_article_data'); ?>",
					type: "post",
					success: function(res) {
						$('#articlenum').html(res);
					}
				});
			}

			function fetch_total_category() {
				$.ajax({
					url: "<?php echo base_url('admin/fetch_category_data'); ?>",
					type: "post",
					success: function(res) {
						var data = JSON.parse(res);
						$('#categorynum').html(data['total']);

					}
				});
			}

			function fetch_total_page() {
				$.ajax({
					url: "<?php echo base_url('admin/total_page'); ?>",
					type: "post",
					success: function(res) {
						$('#pagenum').html(res);

					}
				});
			}

			function fetch_total_user() {
				$.ajax({
					url: "<?php echo base_url('admin/total_user'); ?>",
					type: "post",
					success: function(res) {
						$('#usernum').html(res);

					}
				});
			}

			fetch_total_articles();
			fetch_total_category();
			fetch_total_page();
			fetch_total_user();
		</script>
