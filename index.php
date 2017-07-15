<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8" />
  <title>Requests</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>

  <style>
  .center {
      margin: auto;
      width: 60%;
      height: 100px;
      max-width: 500px;
      padding: 10px;
      /* border: solid 1px; */
  }
  </style>

  <script>
  function addRequest() {
    // Get Data from Input field
    var data = document.getElementById("requestInput").value;
    if (!$.trim(data)){   
      alert("You can not request nothing." + data);
      return;
    }
    else{
      console.log("Data = " + data);
    }
    // Perform Ajax Call 
    // (Hint: request_data goes to php as post parameter)
    $.ajax({
      type: "post",
      data: {'request_data': data},
      url: "include/insert.php",
            success: function(response){
            console.log("Server says: " + response);
            loadRequests();
            }
      });
    // Element zurücksetzen
    document.getElementById("requestInput").value = "";
  };
      
    function loadRequests(id){
        console.log("called with id:" + id);
        $.ajax({
            type: 'post',
            data: { 'id': id},
            url: 'include/loadRequests.php',
            success: function (response) {
                // We get the element having id of display_info and put the response inside it
                $( '#requestsTable' ).html(response);
            }
        });
    }

  function deleteRequest(id){
      var answer = confirm ("Eintrag löschen?")
      if (!answer){
          return;
      }
    console.log("Delete id: " + id)
    $.ajax({
      type: "post",
      data: {'id': id},
      url: "include/delete.php",
            success: function(response){
            console.log("Server says: " + response);
            loadRequests();
            }
      });
  }

    $(document).ready(function() {
      loadRequests();
    });

    $('requestInput').keydown(function (event) {
        console.log(event);
        var keypressed = event.keyCode || event.which;
        if (keypressed == 13) {
            addRequest();
        }
    });
</script>
  </script>
</head>

<!-- Content, Yeah -->
<body>
    <div class="center">
        <div class="form-group">
            <input id="requestInput"
                   type="text"
                   class="form-control"
                   style="width: 100%;"
                   placeholder="Neue Anfrage">
        </div>
      <button class="btn btn-success pull-right" id="add" onclick="addRequest()">Hinzufügen</button>
    </div>
    <hr/>
    <div id="requestsTable"></div>
</body>
</html>