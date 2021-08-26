
    <footer class="footer bd-footer py-5 bg-nav">
        <div class="container py-5">
            <div class="row m-0">
                <div class="col-lg-3 mb-3">
                    <a class="d-inline-flex align-items-center mb-2 link-dark text-decoration-none" href="/"
                        aria-label="Bootstrap">

                        <span class="fs-5 color-white">Company Logo</span>
                    </a>
                    <ul class="list-unstyled small text-muted">
                        <li class="mb-2 text-white">Here you can play your favourite games free and enjoy other games in
                            which you have more interest.
                        </li>
                        <!-- <li class="mb-2">Code licensed <a href="https://github.com/twbs/bootstrap/blob/main/LICENSE"
                                target="_blank" rel="license noopener">MIT</a>, docs <a
                                href="https://creativecommons.org/licenses/by/3.0/" target="_blank"
                                rel="license noopener">CC BY 3.0</a>.</li> -->
                    </ul>
                </div>
                <div class="col-6 col-lg-2 offset-lg-1 mb-3 text-white">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a class="text-white" href="">Company Policy</a></li>
                        <li class="mb-2"><a class="text-white" href="">Privacy policy</a></li>
                        <li class="mb-2"><a class="text-white" href="">Cookie policy</a></li>
                        <li class="mb-2"><a class="text-white" href="">Terms Of Use</a></li>

                    </ul>
                </div>
                <div class="col-6 col-lg-2 mb-3 text-white">
                    <h5>Pages</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a class="text-white" href="#">Home</a></li>
                        <li class="mb-2"><a class="text-white" href="#arcade">Games</a></li>
                        <li class="mb-2"><a class="text-white" href="">Contact Us</a></li>
                        <li class="mb-2"><a class="text-white" href="">About Us</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 mb-3 text-white">
                    <h5>Social Media</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a class="text-white" href="https://www.facebook.com/">Facebook</a></li>
                        <li class="mb-2"><a class="text-white" href="https://www.instagram.com/">Instagram</a></li>
                        <li class="mb-2"><a class="text-white" href="https://www.twitter.com/">Twitter</a></li>
                    </ul>
                    </ul>
                </div>

            </div>
        </div>
    </footer>


    <script>
        $(document).ready(function () {
            var $window = $(window);
            var $sidebar = $(".sidebar");
            var $sidebarHeight = $sidebar.innerHeight();
            var $footerOffsetTop = $(".footer").offset().top;
            var $sidebarOffset = $sidebar.offset();

            $window.scroll(function () {
                if ($window.scrollTop() > $sidebarOffset.top) {
                    $sidebar.addClass("fixed");
                } else {
                    $sidebar.removeClass("fixed");
                }
                if ($window.scrollTop() + $sidebarHeight > $footerOffsetTop) {
                    $sidebar.css({ "top": -($window.scrollTop() + $sidebarHeight - $footerOffsetTop) });
                } else {
                    $sidebar.css({ "top": "40px", });
                }
            });


        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var button = document.getElementsByTagName("button")[0];
            button.addEventListener("click", function (e) {
                button.classList.toggle("liked");
            });
        });

    </script>

    <script src="assets/js/nav.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="assets/js/custom_script.js"></script>


    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
    <script>
        $(document).on('click', '.js-menu_toggle.closed', function (e) {
            e.preventDefault(); $('.list_load, .list_item').stop();
            $(this).removeClass('closed').addClass('opened');

            $('.side_menu').css({ 'left': '0px' });

            var count = $('.list_item').length;
            $('.list_load').slideDown((count * .6) * 100);
            $('.list_item').each(function (i) {
                var thisLI = $(this);
                timeOut = 100 * i;
                setTimeout(function () {
                    thisLI.css({
                        'opacity': '1',
                        'margin-left': '0'
                    });
                }, 100 * i);
            });
        });

        $(document).on('click', '.js-menu_toggle.opened', function (e) {
            e.preventDefault(); $('.list_load, .list_item').stop();
            $(this).removeClass('opened').addClass('closed');

            $('.side_menu').css({ 'left': '-250px' });

            var count = $('.list_item').length;
            $('.list_item').css({
                'opacity': '0',
                'margin-left': '-20px'
            });
            $('.list_load').slideUp(300);
        });
    </script>

</body>

</html>
<script type="text/javascript">
    $("#search_box").keyup(function(){
        var input_val = jQuery('#search_box').val();
        var search_txt = document.getElementById('search_box').value;
        if(search_txt == ''){
            jQuery(".search-outer-block").css('opacity','0');
        }else{

            jQuery.ajax({
                url: "ajax/getSearch.php",
                type: "POST",
                data:{
                    "action": "search_results",
                    "search_txt": search_txt               
                },
                success: function(data){
                    console.log(data);
                    jQuery(".search-outer-block").html(data);
                    jQuery(".search-outer-block").css('opacity','1');
                }
            });
        }
    });
</script>
<script type="text/javascript">
$(function () {
    var category_id = '<?php echo $category_id ?>';
    $(".queDiv-5").slice(0, 6).show();
    $("#loadMore-5").on('click', function (e) { 
        //alert("5");
        e.preventDefault();
        $(".queDiv-5:hidden").slice(0, 6).slideDown();
        if ($(".queDiv-5:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
    });
});


$(function () {
    var category_id = '<?php echo $category_id ?>';
    $(".queDiv-6").slice(0, 6).show();
    $("#loadMore-6").on('click', function (e) {
        // alert("6");
        e.preventDefault();
        $(".queDiv-6:hidden").slice(0, 6).slideDown();
        if ($(".queDiv-6:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
    });
});
// ----------------------------------------

$(function () {
    var category_id = '<?php echo $category_id ?>';
    $(".queDiv-3").slice(0, 6).show();
    $("#loadMore-3").on('click', function (e) { 
        e.preventDefault();
        $(".queDiv-3:hidden").slice(0, 6).slideDown();
        if ($(".queDiv-3:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
    });
});

$(function () {
    var category_id = '<?php echo $category_id ?>';
    $(".queDiv-4").slice(0, 6).show();
    $("#loadMore-4").on('click', function (e) { 
        e.preventDefault();
        $(".queDiv-4:hidden").slice(0, 6).slideDown();
        if ($(".queDiv-4:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
    });
});
// ----------------------------------------

$(function () {
    var category_id = '<?php echo $category_id ?>';
    $(".queDiv-1").slice(0, 4).show();
    $("#loadMore-1").on('click', function (e) { 
        // e.preventDefault();
        // $(".queDiv-1:hidden").slice(0, 4).slideDown();
        // if ($(".queDiv-1:hidden").length == 0) {
        //     $("#load").fadeOut('slow');
        // }
        window.location.href = 'http://localhost/gameworld/viewmore-game.php?cat_id='+1;
    });
});

$(function () {
    var category_id = '<?php echo $category_id ?>';
    $(".queDiv-2").slice(0, 4).show();
    $("#loadMore-2").on('click', function (e) { 
        // e.preventDefault();
        // $(".queDiv-2:hidden").slice(0, 4).slideDown();
        // if ($(".queDiv-2:hidden").length == 0) {
        //     $("#load").fadeOut('slow');
        // }
        window.location.href = 'http://localhost/gameworld/viewmore-game.php?cat_id='+2;
    });
});
</script>
<script type="text/javascript">
    //fav pagination
$(document).ready(function() {
    $("#target-content").load("ajax/pagination.php?page=1");
    $(".page-link").click(function(){
        var id = $(this).attr("data-id");
        var select_id = $(this).parent().attr("id");
        $.ajax({
            url: "ajax/pagination.php",
            type: "GET",
            data: {
                page : id
            },
            cache: false,
            success: function(dataResult){

                $("#target-content").html(dataResult);
                $(".pageitem").removeClass("active");
                $("#"+select_id).addClass("active");
                
            }
        });
    });
});
</script>
<script>