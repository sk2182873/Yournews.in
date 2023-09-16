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
							<thead>
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

<!-- user list edit model -->
<div class="modal fade show" id="basicModal" tabindex="-1" aria-modal="true" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel1">Update User</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="w-100 messages">
				<p class="text-success text-center" id="success"></p>
				<p class="text-danger text-center" id="Err"></p>
			</div>
			<div class="modal-body">
				<form id="updateUserForm">
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Fullname</label>
							<input type="text" id="name" name="username" class="form-control" placeholder="Enter Name">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Email</label>
							<input type="email" id="mail" name="email" class="form-control" placeholder="Enter Email">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Address</label>
							<input type="text" id="address" name="address" class="form-control" placeholder="Enter Address">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Phone</label>
							<input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Phone">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Position</label>
							<input type="text" id="position" name="position" class="form-control" placeholder="Enter Position">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<input type="hidden" id="userid" name="userid" class="form-control" placeholder="Enter Position">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<button type="button" class="btn btn-outline-secondary ms-5" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-primary">Update</button>
						</div>

					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<!-- Footer -->
<?php include('include/footer.php'); ?>
<script>
	$(document).ready(function() {

		function fetch() {
			$('#mytable').DataTable({
				"processing": true,
				"serverSide": true,

				"ajax": {
					url: "<?php echo base_url('admin/fetch_user_data') ?>",
					type: "post",
					"order": []
				},
				"columDefs": {
					"orderable": false
				}
			});
		}

		//change status of user.
		$(document).on('click', '.status', function(e) {
			e.preventDefault();

			let id = $(this).attr('data-id');

			$.ajax({
				url: "<?php echo base_url('common/update_user_status'); ?>",
				type: 'post',
				data: {
					"data": id
				},
				success: function(response) {
					$('#mytable').DataTable().destroy();
					fetch();
				}

			});


		})

		//fetch user details.
		$(document).on("click", "#edt", function(e) {
			e.preventDefault();

			$("#basicModal").modal('show');

			var editId = $(this).attr('value');

			$.ajax({
				url: "<?php echo base_url('fetchData/fetch_users'); ?>",
				type: 'post',
				data: {
					'id': editId
				},
				success: function(res) {
					var data = JSON.parse(res);

					$('#name').val(data[0]['username']);
					$('#mail').val(data[0]['email']);
					$('#address').val(data[0]['address']);
					$('#phone').val(data[0]['phone']);
					$('#position').val(data[0]['position']);
					$('#userid').val(data[0]['userid']);
				}
			});
		});

		//Update user details. 
		$('#updateUserForm').submit(function(e) {
			e.preventDefault();

			setTimeout(function(){
				$('#success').html('');
				$('#Err').html('');

			}, 2000);

			$.ajax({
				url: "<?php echo base_url('admin/update_user'); ?>",
				type: 'post',
				data: $('#updateUserForm').serialize(),
				success: function(res) {

					var data = JSON.parse(res);

					if(data['success']){
						$('#success').html(data['success']);
					}else{
						$('.#Err').html(data['Err']);
					}

					$('#mytable').DataTable().destroy();
					fetch();
					
				}
			})
		})

		$(document).on('click', '#del', function(e) {
			e.preventDefault();

			var delId = $(this).attr("value");

			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {

					$.ajax({
						url: "<?php echo base_url('admin/delete_user'); ?>",
						type: "post",
						data: {
							delId: delId
						},
						success: function(res) {
							var res = JSON.parse(res);
							

							if (res['success']) {
								if (res['success']) {
									$('#mytable').DataTable().destroy();
									Swal.fire(
										'Deleted!',
										'Your file has been deleted.',
										'success'
									)
									fetch();
								}
							}
						}
					})
				}
			})
		});

		fetch();

	})
</script>
