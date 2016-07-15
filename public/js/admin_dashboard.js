$(document).ready(function(){
	
	$("#sidebar-toggle").click(function(){
		$('.sidebar').toggle();
		$('.navbar-default').toggleClass('extend-navbar');
		$('.content').toggleClass('extend-content');
	});

	$(".clickable-row , .clickable").click(function() {
        window.document.location = $(this).data("href");
    });

    $('#refresh').click(function(){
    	location.reload();
    });

    $('.flash-message').delay(3000).fadeOut(300);
    $('.alert').delay(3000).slideUp(300);

});