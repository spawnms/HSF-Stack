$(function(){
            var str = "";
            $("#auswahl").change(function(){
              $("#auswahl option:selected").each(function(){
                str += $(this).text() + " ";
              });
              if(str === "Benutzer "){
              $("#labela").text("Benutzer");
              $(".postfix").remove();
              $(".anzahl").remove();
              $("#bingo").css("hidden");
              // $(".benutzername").after('<div class="form-group benutzerpasswd"><label for="Benutzerpasswd">Passwort</label><input type="password" name="benutzerpasswd" class="form-control" id="benutzerpasswd" placeholder="Passwort"></div>');
              // $(".benutzerpasswd").after('<div class="form-group beschreibung"><textarea class="form-control" rows"3" placeholder="Beschreibung" id="beschreibung"></textarea></div>');
              // $(".beschreibung").after('<div class="form-group projekt"><label for="Anzahl">Projekt</label><select class="form-control" name="projekt" id="projekt"><?php for($i = 0; $i < count($ausgabe2);$i++) { if(!(in_array($ausgabe2[$i]->Name,$ausnahmen))) { echo "<option>".$ausgabe2[$i]->Name."</option>"; } } ?> </select> </div>');
              }
              else {
                $("#labela").text("Projekt");
                //$(".benutzername").addClass("col-xs-6");
                $(".benutzername").after('<div class="form-group postfix"> <label id="label" for="postfix">Postfix</label> <input type="text" name="postfix" class="form-control" id="postfix" autofocus="true" placeholder="postfix" >');
                $(".postfix").after('<div class="form-group anzahl"> <label id="label" for="anzahl">Anzahl</label> <input type="number" name="anzahl" class="form-control" id="anzahl" autofocus="true" placeholder="anzahl" >')
                $(".benutzerpasswd").remove();
        				//$("div.benutzerpasswd").css('visibility','hidden');
                $(".beschreibung").remove();
        				//$(".beschreibung").css('visibility','hidden');
                $(".projekt").remove();
        				//$(".projekt").css('visibility','hidden');
                $("#bingo").prepend('<div class="col-xs-4"><div class="checkbox disabled"><label><input type="checkbox" id="netzwerk"> Default Netzwerk </label></div> <div class="checkbox disabled"><label> <input type="checkbox" value="router" id="router">Default Router</label></div><div class="checkbox disabled"><label><input type="checkbox" value="storage" id="storage">Default Storage</label></div></div>');
              }
            })
            .trigger("change");
          $("#submit").click(function(){
          var auswahl = $("#auswahl").val();
          var name = $("#benutzername").val();
          var passwd = $("#benutzerpasswd").val();
          var beschreibung = $("#beschreibung").val();
          var projekt = $("#projekt").val();
          var sid = ("<?php echo session_id(); ?>");
          var postfix = $("#postfix").val();
          var anzahl = $("#anzahl").val();
          var netzwerk = "false";
          var router = "false";
          var storage = "false";
          if ($("#netzwerk").is(':checked')){
            netzwerk = "true";
          }

          if($("#router").is(":checked")){
            router = "true";
          }

          if($("#storage").is(":checked")){
            storage = "true";
          }
          if(str=="Benutzer "){
          $.ajax({
            type: "POST",
            url: "py/createuser.php",
            data : {
                    auswahl : auswahl,
                    benutzername : name,
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
        } else {
          $.ajax({
            type: "POST",
            url: "py/createproject.php",
            data : {
                    auswahl : auswahl,
                    benutzername : name,
                    postfix : postfix,
                    anzahl : anzahl,
                    netzwerk : netzwerk,
                    router : router,
                    storage : storage,
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
          });
          });