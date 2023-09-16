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
<div class="modal fade show " id="basicModal" tabindex="-1" style="display:none" aria-modal="true" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel1">Update Article</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="w-100 messages">
				<p class="text-success text-center" id="success"></p>
				<p class="text-danger text-center" id="Err"></p>
			</div>
			<div class="modal-body">
				<form id="updateArticleForm">
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Article Title</label>
							<input type="text" id="article" name="aTitle" class="form-control" placeholder="Enter Name">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Description</label>
							<input type="text" id="description" name="description" class="form-control" placeholder="Enter Name">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Category</label>
							<select name="category" id="basic-icon-default-category" class="form-control">
								<!-- <option value='' id="option">Select</option> -->
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameBasic" class="form-label">Content</label>
							<textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<input type="hidden" id="hidden" name="articleid" class="form-control">
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
			$('#articleTable').DataTable({

				"processing": true,
				"serverSide": true,


				"ajax": {
					url: "<?php echo base_url('common/fetch_article_data'); ?>",
					type: "post",
					"order": []
				},
				"columnDefs": [{
					"target": [0],
					"orderable": false
				}]

			});
		}

		function fetch_category(text) {

			$.ajax({
				url: "<?php echo base_url('admin/fetch_category_data') ?>",
				type: "POST",
				success: function(res) {
					var category = JSON.parse(res);

					for (let i = 0; i < category['category'].length; i++) {
						$(`#basic-icon-default-category option[value='${category['category'][i]}']`).remove()
					}

					$.each(category['category'], function(n, ele) {
						var str = ele[0].toUpperCase() + ele.slice(1);
						if (ele == text) {
							console.log(text);
							$('#basic-icon-default-category').append("<option value=" + ele + " class='option' selected> " + str + "</option>");
						} else {
							$('#basic-icon-default-category').append("<option value=" + ele + " class='option'>" + str + "</option>");
						}

					});
				}
			})
		}

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
				url: "<?php echo base_url('fetchData/fetch_article'); ?>",
				type: 'post',
				data: {
					artielid: editId
				},
				success: function(res) {
					var data = JSON.parse(res);

					$('#article').val(data[0]['title']);
					$('#date').val(data[0]['date']);
					$('#description').val(data[0]['shortdescription']);
					$('#content').html(data[0]['content']);
					$('#hidden').val(data[0]['id']);
					$('#basic-icon-default-category').append("<option value=" + data[1] + " class='option'>" + data[1] + "</option>");

					fetch_category(data[1]);
				}
			});
		});

		$(document).on('click', '.status', function(e) {
			e.preventDefault();

			let id = $(this).attr('data-id');

			$.ajax({
				url: "<?php echo base_url('common/update_article_status'); ?>",
				type: 'post',
				data: {
					"data": id
				},
				success: function(response) {
					$('#articleTable').DataTable().destroy();
					fetch();
				}

			});


		})

		$('#updateArticleForm').submit(function(e) {
			e.preventDefault();

			setTimeout(function() {
				$('#success').html('');
				$('#Err').html('');

			}, 2000);


			$.ajax({
				url: "<?php echo base_url('common/update_article'); ?>",
				type: 'post',
				data: $(this).serializeArray(),
				success: function(res) {
					var data = JSON.parse(res);

					if (data['success']) {
						$('#success').html(data['success']);
					} else {
						$('.#Err').html(data['Err']);
					}

					$('#articleTable').DataTable().destroy();
					fetch();
				}
			})



		})
		
		fetch();
	})
</script>
