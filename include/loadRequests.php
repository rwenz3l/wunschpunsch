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
      <?php while($row = $result->fetchArray()) {?>
      <tr>
        <!-- Name of Request -->
        <td><?php echo $row['name'];?></td>
        <!-- Shows if Request is Filled -->
        <td style="text-align: center;">
          <?php
          $f = (1 == $row['filled']) ? true : false;
          if($f == true){ echo('<span class="glyphicon glyphicon-ok"></span>'); } else { echo('<span class="glyphicon glyphicon-remove"></span>'); } ?>
                </td>

                <td style="text-align: center;">
                    <a class="btn btn-default btn-xs" onclick="loadRequests(<?php echo($row['rowid']); ?>)">
                        <span class="glyphicon glyphicon-info-sign">
          </a>
          <!-- include/delete.php?id=<?php echo $row['rowid'];?> -->
          <a class="btn btn-default btn-xs" onclick="deleteRequest(<?php echo($row['rowid']); ?>)">
            <span class="glyphicon glyphicon-remove">
          </a>
        </td>
      </tr>
    <!-- Insert ID Information if ID was given to the Request-Function -->
    <?php if( $_POST['id'] == $row['rowid'] ){ ?>
        </table>
        <div style="margin: 20px auto; padding: 5px;"> <?php echo($row['rowid']); ?> </div>
            <table class="table table-hover table-condensed table-striped table-bordered">
        <?php
            };
        }; ?>
    </table>
  </div>
