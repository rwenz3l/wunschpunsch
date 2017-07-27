<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8" />
    <title>Requests</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/user.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <style>
        .center_fix {
            margin: auto;
            width: 60%;
            height: 100px;
            max-width: 500px;
            padding: 10px;
            /* border: 1px solid #000000; */
        }
        
        .innerTable {
            width: 500px;
            margin: 20px auto;
            /* border: 1px solid rgba(0, 0, 0, .1); */
        }

    </style>
</head>

<!-- Content, Yeah -->

<body>
    <div class="center_fix">
        <div class="form-group">
            <input id="requestInput" type="text" class="form-control" style="width: 100%;" placeholder="...">
        </div>
        <button class="btn btn-success pull-right" id="addRequest" onclick="addRequest()">Request</button>
    </div>
    <hr/>
    <div id="wrapper">
        <div class="innerTable" style="height: 20px; width: 500px;">
            <div class="btn-group pull-right">
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#all" onclick='loadRequests(id=lastID, filter="all")'>All</a></li>
                    <li class="divider"></li>
                    <li><a href="#open" onclick='loadRequests(id=lastID, filter="open")'>Open</a></li>
                    <li><a href="#filled" onclick='loadRequests(id=lastID, filter="filled")'>Filled</a></li>
                </ul>
            </div>
        </div>
        <div id="requestsTable"></div>
    </div>
</body>

</html>
