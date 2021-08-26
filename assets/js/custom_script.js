
//parameter game id
function add_to_favourites(id, user_id){
	var game_id = id;
	var user_id = user_id;
	jQuery.ajax({
	        url: "ajax/add_favourites.php",
	        type: "POST",
	        data:{
                "action": "add_to_favourites",
                "game_id":game_id,
                "user_id" : user_id	                
	        },
	        success: function(data){
	            if(data==1){
	                alert("Game added to Favourites");
	                window.location.href = 'index.php';
	            }
	            if(data==0){
	                alert("Game Removed from the Favourites");
                    // $('.game-1 .fav-icon').removeClass('fav_active');
                    // $('.game-1 .fav-icon').addClass('no-active');
                    window.location.href = 'index.php';
	            }
	        }
	});
}

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

// -----------------------------------------------------
$(function () {
    // var category_id = '<?php echo $category_id ?>';
    var category_id = 5;
    $(".catid-5").slice(0, 4).show();
    $("#loadMore-5").on('click', function (e) { 
        // alert("5");
        e.preventDefault();
        $(".catid-5:hidden").slice(0, 4).slideDown();
        if ($(".catid-5:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
    });
});


$(function () {
    // var category_id = '<?php echo $category_id ?>';
    var category_id = 6;
    $(".catid-6").slice(0, 4).show();
    $("#loadMore-6").on('click', function (e) {
        // alert("6");
        e.preventDefault();
        $(".catid-6:hidden").slice(0, 4).slideDown();
        if ($(".catid-6:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
    });
});
// ----------------------------------------

$(function () {
    // var category_id = '<?php echo $category_id ?>';
    var category_id = 4;
    $(".catid-3").slice(0, 4).show();
    $("#loadMore-3").on('click', function (e) { 
        // alert("3");
        e.preventDefault();
        $(".catid-3:hidden").slice(0, 4).slideDown();
        if ($(".catid-3:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
    });
});

$(function () {
    // var category_id = '<?php echo $category_id ?>';
    var category_id = 4;
    $(".catid-4").slice(0, 4).show();
    $("#loadMore-4").on('click', function (e) { 
        // alert("4");
        e.preventDefault();
        $(".catid-4:hidden").slice(0, 4).slideDown();
        if ($(".catid-4:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
    });
});
// ----------------------------------------

$(function () {
    // var category_id = '<?php echo $category_id ?>';
    var category_id = 1;
    $(".catid-1").slice(0, 4).show();
    $("#loadMore-1").on('click', function (e) { 
        // alert("1");
        // e.preventDefault();
        // $(".catid-1:hidden").slice(0, 4).slideDown();
        // if ($(".catid-1:hidden").length == 0) {
        //     $("#load").fadeOut('slow');
        // }
        window.location.href = 'http://localhost/gameworld/viewmore-game.php?cat_id='+1;
    });
});

$(function () {
    var category_id = '<?php echo $category_id ?>';
    var category_id = 2;
    $(".catid-2").slice(0, 4).show();
    $("#loadMore-2").on('click', function (e) { 
        // alert("2");
        // e.preventDefault();
        // $(".catid-2:hidden").slice(0, 4).slideDown();
        // if ($(".catid-2:hidden").length == 0) {
        //     $("#load").fadeOut('slow');
        // }
        window.location.href = 'http://localhost/gameworld/viewmore-game.php?cat_id='+2;
    });
});

// ==========================================
