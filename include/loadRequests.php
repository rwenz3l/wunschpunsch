<?php

// Includes database connection
include "db_connect.php";

// Makes query with rowid
$query = "SELECT rowid, * FROM requests ORDER BY rowid DESC ";
// Only show unfilled:
//$query = "SELECT rowid, * FROM requests WHERE filled IS NULL ORDER BY rowid DESC ";

// Run the query and set query result in $result
// Here $db comes from "db_connection.php"
$result = $db->query($query);

?>

<div style="width: 500px; margin: 20px auto; border: 1px solid rgba(0, 0, 0, .1);">
<table class="table table-hover table-condensed table-striped table-bordered">
    <tr>
        <td>Name</td>
        <td style="text-align: center;"><span class="glyphicon glyphicon-ok"></td>
        <td style="text-align: center;">Edit</td>
    </tr>
    <?php
        while($row = $result->fetchArray()) {
            $f = $row['filled'];
            // Row Colors according to fullfilled/unfullfilled
            if ($f == 1){
                echo('<tr class="success" >');
            } else {
                echo('<tr class="danger" >');
            }
    ?>
        <!-- Name of Request -->
        <td>
            <?php
                echo($row['name']);
            ?>
        </td>
        <!-- Shows if Request is Filled -->
        <td style="text-align: center;">
            <?php
            if($f == 1){
                echo('<span class="glyphicon glyphicon-ok"></span>');
            } else { 
                echo('<span class="glyphicon glyphicon-remove"></span>');
            }
            ?>
        </td>
        <!-- Mini Buttons -->
        <td style="text-align: center;">
            <?php
                if($f == 0){
            ?>
            <a class="btn btn-default btn-xs btn-success" onclick="fillRequest( <?php echo($row['rowid']); ?> )">
                <span class="glyphicon glyphicon-check">
            </a>
            <?php
                } else {
            ?>
            <a class="btn btn-default btn-xs btn-danger" onclick="fillRequest( <?php echo($row['rowid']); ?> )">
                <span class="glyphicon glyphicon-check">
            </a>
            <?php
                }
            ?>
            <a class="btn btn-default btn-xs btn-info" onclick="loadRequests( <?php echo($row['rowid']); ?> )">
                <span class="glyphicon glyphicon-info-sign">
            </a>
            <a class="btn btn-default btn-xs btn-warning" onclick="loadRequests( <?php echo($row['rowid']); ?> )">
                <span class="glyphicon glyphicon-edit">
            </a>
            <a class="btn btn-default btn-xs btn-danger" onclick="deleteRequest(<?php echo($row['rowid']); ?>)">
                <span class="glyphicon glyphicon-remove">
            </a>
        </td>
    </tr>
<!-- Insert ID Information if ID was given to the Request-Function -->
<?php if( $_POST['id'] == $row['rowid'] ){ ?>
</table>
    <div style="margin: 5px;">
        <div class="form-group">
            <label for="editName">Edit Request:</label>
            <input class="form-control" id="editName" placeholder="<?php echo($row['name']); ?>">
        </div>
        <div class="form-group">
            <label for="editComments">Edit Comments:</label>
            <textarea class="form-control" rows="7" id="editComments"><?php echo($row['comments']); ?></textarea>
        </div>
        <button class="btn btn-default btn-success pull-right" onclick="updateRequest(<?php echo($row['rowid']); ?>)">Save</button>
    </div>
    <table class="table table-hover table-condensed table-striped table-bordered">
        <?php
            };
        }; ?>
    </table>
  </div>