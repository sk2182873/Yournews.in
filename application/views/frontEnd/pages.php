<?php include('header2.php'); ?>

<body>
	<main>
		<div class="container-fluid">
			<div class="row">
				<div class="offset-md-1 col-10 pages">
					<?php foreach($data['page'] as $page){
						echo $page['content'];
					} ?>
				</div>
			</div>
		</div>
	</main>
</body>


<?php include('footer.php'); ?>
<script>
	$(window).on('load', function(){

		$.ajax({
            url: '<?php echo base_url() . 'frontend/fetch_category' ?>',
            type: 'POST',
            success: function(res) {
                var data = JSON.parse(res);
                var base_url = "<?php echo base_url(); ?>"

                $.each(data, function(n, ele) {

                    if (n < 7) {
                        $('#navigation').append(`<li><a href="${base_url}category/${ele['categorytitle']}" role="menuitem" tabindex="0">${ele['categorytitle']}</a></li>`);
                    } else {
                       $('.submenu').append(`<li><a href="${base_url}category/${ele['categorytitle']}" role="menuitem" tabindex="0">${ele['categorytitle']}</a></li>`);
                    }


                })
            }
        });

	})
</script>
