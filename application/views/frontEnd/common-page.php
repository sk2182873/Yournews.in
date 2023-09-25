

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

						<div class="recent-active responsive d-flex mb-5 dot-style">
							<?php foreach ($data['articles'] as $row) { ?>
								<div class="single-recent mb-5 mx-4" >
									<div class="articleimage">
										<img src="<?php echo base_url().$row['imagesurl']; ?>" alt="image not found" width="370px"  height="370px" style="border-radius:12px;">
									</div>
									<div class="what-cap">
										<span class="color1"><?php echo $row['categorytitle']; ?></span>
										<h4><a class='title' href="<?php echo base_url('category').'/'.$row['categorytitle'].'/'.$row['url_slug']; ?>" style="display:block;"><?php echo substr($row['title'],0,70); ?></a></h4>
									</div>
								</div>


							<?php } ?>





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
				<div class="col-12 search" style="text-align: center;color:#c0392b;">

				</div>
			</div>
		</div>
	</section>
</main>



