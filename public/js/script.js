$(document).ready(function(){

		$('.flash-message').delay(3000).fadeOut(300);
    	$('.alert').delay(3000).slideUp(300);

		$('.dropdown-menu').click(function(e) {
          	e.stopPropagation();
    	});

    	$('.cart').click(function(e) {
          	$('.cart .dropdown-toggle').toggleClass('fa-shopping-cart');
          	$('.cart .dropdown-toggle').toggleClass('fa-times');
    	});

    	$('#search-toggle').click(function(){
    		$('#search').toggle();
    		$('#search').toggleClass('bounceInRight');
    	});

    	$('.display-img').click(function(){
    		var current = $('.product .images .main img').attr('src');
    		$('.product .images .main img').attr('src',$(this).attr('src'));
    		$(this).attr('src',current);
    	});

    	$('.section').mouseover(function(){
    		$(this).children('.categories').show();
    	});

    	$('.section').mouseleave(function(){
    		$(this).children('.categories').hide();
    	});

    	$(".clickable").click(function() {
	        window.document.location = $(this).data("href");
	    });

	    $('#plus-qty').click(function(){
	    	$('.qty').val(Number($('.qty').val())+1);
	    });

	    $('#minus-qty').click(function(){
	    	if (Number($('.qty').val()) != 1) {
	    		$('.qty').val(Number($('.qty').val())-1);
	    	};
	    });

	    $('.plus-cart-qty').click(function(){
	    	$(this).prevAll('.qty').val(Number($(this).prevAll('.qty').val())+1);
	    	var target = '.mycart .product-' + $(this).parent().parent().attr('prod-id') + ' .save';
	    	$(target).show();
	    });

	    $('.minus-cart-qty').click(function(){
	    	if (Number($(this).prevAll('.qty').val()) != 1) {
	    		$(this).prevAll('.qty').val(Number($(this).prevAll('.qty').val())-1);
	    		var target = '.mycart .product-' + $(this).parent().parent().attr('prod-id') + ' .save';
	    		$(target).show();
	    	};
	    });

	    $('.save').click(function(){
	    	var target = '.mycart .product-' + $(this).parent().parent().attr('prod-id') + ' .qty';
	    	var oldqty = Number($(this).parent().parent().attr('qty'));
	    	var newqty = Number($(target).val());
	    	$(target).val(newqty-oldqty);
	    	$(this).parent().parent().find('form').submit();
	    });

	    $('#myTabs a').click(function (e) {
  			e.preventDefault()
  			$(this).tab('show')
		})

	});