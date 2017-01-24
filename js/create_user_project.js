// die Funktion erstellt die Projekt-Form für die Auswahl Benutzer oder Projekt
// Auswahl: Benutzer -> Elemente von Projekt werden entfernt und eigene hinzugefügt
// Auswahl: Projekt -> Elemente von Benutzer werden entfernt und eigene hinzugefügt
$(function(){
  var str = "";
  
  $("#auswahl").change(function(){
    $("#auswahl option:selected").each(function(){
      str = $(this).text();
    });
    if(str === "Benutzer"){
      $("#labela").text("Benutzer");
      $(".benutzername").remove();
      $(".postfix").remove();
      $(".anzahl").remove();
      $("#bingo").remove();
      $(".auswahl").after('<div class="form-group benutzername"><label id="labela" for="Benutzname">Benutzername</label><input type="user" pattern="[a-zA-Z]" name="benutzername" class="form-control" id="benutzername" autofocus="true" placeholder="Benutzername"></div><div class="form-group benutzerpasswd"><label for="Benutzerpasswd">Passwort</label><input type="password" name="benutzerpasswd" class="form-control" id="benutzerpasswd" placeholder="Passwort"></div><div class="form-group beschreibung"><textarea class="form-control" rows"3" placeholder="Beschreibung" id="beschreibung"></textarea></div>');
      $(".projekt").css("visibility", "visible");
    }
    else {
      $("#labela").text("Kurs");
      $(".benutzername").after('<div class="form-group postfix"> <label id="labela" for="postfix">Projekt</label> <input type="text" name="postfix" class="form-control" id="postfix" autofocus="true" placeholder="Projekt" >');
      $(".postfix").after('<div class="form-group anzahl"> <label id="label" for="anzahl">Anzahl</label> <input type="number" name="anzahl" class="form-control" id="anzahl" autofocus="true" placeholder="anzahl" >');
      $(".projekt").css("visibility", "hidden");
      $(".benutzerpasswd").remove();
      $(".beschreibung").remove();
			$(".anzahl").after('<div id="bingo"><div class="col-xs-4"><div class="checkbox disabled"><label><input type="checkbox" id="netzwerk"> Default Netzwerk </label></div></div></div>');
      $("#benutzername").attr("placeholder", "Kurs");
    }
  }).trigger("change");

  $("#submit").click(function(){
    var auswahl = $("#auswahl").val();
    // benutzername ist die Klassen-ID für Benutzename und Projektbezeichnung
    var name = $("#benutzername").val();
    var passwd = $("#benutzerpasswd").val();
    var beschreibung = $("#beschreibung").val();
    // projekt ist die Klassen-ID für das Projekt in OpenStack
    var projekt = $("#projekt").val();
    var sid = ('<?php echo session_id(); ?>');
    // postfix ist die Klassen-ID für das Projekt im Kurs, nicht mit dem Projekt in OpenStack verwechseln
    var postfix = $("#postfix").val();
    var anzahl = $("#anzahl").val();
    var netzwerk = "false";
    var router = "false";
    var storage = "false";

    if ($("#netzwerk").is(':checked')){
      netzwerk = "true";
    }
    else {
      netzwerk = "false";
    }

    if(str === "Benutzer"){
      if(auswahl == "" || name == "" || passwd == "" || beschreibung == "" || projekt == ""){
        alert("Es wurden nicht ALLE Felder befüllt!");
      }
      else {
        $.ajax({
          type: "POST",
          url: "py/createuser.php",
          data : {
                  auswahl : auswahl,
                  name : name.replace(/\s/g,""),
                  benutzerpasswd: passwd,
                  beschreibung: beschreibung.replace(/\s/g,"_"),
                  projekt: projekt,
                  sid : sid,
          },
          success: function(msg){
            location.reload();
            $("#createuser").modal('hide');
          },
          error: function(){
            alert("Fehler");
          }
        });
      }
    }
    else {
      if(auswahl == "" || name == "" || postfix == "" || anzahl == ""){
          alert("Es wurden nicht alle notwendigen Felder befüllt! Dies sind Kurs, Projekt und Anzahl");
      }
      else {
        $.ajax({
          type: "POST",
          url: "py/createproject.php",
          data : {
                  auswahl : auswahl,
                  kurs : name.replace(/\s|_/g,""),
                  postfix : postfix.replace(/\s/g,""),
                  anzahl : anzahl,
                  netzwerk : netzwerk,
                  sid : sid,
          },
          success: function(msg){
            location.reload();
            $("#createuser").modal('hide');
          },
          error: function(){
            alert("Fehler");
          }
        });
      } 
    }
  });
});