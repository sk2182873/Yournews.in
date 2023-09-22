<?php include('include/header.php'); ?>

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

					<div class="w-100 text-end">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTop1">
							Add Category
						</button>
					</div>

					<div class="w-100 mb-0 ms-3">
						<h6 class="d-inline text-primary">Category List</h6>
					</div>

					<!-- User table -->
					<div class="userTable col-12 mt-3 ps-2">
						<div class="table table-responsive">
							<table class="table align-middle mb-0 bg-light w-100" id="categoryTable">
								<thead class="bg-dark">
									<tr>
										<th class="text-light">category Title</th>
										<th class="text-light">Create Date</th>
										<th class="text-light">Description</th>
										<th class="text-light">Status</th>
										<th class="text-light">Actions</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
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
		<div class="modal fade show" id="modalTop1" tabindex="-1" style="display: none;">
			<div class="modal-dialog modal-dialog-centered">

				<form class="modal-content" id="categoryForm">
					<div class="modal-header">
						<h5 class="modal-title" id="modalTopTitle">Add Category</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeBtn"></button>
					</div>
					<p id="success2" class="text-success text-center fs-6"></p>
					<p id="exist" class="text-warning text-center fs-6"></p>
					<div class="modal-body">
						<div class="row">
							<div class="col mb-3">
								<label for="titleSlideTop" class="form-label text-primary fs-6">Category Title</label>
								<input type="text" id="titleSlideTop" class="form-control" name="CatTitle" />
								<p id="catTitle" class="text-danger fs-6"></p>
							</div>
						</div>
						<div class="row">
							<div class="col mb-3">
								<label for="shortdscpslideTop" class="form-label text-primary fs-6">Short Description</label>
								<input type="text" id="shortdscpslideTop" class="form-control" name="Sdescp" />
							</div>
							<p id="sdErr" class="text-danger fs-6"></p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="closeBtn2">
							Close
						</button>
						<button type="submit" class="btn btn-primary">Add</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!-- / modal box -->



</div>

<!-- edit modal -->
<div class="modal fade show " id="basicModal" tabindex="-1" style="display:none" aria-modal="true" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel1">Update Category</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="w-100 messages">
				<p class="text-success text-center" id="success"></p>
				<p class="text-danger text-center" id="Err"></p>
			</div>
			<div class="modal-body">
				<form id="updateCategoryForm">
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Category Title</label>
							<input type="text" id="category" name="Ctitle" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Description</label>
							<input type="text" id="description" name="description" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<input type="hidden" value="" id="hidden" name="categoryid" class="form-control">
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

<?php include('include/footer.php') ?>
<script>
	$(document).ready(function() {

		function fetch_category() {
			$('#categoryTable').DataTable({

				'processing': true,
				'serverSide': true,

				'ajax': {
					url: "<?php echo base_url() . 'common/fetch_category_data' ?>",
					type: 'post',
					order: [],
				},
				'columnDefs': [{
					'orderable': false,
				}]
			})
		}

		$('#categoryForm').submit(function(event) {
			event.preventDefault();

			$('#catTitle').html('');
			$('#sdErr').html('');
			$('#exist').html('');
			$('#success2').html('');


			$.ajax({
				url: "<?php echo base_url('common/insert_category'); ?>",
				type: "post",
				data: $('#categoryForm').serializeArray(),
				success: function(res) {
					var data = JSON.parse(res);

					var category = data['data'];

					$('#catTitle').html(data['cate']);
					$('#sdErr').html(data['Sdecp']);
					$('#success2').html(data['success']);
					$('#exist').html(data['exist']);


					$('#categoryForm')[0].reset();


				}
			});

		})

		$('#closeBtn').on('click', function() {
			$('#categoryTable').DataTable().destroy();
			fetch_category();
		});

		$(document).on('click', '.status', function(e) {
			e.preventDefault();

			let id = $(this).attr('data-id');

			$.ajax({
				url: "<?php echo base_url('common/update_category_status'); ?>",
				type: 'post',
				data: {
					"data": id
				},
				success: function(response) {
					$('#categoryTable').DataTable().destroy();
					fetch_category();
				}

			});


		})

		$(document).on("click", "#edt", function(e) {
			e.preventDefault();

			$("#basicModal").modal('show');

			var editId = $(this).attr('value');

			$.ajax({
				url: "<?php echo base_url('common/fetch_category_by_id') ?>",
				type: 'post',
				data: {
					categoryid: editId
				},
				success: function(res) {
					var data = JSON.parse(res);

					$category = data[0]['categorytitle'][0].toUpperCase() + data[0]['categorytitle'].slice(1);

					$('#category').val($category);
					$('#description').val(data[0]['Shortdescp']);
					$('#hidden').val(data[0]['categoryid']);
				}
			});
		});

		$('#updateCategoryForm').submit(function(e) {
			e.preventDefault();

			setTimeout(function() {
				$('#success').html('');
				$('#Err').html('');

			}, 2000);


			$.ajax({
				url: "<?php echo base_url('common/update_category'); ?>",
				type: 'post',
				data: $(this).serializeArray(),
				success: function(res) {
					var data = JSON.parse(res);

					if (data['success']) {
						$('#success').html(data['success']);
					} else {
						$('.#Err').html(data['Err']);
					}

					$('#categoryTable').DataTable().destroy();
					fetch_category();
				}
			})



		})

		// $(document).on("click", "#del", function(e) {
		// 	e.preventDefault();

		// 	var delId = $(this).attr("value");

		// 	Swal.fire({
		// 		title: 'Are you sure?',
		// 		text: "You won't be able to revert this!",
		// 		icon: 'warning',
		// 		showCancelButton: true,
		// 		confirmButtonColor: '#3085d6',
		// 		cancelButtonColor: '#d33',
		// 		confirmButtonText: 'Yes, delete it!'
		// 	}).then((result) => {
		// 		if (result.isConfirmed) {

		// 			$.ajax({
		// 				url: "<?php echo base_url('common/delete_category'); ?>",
		// 				type: "POST",
		// 				data: {
		// 					delId: delId
		// 				},
		// 				success: function(res) {
		// 					var res = JSON.parse(res);

		// 					if (res['success']) {
		// 						$('#categoryTable').DataTable().destroy();
		// 						fetch_category();
		// 						Swal.fire(
		// 							'Deleted!',
		// 							'Your file has been deleted.',
		// 							'success'
		// 						)
		// 					}
		// 				}
		// 			})


		// 		}
		// 	})
		// });


		fetch_category();
	});
</script>
