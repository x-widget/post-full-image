$(function(){
	var image1_count = $(".image-menu-wrapper .image-menu .image-menu-name").length, current_row1 = 1, columns, max_rows1;
	max_rows_1();

	/* Image 1 Menu NAV*/
	$(".image-menu-wrapper .left_arrow").click(function(){
		if ( current_row1 != 1 ) { 
			if ( $(window).width() < 625 ) $('.content .post-full-image-wrapper .image-menu').animate({top: "+=36px"}, 0);
			else if ( $(window).width() > 625 &&  $(window).width() < 970 ) $('.content .post-full-image-wrapper .image-menu').animate({top: "+=220px"}, 0);
			current_row1--;
		}
	});
	
	
	$(".image-menu-wrapper .right_arrow").click(function(){
		max_rows_1();
		if ( current_row1 != max_rows1 ) {
			if ( $(window).width() < 625 ) $('	.content .post-full-image-wrapper .image-menu').animate({top: "-=36px"}, 0);
			else if ( $(window).width() > 625 &&  $(window).width() < 970 ) $('.content .post-full-image-wrapper .image-menu').animate({top: "-=220px"}, 0);
			current_row1++;
		}
	});
	
	function max_rows_1() {
		if ( $(window).width() > '955' ) columns = 7;
		else if ( $(window).width() > '830' ) columns = 6;
		else if ( $(window).width() > '705' ) columns = 5;
		else if ( $(window).width() > '625' ) columns = 4;
		else columns = 3;
		max_rows1 = Math.floor(image1_count / columns);
		if ( (image1_count % columns) > 0 ) max_rows1++;
	};
});