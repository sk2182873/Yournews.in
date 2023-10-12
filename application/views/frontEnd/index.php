<main>
	<!-- Trending Area Start -->
	<div class="trending-area fix">
		<div class="container">
			<div class="trending-main">
				<!-- Trending Tittle -->
				<div class="row">
					<div class="col-lg-12">
						<div class="trending-tittle">
							<strong>Trending now</strong>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<!-- Trending Top -->
						<a href="" id="link">
						<div class="trending-top mb-30">
							<div class="trend-top-img">
								<img src="" alt="" class="image" id="image0">
								<div class="trend-top-cap">
									<span id="tag"></span>
									<h2 id="headingtop0"></h2>
								</div>
							</div>
						</div>
						</a>
						<!-- Trending Bottom -->
					</div>
					<!-- Riht content -->
					<div class="col-lg-4" id="leftNews">

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Trending Area End -->

	<!--  Recent Articles start -->
	<div class="recent-articles">
		<div class="container">
			<div class="recent-wrapper">
				<!-- section Tittle -->
				<div class="row ">
					<div class="col-lg-12">
						<div class="section-tittle mb-30">
							<h3>Recent Articles</h3>
						</div>
					</div>
				</div>
				<div class="row article">
					<div class="col-12 ">
						<div class="recent-active responsive d-flex mb-5 dot-style">
							<?php foreach ($data['articles'] as $row) { ?>

								<a class='title' href="<?php echo base_url('category').'/' .$row['categorytitle'] .'/' . $row['url_slug']; ?>">
								<div class="single-recent mb-5 mx-4">
									<div class="articleimage">
										<img src="<?php echo base_url() . $row['imagesurl']; ?>" alt="image not found" width="370px" height="370px" style="border-radius:12px;">
									</div>
									<div class="what-cap">
										<span class="color1"><?php echo $row['categorytitle']; ?></span>
										<h4><?php echo substr($row['title'], 0, 70); ?></h4>
									</div>
								</div>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<section>
			<div class="container offset-md-1" id="searchPanel">
				<div class="row">
					<div class="col-12 search" style="text-align: center;color:#c0392b;">
						
					</div>
				</div>
			</div>
		</section>

		<!--Recent Articles End -->
</main>



<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
	$(window).on('load', function() {

		setTimeout(function() {
			$('#preloader-active').css('display', 'none');
		}, 1000);

		//trending news
		$.ajax({

			url: "<?php echo base_url() . 'frontend/fetch_articles' ?>",
			type: 'post',
			success: function(res) {
				var data = JSON.parse(res);
				var base_url = '<?php echo base_url() ?>';


				$('#image0').attr('src', base_url + data[4]['imagesurl']);
				$('#headingtop0').html(data[4]['title']).css('color', 'white');
				$('#link').attr('href', '<?php echo base_url('category') ?>/'+data[4]['categorytitle']+'/'+ data[4]['url_slug']);
				$('#tag').html(data[4]['categorytitle']);

				$.each(data, function(n, ele) {

					if(ele['article_status'] == 1){
						$('#leftNews').append(`<a class="title" href="<?php echo base_url('category') ?>/${ele['categorytitle']}/${ele['url_slug']}">
						<div class="trand-right-single d-flex article">
                            <div class="trand-right-img">
                                <img src="${base_url+ele['imagesurl']}" alt="image not found" width="100px">
                            </div>
                            <div class="trand-right-cap ">
                                <span class="category">${ele['categorytitle']}</span>
                                <h4>${ele['title']}</h4>
                            </div>
                        </div></a>`);
					}
					



					if (n == 3) {
						return false;
					}

				})

			}

		});
	});

	$(document).ready(function() {
		$('#find').on('keyup', function(event) {

			var search_term = $('#find').val();
			//alert(search_term);

			$.ajax({
				url: "<?php echo base_url() . 'category/search' ?>",
				type: "post",
				data: {
					data: search_term
				},
				success: function(res) {
					var data = JSON.parse(res);

					console.log(data);

					if (data == "") {
						$('.search').empty().append('No data found.');

					} else {
						$('#searchPanel').css('display', 'block');
						$.each(data, function(n, ele) {
							let id = data[n]['id'];
							let slug = data[n]['url_slug'];
							let category = data[n]['categorytitle'];

							$('.search').empty().append(`<div class="mb-2 searchresult">
									<a href="<?php echo base_url() . 'category/${category}/${slug}'; ?>" id="titlelink" style="display:block">
									<h6 style="color: #c0392b;">${data[n]['title']}</h6>
									<p>
										${data[n]['shortdescription']};
									</p>
									</a>
									
								</div>`);
						})
					}

					setTimeout(function() {
						$('#searchPanel').hide();
					}, 7000);

				}


			});
		});

	})
</script>
