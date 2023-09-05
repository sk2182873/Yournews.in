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
						<a href="<?php echo base_url('admin/addarticle'); ?>" class="btn btn-primary me-5">
							Add Article
						</a>
					</div>

					<div class="w-100 mb-0 ms-3">
						<h6 class="d-inline text-primary">Articles List</h6>
					</div>

					<!-- User table -->
					<div class="userTable col-12 mt-3 ps-2">
						<div class="table table-responsive">
							<table class="table align-middle mb-0 bg-light w-100" id="articleTable">
								<thead class="bg-dark">
									<tr>
										<th class="text-light">Article Title</th>
										<th class="text-light">Article Date</th>
										<th class="text-light">Short Descp</th>
										<th class="text-light">Content</th>
										<th class="text-light">Category</th>
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
</div>

<!-- edit modal -->
<div class="modal fade show" id="basicModal" tabindex="-1" style="display:none" aria-modal="true" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel1">Update Article</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col mb-3">
						<label for="nameBasic" class="form-label">Article Title</label>
						<input type="text" id="nameBasic" class="form-control" placeholder="Enter Name">
					</div>
				</div>
				<div class="row">
					<div class="col mb-3">
						<label for="nameBasic" class="form-label">Date</label>
						<input type="text" id="nameBasic" class="form-control" placeholder="Enter Name">
					</div>
				</div>
				<div class="row">
					<div class="col mb-3">
						<label for="nameBasic" class="form-label">Description</label>
						<input type="text" id="nameBasic" class="form-control" placeholder="Enter Name">
					</div>
				</div>
				<div class="row">
					<div class="col mb-3">
						<label for="nameBasic" class="form-label">Category</label>
						<select name="" id="" class="form-control">
							<option value="">Select</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col mb-3">
						<label for="nameBasic" class="form-label">Content</label>
						<textarea name="" id="" cols="30" rows="10"></textarea>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col mb-3">
					<button type="button" class="btn btn-outline-secondary ms-5" data-bs-dismiss="modal">
						Close
					</button>
					<button type="button" class="btn btn-primary">Update</button>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- Footer -->
<?php include('include/footer.php'); ?>
<script>
	$(document).ready(function() {

		function fetch() {
			$.ajax({
				url: "<?php echo base_url('fetchData/fetch_article_data'); ?>",
				type: "POST",
				success: function(data) {
					var data = JSON.parse(data);

					$('#articleTable').DataTable({

						"data": data.data,
						"responsive": true,
						"columns": [{
								"data": "Title"
							},
							{
								"data": "Date"
							},
							{
								"data": "Sdescp"
							},
							{
								"data": "Content"
							},
							{
								"data": "CTitle"
							},
							{

								"data": "id"
								// render: function(data, type, row, meta) {
								// 	var a = `<a style="cursor:pointer" value="${row.id}" class='badge text-success showbtn' id="swBtn">Show</a>`;
								// 	return a;
								// }
							},
							{
								"data": "id"
								// render: function(data, type, row, meta) {
								// 	var b = `<a  style="cursor:pointer" value="${row.id}" class='badge text-primary' data-bs-toggle="modal" data-bs-target="#basicModal" id="edt"><i class="fas fa-pen fs-6"></i></a> <a style="cursor:pointer" value="${row.id}" id="del" class='badge text-danger'><i class="fas fa-trash fs-5"></i></a>`;
								// 	return b;
								// }
							}
						]
					});

				}

			})
		}

		fetch();

		$(document).on("click", "#del", function(e) {
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
						url: "<?php echo base_url('common/delete_article'); ?>",
						type: "POST",
						data: {
							delId: delId
						},
						success: function(res) {
							var res = JSON.parse(res);
							if (res['success']) {
								$('#articleTable').DataTable().destroy();
								fetch();
								Swal.fire(
									'Deleted!',
									'Your file has been deleted.',
									'success'
								)
							}


						}
					})


				}
			})
		});

		$(document).on("click", "#edt", function(e) {
			e.preventDefault();

			$("#basicModal").modal('show');

			var editId = $(this).attr('value');

			$.ajax({
				url: "<?php echo base_url(''); ?>",
			});
		});

	})
</script>
