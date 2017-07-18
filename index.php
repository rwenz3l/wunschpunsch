<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8" />
  <title>Requests</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
    <script src="js/user.js"></script>

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
</head>

<!-- Content, Yeah -->
<body>
    <div class="center">
        <div class="form-group">
            <input id="requestInput"
                   type="text"
                   class="form-control"
                   style="width: 100%;"
                   placeholder="...">
        </div>
      <button class="btn btn-success pull-right" id="addRequest" onclick="addRequest()">Request</button>
    </div>
    <hr/>
    <div id="requestsTable"></div>
</body>
</html>