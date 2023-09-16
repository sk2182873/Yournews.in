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
						<a href="<?php echo base_url('admin/addpage'); ?>" class="btn btn-primary me-5">
							Add Page
						</a>
					</div>

					<div class="w-100 mb-0 ms-3">
						<h6 class="d-inline text-primary">Pages List</h6>
					</div>

					<!-- User table -->
					<div class="userTable col-12 mt-3 ps-2">
						<div class="table table-responsive">
							<table class="table align-middle mb-0 bg-light w-100" id="pageTable">
								<thead class="bg-dark">
									<tr>
										<th class="text-light">Page Title</th>
										<th class="text-light">Create Date</th>
										<th class="text-light">Description</th>
										<th class="text-light">Content</th>
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
				<h5 class="modal-title" id="exampleModalLabel1">Update Page</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="w-100 messages">
				<p class="text-success text-center" id="success"></p>
				<p class="text-danger text-center" id="Err"></p>
			</div>
			<div class="modal-body">
				<form id="updatePageForm" >
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Page Title</label>
							<input type="text" id="pagename" name='pTitle' class="form-control" placeholder="Enter Name">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Description</label>
							<input type="text" id="description" name='Descp' class="form-control" placeholder="Enter Name">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Content</label>
							<textarea id="content" cols="30" rows="10" name='content' class="form-control"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<input type="hidden" id="pageid" name='pageid' class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3 d-flex justify-content-end">
							<button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
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


<?php include('include/footer.php'); ?>
<script>
	$(document).ready(function() {

		function fetch_page() {

			$('#pageTable').DataTable({

				"processing": true,
				"serverSide": true,

				"ajax": {
					url: "<?php echo base_url('admin/fetch_pages'); ?>",
					type: "POST",
					"order": []
				},

				"columnDefs": [{
					"orderable": false
				}]

			});

		}

		

		//change status of user.
		$(document).on('click', '.status', function(e) {
			e.preventDefault();

			let id = $(this).attr('data-id');

			$.ajax({
				url: "<?php echo base_url('admin/update_page_status'); ?>",
				type: 'post',
				data: {
					"data": id
				},
				success: function(response) {
					$('#pageTable').DataTable().destroy();
					fetch_page();
				}

			})
		});

		//fetch user details.
		$(document).on("click", "#edt", function(e) {
			e.preventDefault();

			$("#basicModal").modal('show');

			var editId = $(this).attr('value');

			$.ajax({
				url: "<?php echo base_url('fetchData/fetch_pages'); ?>",
				type: 'post',
				data: {
					'id': editId
				},
				success: function(res) {
					var data = JSON.parse(res);

					$('#pagename').val(data[0]['page_name']);
					$('#description').val(data[0]['description']);
					$('#content').val(data[0]['content']);
					$('#pageid').val(data[0]['p_id']);


				}
			});
		});

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
						url: "<?php echo base_url('admin/delete_page'); ?>",
						type: "post",
						data: {
							delId: delId
						},
						success: function(res) {
							var res = JSON.parse(res);


							if (res['success']) {
								if (res['success']) {
									$('#pageTable').DataTable().destroy();
									Swal.fire(
										'Deleted!',
										'Your file has been deleted.',
										'success'
									)
									fetch_page();
								}
							}

						}
					})
				}
			})
		});

		$('#updatePageForm').submit(function(e) {
			e.preventDefault();

			setTimeout(function(){
				$('#success').html('');
				$('#Err').html('');

			}, 2000);
			

			$.ajax({
				url: "<?php echo base_url('admin/update_page'); ?>",
				type: 'post',
				data: $('#updatePageForm').serializeArray(),
				success: function(res) {
					var data = JSON.parse(res);

					if(data['success']){
						$('#success').html(data['success']);
					}else{
						$('.#Err').html(data['Err']);
					}

					$('#pageTable').DataTable().destroy();
					fetch_page();
				}
			})
		})

		fetch_page();
	});
</script>
