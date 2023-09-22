<?php // include('header2.php'); 
?>

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
						<div class="trending-top mb-30">
							<div class="trend-top-img">
								<img src="" alt="" class="image" id="image0">
								<div class="trend-top-cap">
									<span id="tag"></span>
									<h2><a href="" id="headingtop0"></a></h2>
								</div>
							</div>
						</div>
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
				<div class="row">
					<div class="col-lg-12">
						<div class="section-tittle mb-30">
							<h3>Recent Articles</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="recent-active dot-style d-flex dot-style">


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Recent Articles End -->
	<section>
		<div class="container offset-md-1" id="searchPanel">
			<div class="row">
				<div class="col-12 search">

				</div>
			</div>
		</div>
	</section>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
	$(document).ready(function() {

		var category = "<?php echo $data['page']; ?>";		

		let index = -1;

		//trending news
		function fetch_trending_news() {
			$.ajax({
				url: `<?php echo base_url() . 'fetchData/fetch_articles_by_category/${category}' ?>`,
				type: 'post',
				success: function(res) {
					var data = JSON.parse(res);
					var base_url = '<?php echo base_url() ?>';

					console.log(data);
					const length = data.length;

					$.each(data, function(n, ele) {

						if (length - n == 1) {
							console.log("n : ", n);
							return false;
						} else {
							if (n < 4) {
								$('#leftNews').append(`<div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="${base_url+ele['imagesurl']}" alt="image not found" width="100px">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color1">${ele['categorytitle']}</span>
                                <h4><a href="<?php echo base_url() ?>article/${ele['id']}/${ele['url_slug']}">${ele['title']}</a></h4>
                            </div>
                        </div>`);
								index++;
							} else {

								return false;
							}

						}
					})

					$('#image0').attr('src', base_url + data[index + 1]['imagesurl']);
					$('#headingtop0').html(data[index + 1]['title']);
					$('#headingtop0').attr('href', "<?php echo base_url() ?>article" + '/' + data[index + 1]['id'] + '/' + data[index]['url_slug']);
					$('#tag').html(data[index + 1]['categorytitle']);

				}

			});
		}

		//recent news
		function fetch_recents_news() {
			$.ajax({
				url: `<?php echo base_url() . 'fetchData/fetch_recent_articles_by_category/${category}' ?>`,
				type: 'POST',
				success: function(res) {
					var data = JSON.parse(res);
					var base_url = '<?php echo base_url() ?>';

					$.each(data, function(n, ele) {
						$('.recent-active').append(`<div class="single-recent mb-100">
                                <div class="what-img">
                                    <img src="${base_url+ele['imagesurl']}" alt="image not found" width="400px" height="300px"> 
                                </div>
                                <div class="what-cap">
                                    <span class="color1">${ele['categorytitle']}</span>
                                    <h4><a class='title' href="<?php echo base_url() ?>article/${ele['id']}/${ele['url_slug']}">${ele['title']}</a></h4>
                                </div>
                            </div>`);
					});

				}
			});
		}

		function fetch_category() {
			$.ajax({
				url: '<?php echo base_url() . 'frontend/fetch_category' ?>',
				type: 'POST',
				success: function(res) {
					var data = JSON.parse(res);
					var base_url = "<?php echo base_url(); ?>"

					$.each(data, function(n, ele) {

						if (n < 7) {
							$('#navigation').append(`<li><a href="${base_url}category/${ele['categorytitle']}">${ele['categorytitle']}</a></li>`);
						} else {
							$('.submenu').append(`<li><a href="${base_url}category/${ele['categorytitle']}">${ele['categorytitle']}</a></li>`);
						}


					})
				}
			});
		}

		fetch_trending_news();
		fetch_recents_news();
	});

	

	

	$('#find').on('keyup', function() {

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

					if (data == "") {
						$('.search').html('No data found.');
						setTimeout(function() {
							$('#searchPanel').hide();
						}, 3000);

					} else {
						$('#searchPanel').css('display', 'block');
						$.each(data, function(n, ele) {
								let id = data[n]['id'];
								let slug = data[n]['url_slug'];

								$('.search').html(`<div class="mb-2 searchresult">
								<a href="<?php echo base_url() . 'article/${id}/${slug}'; ?>" id="titlelink" style="display:block">
								<h6 style="color: #c0392b;">${data[n]['title']}</h6>
								<p>
									${data[n]['shortdescription']};
								</p>
								</a>
								
							</div>`);
							})
						}

					}

				});
		});
</script>
