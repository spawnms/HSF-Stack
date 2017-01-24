$("button.submit").click(function(){
//var name = $("#benutzername").val();
//var passwd = $("#benutzerpasswd").val();
//var passwdrepeat = $("#benutzerpasswd_w").val();
//var email = $("#benutzeremail").val();
//var role = $("#rolle :selected").text();
//var dataString = 'name1' + name + 'passwd1' + passwd + 'passwdrepeat1' + passwdrepeat + 'email1' + email + 'role1' + role;
//Hier fehlt noch Code
$.ajax({
	type: "POST",
	url: "../config/useradd.php",
	data: $(form.formuseradd).serialize(),
	success: function(msg){
		$("#modaluseradd").modal('hide');
	},
	error: function(){
		alert("Fehler");
	}
});
});