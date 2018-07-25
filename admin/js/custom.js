$(document).ready(function(){
	$('.pcoded-navbar .pcoded-item a').on('click', function(element){
		console.log($(element.target));
		$('.pcoded-item li').removeClass('active');
		$(element.target).parent().parent().addClass('active');
	});
});