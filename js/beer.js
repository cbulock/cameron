$(function() {

	$('.score').each(function() {
			var rating = $(this).parent().data('rating-percent');
			var rating_inverted = 100 - rating;
			$(this).css('-webkit-clip-path', 'polygon(0 '+ rating_inverted +'%, 100% '+ rating_inverted +'%, 100% 100%, 0 100%)');
			$(this).css('clip-path', 'polygon(0 '+ rating_inverted +'%, 100% '+ rating_inverted +'%, 100% 100%, 0 100%)');
	});

});