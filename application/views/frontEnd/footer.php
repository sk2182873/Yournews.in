<footer>
	<!-- Footer Start-->
	<div class="footer-area footer-padding fix">
		<div class="container">
			<div class="row d-flex justify-content-around">

				<div class="col-md-4 order-1 mt-5">
					<h6 class="text-danger">Pages</h6>
					<ul>
						<li><a href="<?php echo base_url() ?>">Home</a></li>
						<?php foreach ($data['link'] as $link) { ?>

							<li><a href="<?php echo base_url() . $link['p_slug'] ?>"><?php echo $link['page_name']; ?></a></li>

						<?php } ?>

					</ul>
				</div>

				<div class="col-md-4 order-2">
					<h6 class="text-danger mt-5">Navigations</h6>
					<li><a href="<?php echo base_url() ?>">Home</a></li>
					<ul>
						<?php foreach ($data['categories'] as $row) { ?>

							<li><a href="<?php echo base_url() . 'category/' . $row['categorytitle'] ?>"><?php echo ucfirst($row['categorytitle']); ?></a></li>

						<?php } ?>
					</ul>
				</div>

				<div class="col-md-4 d-flex flex-column order-0">
					<div class="text-white">
						<img src="<?php echo base_url() . 'asset/img/logo/logo-no-background.png' ?>" alt="company-logo" width="250px">
					</div>
					<div class="text-white mt-4">
						Bring out the turth in fornt of Society is our belief.
						We not represent any tampered fact to the society.
					</div>
				</div>


			</div>
		</div>
	</div>
	<!-- footer-bottom aera -->
	<div class="footer-bottom-area">
		<div class="container">
			<div class="footer-border">
				<p class="text-light">All rights reserved @<span class="text-warning">YourNews</span></p>
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



		$('#contactForm').submit(function() {

			$('#success').html('');
			$('#Err').html('');

			$.ajax({
				url: "<?php echo base_url('frontend/save_query'); ?>",
				type: 'post',
				data: $(this).serialize(),
				success: function(res) {
					var data = JSON.parse(res);

					console.log(data);

					$('#success').html(data['success']);
					$('#Err').html(data['Err']);

					$('#contactForm')[0].reset();
				}
			});
		});


		var category = "<?php echo $data['page'] ?>";

		let index = -1;

		console.log("data");

		//trending news
		function fetch_trending_news() {
			$.ajax({
				url: `<?php echo base_url() . 'fetchData/fetch_articles_by_category/${category}' ?>`,
				type: 'post',
				success: function(res) {
					var data = JSON.parse(res);
					var base_url = '<?php echo base_url() ?>';

					const length = data.length;

					if (length == 0) {
						$('#image0').attr('src', base_url + 'asset/img/news/upload_soon.png');
						$('#headingtop0').html("Sorry for inconvience.\nWe will upload articles soon").css('color', 'white');

						return false;
					}


					$.each(data, function(n, ele) {

						if (length - n == 1) {
							return false;
						} else {
							if (n < 4) {

								if (ele['article_status'] == 1) {
									$('#leftNews').append(`<a href="<?php echo base_url('category') ?>/${ele['categorytitle']}/${ele['url_slug']}">
									<div class="trand-right-single d-flex">
											<div class="trand-right-img">
												<img src="${base_url+ele['imagesurl']}" alt="image not found" width="100px">
											</div>
											<div class="trand-right-cap">
												<span class="color1">${ele['categorytitle']}</span>
												<h4>${ele['title']}</h4>
											</div>
										</div></a>`);
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
					$('#headingtop0').html(data[index + 1]['title']).css('color', 'white');
					$('#link').attr('href', "<?php echo base_url() ?>category" + '/' + data[index + 1]['categorytitle'] + '/' + data[index + 1]['url_slug']);
					$('#tag').html(data[index + 1]['categorytitle']);

				}

			});
		}

		function fetch_trending_news2() {
			$.ajax({
				url: `<?php echo base_url() . 'frontend/fetch_recents' ?>`,
				type: 'post',
				success: function(res) {
					var data = JSON.parse(res);
					var base_url = '<?php echo base_url() ?>';

					console.log(data);

					$.each(data, function(n, ele) {
						if (ele['article_status'] == 1) {
							$('#singlebox').append(`<a href="<?php echo base_url('category') ?>/${ele['categorytitle']}/${ele['url_slug']}">
								<div class="trand-right-single d-flex">
										<div class="trand-right-img">
											<img src="${base_url+ele['imagesurl']}" alt="image not found" width="100px" height="50px" style="border-radius:5px;">
										</div>
										<div class="trand-right-cap pl-2">
											<span class="color2 py-2">${ele['categorytitle']}</span>
											<h4 class="heading4 py-2">${ele['title']}</h4>
										</div>
								</div></a>`);
						}
					})
				}

			});
		}

		//search Functionality.
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

					setTimeout(function() {
						$('#searchPanel').hide();
					}, 7000);

				}

			});
		});

		fetch_trending_news();
		fetch_trending_news2();

		//slick responsive script
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
			
			]
		});
	});
</script>
</body>

</html>
