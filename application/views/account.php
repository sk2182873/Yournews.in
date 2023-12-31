<?php include('include/header.php'); ?>

<div class="layout-page">
	<!-- Navbar -->

	<?php include('include/navbar2.php'); ?>

	<!-- / Navbar -->

	<!-- Content wrapper -->
	<div class="content-wrapper">
		<!-- Content -->

		<div class="container-xxl flex-grow-1 container-p-y">
			<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories</span></h4>

			<div class="row">
				<div class="col-md-12">
					<div class="card mb-4">
						<h5 class="card-header">Profile Details</h5>
						<!-- Account -->
						<div class="card-body d-flex justify-content-between">
							<?php if (isset($_SESSION['profilepic'])) { ?>
								<div class="d-flex align-items-start align-items-sm-center gap-4 imageavtar">

									<!-- <img src="" alt="user-avatar" id="image" class="d-block rounded" height="100" width="100" id="uploadedAvatar"> -->
								<?php } else { ?>
									<img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100">
								<?php } ?>
								</div>
								<div class="">
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalScrollable">
										Edit
									</button>
								</div>
						</div>

						<hr class="my-0">

						<div class="card-body">

							<div class="row">
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">Full Name</label>
									<p class="text-primary" id="name"></p>
								</div>
								<div class="mb-3 col-md-6">
									<label for="email" class="form-label">E-mail</label>
									<p class="text-primary" id="mail" data-id="<?php echo $_SESSION['email'] ?>"></p>
								</div>
								<div class="mb-3 col-md-6">
									<label for="phone" class="form-label">Phone</label>
									<p class="text-primary" id="phone"></p>
								</div>
								<div class="mb-3 col-md-6">
									<label for="alteremail" class="form-label">Alternative E-mail</label>
									<p class="text-primary" id="altermail"></p>
								</div>
								<div class="mb-3 col-md-6">
									<label for="organization" class="form-label">Organization</label>
									<p class="text-primary">aznews</p>
								</div>
								<div class="mb-3 col-md-6">
									<label for="position" class="form-label">Position</label>
									<p class="text-primary" id="position"></p>
								</div>
								<div class="mb-3 col-md-6">
									<input type="hidden" id="sessionId" value="<?php if (isset($_SESSION['id'])) {
																					echo $_SESSION['id'];
																				} else {
																					echo $_SESSION['userid'];
																				}
																				?>">
								</div>
							</div>
						</div>
						<!-- /Account -->
					</div>
				</div>
			</div>
		</div>
		<!-- / Content -->

	</div>



	<!-- Modal -->

	<div class="modal fade" id="modalScrollable" tabindex="-1" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">

				<div class="modal-body">

					<form id="updateProfile">
						<div class="modal-header">
							<h5 class="modal-title text-success" id="modalTopTitle">Update Account Details</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<p id="success2" class="text-success text-center fs-6"></p>
						<p id="Err" class="text-danger text-center fs-6"></p>
						<div class="modal-body">
							<div class="row">
								<div class="mb-3 d-flex flex-column">
									<label for="firstName" class="form-label fs-6">Full Name</label>
									<input type="text" class="form-control" id="firstName" value="<?php echo $_SESSION['name'] ?>" disabled>
								</div>
								<div class="mb-3 d-flex flex-column">
									<label for="profile" class="form-label fs-6">Choose Profile</label>
									<input type="file" class="form-control" name="profile" id="profile" >
									<p id="fileErr" class="text-danger"></p>
								</div>
								<div class="mb-3 d-flex flex-column">
									<label for="email" class="form-label fs-6">E-mail</label>
									<input type="text" class="form-control" id="email" value="<?php echo $_SESSION['email'] ?>" disabled>
								</div>
								<div class="mb-3 d-flex flex-column">
									<label for="phone" class="form-label fs-6">Phone</label>
									<input type="text" class="form-control" id="phone" value="<?php echo $_SESSION['phone'] ?>" disabled>
								</div>
								<div class="mb-3 d-flex flex-column">
									<label for="alteremail" class="form-label fs-6">Alternative E-mail</label>
									<input type="text" class="form-control" name='alteremail' id="alteremail" value="<?php echo $_SESSION['alteremail'] ?>">
									<p id="emailErr" class="text-danger"></p>
								</div>
								<div class="mb-3 d-flex flex-column">
									<label for="organization" class="form-label fs-6">Organization</label>
									<input type="text" class="form-control" id="organization" value="aznews" disabled>
								</div>
								<div class="mb-3 d-flex flex-column">
									<label for="position" class="form-label fs-6">Position</label>
									<input type="text" class="form-control" id="position" value="<?php echo $_SESSION['position'] ?>" disabled>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" id="closeBtn" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>

</div>

<?php include('include/footer.php') ?>
<script>
	$(document).ready(function() {

		$('#updateProfile').submit(function(event) {
			event.preventDefault();

			// fetch_admin_data();

			$('#success2').html('');
			$('#Err').html('');
			$('#fileErr').html('');
			$('#emailErr').html('');

			<?php if (isset($_SESSION['id'])) { ?>

				$.ajax({
					url: "<?php echo base_url('common/update_profile') ?>",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success: function(res) {
						var data = JSON.parse(res);
						$('#success2').html(data['success']);
						$('#Err').html(data['dbErr']);
						$('#fileErr').html(data['imageErr']);
						$('#emailErr').html(data['alteremail']);

					}
				});
			<?php } else { ?>

				$.ajax({
					url: "<?php echo base_url('common/update_profile') ?>",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success: function(res) {
						var data = JSON.parse(res);
						$('#success2').html(data['success']);
						$('#Err').html(data['dbErr']);
						$('#fileErr').html(data['imageErr']);
						$('#emailErr').html(data['alteremail']);

					}
				});
			<?php } ?>

		});

		function fetch_admin_data() {

			var usermail = $('#mail').attr('data-id');


			$.ajax({
				url: "<?php echo base_url('Authenticate/fetchAdmin') ?>",
				type: 'post',
				data: {
					mail: usermail
				},
				success: function(res) {
					var userData = JSON.parse(res)

					let imageurl = "<?php echo base_url() ?>" + userData['profilepic'];

					$('#name').html(userData['username']);
					$('#mail').html(userData['mail']);
					$('#phone').html(userData['phone']);
					$('#altermail').html(userData['alternative_email']);
					$('#position').html(userData['position']);
					$('.imageavtar').html(`<img src="${imageurl}" alt="user-avatar" class="d-block rounded" height="100px" width="100px" id="uploadedAvatar">`);
				}
			})
		}

		function fetch_user_data() {
			var usermail = $('#mail').attr('data-id');


			$.ajax({
				url: "<?php echo base_url('Authenticate/fetchUser') ?>",
				type: 'post',
				data: {
					mail: usermail
				},
				success: function(res) {
					var userData = JSON.parse(res)

					let imageurl = "<?php echo base_url() ?>" + userData['profilepic'];

					$('#name').html(userData['username']);
					$('#mail').html(userData['mail']);
					$('#phone').html(userData['phone']);
					$('#altermail').html(userData['alternative_email']);
					$('#position').html(userData['position']);
					$('.imageavtar').html(`<img src="${imageurl}" alt="user-avatar" class="d-block rounded" height="100px" width="100px" id="uploadedAvatar">`);
				}
			})
		}

		<?php if (isset($_SESSION['id'])) { ?>
			fetch_admin_data();
		<?php	} else { ?>
			fetch_user_data();
		<?php } ?>

	})
</script>
