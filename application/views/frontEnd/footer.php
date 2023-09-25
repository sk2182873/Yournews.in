<footer>
	<!-- Footer Start-->
	<div class="footer-area footer-padding fix">
		<div class="container">
			<div class="row d-flex justify-content-around">
				<div>
					<h6 class="text-danger">Pages</h6>
					<ul>
						<?php foreach ($data['link'] as $link) { ?>

							<li><a href="<?php echo base_url() . $link['p_slug'] ?>"><?php echo $link['page_name']; ?></a></li>

						<?php } ?>
					</ul>
				</div>

				<div>
					<h6 class="text-danger">Navigations</h6>
					<ul>
						<?php foreach ($data['categories'] as $row) { ?>

							<li class="mb-2"><a href="<?php echo base_url() . 'category/' . $row['categorytitle'] ?>"><?php echo ucfirst($row['categorytitle']); ?></a></li>

						<?php } ?>
					</ul>
				</div>


			</div>
		</div>
	</div>
	<!-- footer-bottom aera -->
	<div class="footer-bottom-area">
		<div class="container">
			<div class="footer-border">
				<p class="text-light">All rights reserved @aznews</p>
			</div>
		</div>
	</div>
	<!-- Footer End-->
</footer>

<!-- JS here -->

<!-- All JS Custom Plugins Link Here here -->
<script src="<?php echo base_url() . 'asset/js/vendor/modernizr-3.5.0.min.js' ?>"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="<?php echo base_url() . 'asset/js/vendor/jquery-1.12.4.min.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/popper.min.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/bootstrap.min.js' ?>"></script>
<!-- Jquery Mobile Menu -->
<script src="<?php echo base_url() . 'asset/js/jquery.slicknav.min.js' ?>"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="<?php echo base_url() . 'asset/js/owl.carousel.min.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/slick.min.js' ?>"></script>
<!-- Date Picker -->
<script src="<?php echo base_url() . 'asset/js/gijgo.min.js' ?>"></script>
<!-- One Page, Animated-HeadLin -->
<script src="<?php echo base_url() . 'asset/js/wow.min.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/animated.headline.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/jquery.magnific-popup.js' ?>"></script>

<!-- Breaking New Pluging -->
<script src="<?php echo base_url() . 'asset/js/jquery.ticker.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/site.js' ?>"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="<?php echo base_url() . 'asset/js/jquery.scrollUp.min.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/jquery.nice-select.min.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/jquery.sticky.js' ?>"></script>

<!-- contact js -->
<script src="<?php echo base_url() . 'asset/js/contact.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/jquery.form.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/jquery.validate.min.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/mail-script.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/jquery.ajaxchimp.min.js' ?>"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="<?php echo base_url() . 'asset/js/plugins.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/main.js' ?>"></script>

<script>
	$(document).ready(function() {

		setTimeout(function() {
			$('#preloader-active').css('display', 'none');
		}, 1000);


		// $(window).on('load', function() {
		// 	$.ajax({

		// 		url: "<?php echo base_url() . 'frontend/fetch_articles' ?>",
		// 		type: 'post',
		// 		success: function(res) {
		// 			var data = JSON.parse(res);
		// 			var base_url = '<?php echo base_url() ?>';

		// 			$('#image0').attr('src', base_url + data[4]['imagesurl']);
		// 			$('#headingtop0').html(data[4]['title']);
		// 			$('#headingtop0').attr('href', '<?php echo base_url() ?>article' + '/' + data[4]['id'] + '/' + data[4]['url_slug']);
		// 			$('#tag').html(data[4]['categorytitle']);

		// 			$.each(data, function(n, ele) {
		// 				$('#leftNews').append(`<div class="trand-right-single d-flex article">
		// 						<div class="trand-right-img">
		// 							<img src="${base_url+ele['imagesurl']}" alt="image not found" width="100px">
		// 						</div>
		// 						<div class="trand-right-cap ">
		// 							<span class="category">${ele['categorytitle']}</span>
		// 							<h4><a class="title" href="<?php echo base_url() ?>article/${ele['id']}/${ele['url_slug']}">${ele['title']}</a></h4>
		// 						</div>
		// 						</div>`);



		// 				if (n == 3) {
		// 					return false;
		// 				}

		// 			})

		// 		}

		// 	});
		// })

		var category = "<?php echo $data['page'] ?>";

		let index = -1;

		//trending news
		function fetch_trending_news() {
			$.ajax({
				url: `<?php echo base_url() . 'fetchData/fetch_articles_by_category/${category}' ?>`,
				type: 'post',
				success: function(res) {
					var data = JSON.parse(res);
					var base_url = '<?php echo base_url() ?>';

					const length = data.length;

					$.each(data, function(n, ele) {

						if (length - n == 1) {
							return false;
						} else {
							if (n < 4) {

								if (ele['article_status'] == 1) {
									$('#leftNews').append(`<div class="trand-right-single d-flex">
											<div class="trand-right-img">
												<img src="${base_url+ele['imagesurl']}" alt="image not found" width="100px">
											</div>
											<div class="trand-right-cap">
												<span class="color1">${ele['categorytitle']}</span>
												<h4><a href="<?php echo base_url('category') ?>/${ele['categorytitle']}/${ele['url_slug']}">${ele['title']}</a></h4>
											</div>
										</div>`);
										index++;
								}
								
							} else {

								return false;
							}

						}
					})

					// console.log(object);
					// console.log("Index  =", index);

					$('#image0').attr('src', base_url + data[index + 1]['imagesurl']);
					$('#headingtop0').html(data[index + 1]['title']);
					$('#headingtop0').attr('href', "<?php echo base_url() ?>category" + '/' + data[index + 1]['categorytitle'] + '/' + data[index+1]['url_slug']);
					$('#tag').html(data[index + 1]['categorytitle']);

				}

			});
		}

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
									<a href="<?php echo base_url('category') . '/${category}/${slug}'; ?>" data-id="${id}" id="titlelink" style="display:block">
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

		fetch_trending_news();


		$('.responsive').slick({
			dots: true,
			infinite: false,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 4,
			responsive: [{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
						infinite: true,
						dots: true
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
		});

	});
</script>
</body>

</html>
