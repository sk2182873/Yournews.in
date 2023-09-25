<?php include('header2.php'); ?>

<body>
	<main>
		<div class="container-fluid">
			<div class="row">
				<div class="offset-md-1 col-10 pages">
					<?php foreach($data['page'] as $page){
						if($page['p_status'] == 1){
							echo $page['content'];
						}else{
							echo "<div class='w-100 d-flex align-items-center justify-content-center' style='height:300px;'>
									<h1 class=''>Page not Found</h1>		
								</div>";
						}
					} ?>
				</div>
			</div>
		</div>
	</main>
</body>

