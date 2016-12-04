$("#submitdelete").click(function(){
$.ajax({
	type: "POST",
	url: "../config/userdel.php",
	data: $("form.formuserdelete").serialize(),
	success: function(msg){
		$("#modaluserdelete").modal('hide');
	},
	error: function(){
		alert("Fehler");
	}
});
});