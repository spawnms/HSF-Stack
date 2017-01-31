// die Funktion loescht Projekte anhand ihrer ID
$(function(){
$(".project").click(function(){
	var id = $(this).attr('id');
	var sid = ("<?php echo session_id(); ?>");

$.ajax({
	type: "POST",
	url: "py/remove_project_id.php",
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