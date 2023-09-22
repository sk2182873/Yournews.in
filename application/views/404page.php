<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>404 Page Not Found</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/'?>demo.css">
</head>
<body>
	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 vh-100 d-flex flex-column text-center align-items-center justify-content-center">
					<div class="mb-5">
						<h1 style="font-size: 50px;color:#e74c3c;">404</h1>
						<h3 style="font-size: 35px;color:#e74c3c;">Page Not Found</h3>
						<h5 style="border: 2px solid #2980b9;border-radius:5px;cursor:pointer;"><a href="<?php echo base_url(); ?>" style="text-decoration:none;display:block;padding:10px 15px;">Go Back</a></h5>
					</div>
					<img src="<?php echo base_url().'assets/img/404/404.svg'?>" alt="404 Page Not Found" width="30%">
				</div>
			</div>
		</div>
	</section>
</body>
</html>
