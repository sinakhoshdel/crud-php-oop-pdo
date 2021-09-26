$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	
	$(".deleteUser").click(function(){
		var id = $(this).data("id");
		$("input[name='user_id']").val(id);
	})
	
	$(".cancelDelete").click(function(){
		$("input[name='user_id']").val('');
	})
	
});