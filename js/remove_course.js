// die Funktion loescht Kurse, also alle Projekte eines Kurses
// es wird die Kursbezeichnung eingelesen und an die remove_course.php uebergeben
$(function(){
$("#submitloeschen").click(function(){
	var kurs = $("#projektloeschen").val();
	var sid = ("<?php echo session_id(); ?>");

$.ajax({
	type: "POST",
	url: "py/remove_course.php",
	data: {kurs:kurs,
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