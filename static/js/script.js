$(document).ready(function(){

	$('.button-collapse').sideNav();
	$('select').material_select();

	$('.modal').modal();

	$('.see_visite').click(function(){
		var id = $(this).attr('id');
		$.animal('admin_seeVisiteJs.html', {id:id}, function(){
			$('#visite_'+id).hide();
		});
	});

	$('.delete_visite').click(function(){
		var id = $(this).attr('id');
		$.animal('admin_deleteVisiteJs.html', {id:id}, function(){
			$('#visite_'+id).hide();
		});
	});

});