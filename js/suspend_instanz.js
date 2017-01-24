// $(function(){
// 	$("#modalset").on('click', function(){
// 		var $btn = $(this).button('loading');
// 		var $sende = "true";
// 		var $daten = "";
// 		var kurs = $("#strsto option:selected").text();
$(function(){
	$("#submitsuspend").click(function(){
		var $daten = "";
 		var kurs = $("#strsto option:selected").text();
		$.ajax({
			type	:'POST',
			async	: true,
			url		: "py/suspend_instanz.php",
			cache	: false,
			data	: {kurs	: kurs},
			//dataType: 'json',
			success	: function(data){	
				$("#kursset").modal('hide');
				location.reload();
			},
			error	: function(){
				alert("Na da ging wohl was schief mit dem Rückgabewert!");
			}
		});
		});
});