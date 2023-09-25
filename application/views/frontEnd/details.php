<main>
	<!-- About US Start -->
	<div class="about-area">
		<div class="container">
			<!-- Hot Aimated News Tittle-->
			<div class="row">
				<div class="col-lg-12">
					<div class="trending-tittle">
						<strong>Trending now</strong>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8">
					<!-- Trending Tittle -->
					<div class="about-right mb-90">
						<div class="section-tittle mb-30 pt-30">
							<h3 id="headingtop"></h3>
						</div>
						<div class="about-img">
							<img src="" alt="" id="image">
						</div>

						<div class="about-prea">
							<?php  
								foreach ($art as $row) {
									if($row['article_status'] == 1){
										echo $row['content'];
									}
								}
							 ?>
						</div>


						<div class="social-share pt-30">
							<div class="section-tittle">
								<h3 class="mr-20">Share:</h3>
								<ul>
									<li><a href="#"><img src="<?php echo base_url('assets/img/news/icon-ins.png') ?>" alt=""></a></li>
									<li><a href="#"><img src="<?php echo base_url('assets/img/news/icon-fb.png') ?>" alt=""></a></li>
									<li><a href="#"><img src="<?php echo base_url('assets/img/news/icon-tw.png') ?>" alt=""></a></li>
									<li><a href="#"><img src="<?php echo base_url('assets/img/news/icon-yo.png') ?>" alt=""></a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- From -->
					<div class="row">
						<div class="col-lg-8">
							<form class="form-contact contact_form mb-80" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<textarea class="form-control w-100 error" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message"></textarea>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control error" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control error" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<input class="form-control error" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
										</div>
									</div>
								</div>
								<div class="form-group mt-3">
									<button type="submit" class="button button-contactForm boxed-btn">Send</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<!-- Section Tittle -->
					<div class="section-tittle mb-40">
						<h3>Follow Us</h3>
					</div>
					<!-- Flow Socail -->
					<div class="single-follow mb-45">
						<div class="single-box">
							<div class="follow-us d-flex align-items-center">
								<div class="follow-social">
									<a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a>
								</div>
								<div class="follow-count">
									<span>8,045</span>
									<p>Fans</p>
								</div>
							</div>
							<div class="follow-us d-flex align-items-center">
								<div class="follow-social">
									<a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a>
								</div>
								<div class="follow-count">
									<span>8,045</span>
									<p>Fans</p>
								</div>
							</div>
							<div class="follow-us d-flex align-items-center">
								<div class="follow-social">
									<a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a>
								</div>
								<div class="follow-count">
									<span>8,045</span>
									<p>Fans</p>
								</div>
							</div>
							<div class="follow-us d-flex align-items-center">
								<div class="follow-social">
									<a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a>
								</div>
								<div class="follow-count">
									<span>8,045</span>
									<p>Fans</p>
								</div>
							</div>
						</div>
					</div>
					<!-- New Poster -->
					<div class="news-poster d-none d-lg-block">
						<img src="assets/img/news/news_card.jpg" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- About US End -->
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

		setTimeout(function() {
			$('#preloader-active').css('display', 'none');
		}, 3000);

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
								<a href="<?php echo base_url('category') .'/${category}/${slug}'; ?>" id="titlelink" style="display:block">
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
	})
</script>
