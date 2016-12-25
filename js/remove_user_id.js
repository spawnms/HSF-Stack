$(function(){
$(".user").click(function(){
	var id = $(this).attr('id');
	var sid = ("<?php echo session_id(); ?>");

$.ajax({
	type: "POST",
	url: "py/remove_user_id.php",
	data: {id:id,
		   sid:sid,
		 },
	 success: function(msg){
	 	location.reload();
	 },
	 error: function(){
	 	alert("Beim löschen ging was schief!");
	 }
});
})
});