<?php include('header.php'); ?>

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
                                    <h2><a href="details.html" id="headingtop0"></a></h2>
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
    <!--Start pagination -->
    <div class="pagination-area pb-45 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End pagination  -->
</main>

<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {

    })

    $(window).on('load', function() {

        //trending news
        $.ajax({

            url: "<?php echo base_url() . 'frontend/fetch_articles' ?>",
            type: 'post',
            success: function(res) {
                var data = JSON.parse(res);
                var base_url = '<?php echo base_url() ?>';
                $('#image0').attr('src', base_url + data[4]['imagesurl']);
                $('#headingtop0').html(data[4]['title']);
                $('#tag').html(data[4]['categorytitle']);

                $.each(data, function(n, ele) {
                    $('#leftNews').append(`<div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="${base_url+ele['imagesurl']}" alt="image not found" width="100px">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color1">${ele['categorytitle']}</span>
                                <h4><a href="details.html">${ele['title']}</a></h4>
                            </div>
                        </div>`);



                    if (n == 3) {
                        return false;
                    }

                })

            }

        });

        //recent news
        $.ajax({
            url: '<?php echo base_url() . 'frontend/fetch_recents' ?>',
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
                                    <h4><a href="#">${ele['title']}</a></h4>
                                </div>
                            </div>`);
                });

            }
        });

        $.ajax({
            url: '<?php echo base_url() . 'frontend/fetch_category' ?>',
            type: 'POST',
            success: function(res) {
                var data = JSON.parse(res);

                $.each(data, function(n, ele) {

                    if (n < 7) {
                        $('#navigation').append(`<li><a href="${ele['categorytitle']+'.html'}" role="menuitem" tabindex="0">${ele['categorytitle']}</a></li>`);
                    } else {
                       $('.submenu').append(`<li><a href="${ele['categorytitle']+'.html'}" role="menuitem" tabindex="0">${ele['categorytitle']}</a></li>`);
                    }


                })
            }
        });
    });
</script>