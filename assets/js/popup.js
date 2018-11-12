function showPopup(id) {	

	$('body').append('<div class="over-lay"></div>');
	$('body').css('overflow','hidden');
	$(id + ', .over-lay').show();

}

function closePopup(id) {

	$('body').css('overflow','auto');
	$(id + ', .over-lay').hide(function(){
		$('.over-lay').remove();
	});
	
}