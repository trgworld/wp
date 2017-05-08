$(document).ready(function(){
    $('.main-navigation li a').click(function(){
    	$('.main-navigation li').removeClass('active');
		var clicked_menu_text = $(this).html();
		var clicked_menu_string_id = $(this).closest( "li" ).attr("id");
        var clicked_menu_id = clicked_menu_string_id.replace(/[^0-9]/gi, '');
		clicked_menu_id = parseInt(clicked_menu_id);
		$.ajax({
			type: 'POST',
			global: false,
			dataType: 'html',
			url: myAjaxObject.ajax_url,
			data: 'action=getChildMenuItems&menu_item_id='+clicked_menu_id,
			success: function (data)
			{
				if( data != "" && data != "0" ){
					$("#site_menu_children").html(data);
					$('.main-sub-menu h2').html(clicked_menu_text);
					$('#'+clicked_menu_string_id).addClass('active');
					$('.main-sub-menu').addClass('active');
				} else{
					$('.main-sub-menu .close-btn').click();
				}
			}
		});
    });

    $('.main-sub-menu .close-btn').click(function(){
    	$('.main-navigation li').removeClass('active');
    	$('.main-sub-menu').removeClass('active');
    });

    $('.quick-menu').click(function(){
    	$('.quick-links').addClass('active');
    });

    $('.quick-links .close-btn').click(function(){
    	$('.quick-links').removeClass('active');
    });

    $('.search-menu').click(function(){
    	$('.search-bar').addClass('active');
    });

    $('.search-bar .close-btn').click(function(){
    	$('.search-bar').removeClass('active');
    });

    $('.home-solution-box').slick({
	  infinite: true,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  autoplay: true,
      autoplaySpeed: 2000,
	});

	$('.moving-text').slick({
	  dots: false,
	  infinite: true,
	  autoplaySpeed: 3000,
	  slidesToShow: 1,
	  adaptiveHeight: true,
	  arrows: false,
	  autoplay: true
	});
});

// End of Docuemnt Ready

// Video player JS



window.onload = function() {

	if ( $("body").hasClass("page-template-page-home") ){
		var vidSection = document.getElementById("home-vid");

		// Video
		var video = document.getElementById("home-player");

		// Buttons
		var playButton = document.getElementById("play-pause");

		  // Event listener for the play/pause button
			playButton.addEventListener("click", function() {
			  if (video.paused == true) {
			    // Play the video
			    video.play();

			    // Update the button text to 'Pause'
			    vidSection.className += " playing";
			  } else {
			    // Pause the video
			    video.pause();

			    // Update the button text to 'Play'
			    vidSection.classList.remove("playing");
			  }
			});
	}

}