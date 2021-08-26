
function getGames(){
	category=document.getElementById("category").value;
	jQuery.ajax({
        url: "ajax/get_category.php",
        type: "POST",
        data:{
            "action" : 'fetch_games',
            "cat_id":category
        },
        success: function(data)
        {
            jQuery('#games_dropdown').replaceWith(data);
        }
    });
}

function getGameDetail(){
	
	game_id=document.getElementById("games_dropdown").value;
	
	jQuery.ajax({
        url: "ajax/fetch_game_detail.php",
        type: "POST",
        data:{
            "action" : 'fetch_details',
            "game_id":game_id
        },
        success: function(data)
        {
        	// alert('yes');
            jQuery('#div_change').replaceWith(data);
        }
    });
}