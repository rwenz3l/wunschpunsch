<?php

// Includes database connection
include "db_connect.php";


/* Create query with rowid while applying filters..
 * Maybe has more filters in the future
*/

if( isset($_POST['filter']) ) {
    switch ($_POST['filter']){
        case 'all':
            $query = "SELECT rowid, * FROM requests ORDER BY rowid DESC ";
            break;
        case 'open':
            $query = "SELECT rowid, * FROM requests WHERE filled IS 0 ORDER BY rowid DESC";
            break;
        case 'filled':
            $query = "SELECT rowid, * FROM requests WHERE filled IS 1 ORDER BY rowid DESC";
            break;
    }
} else {
    // since js has a default parameter for filter (=all) this is actually unnacessary.
    $query = "SELECT rowid, * FROM requests ORDER BY rowid DESC ";
}

// Run the query and set query result in $result
// Here $db comes from "db_connection.php"
$result = $db->query($query);

?>
<div class="panel panel-default innerTable">
    <div class="panel-heading"></div>
    <table class="table table-hover table-condensed table-striped table-bordered">
        <!-- Table Header -->
        <tr>
            <td>Name</td>
            <td style="text-align: center; width:110px;">Edit</td>
    </tr>
    <!-- Iterate over Database Entries -->
    <?php
    while($row = $result->fetchArray()) {
        // Row Colors according to fullfilled/unfullfilled
        if ($row['filled'] == 1){
    ?>
        <tr class="success" >
    <?php } else { ?>
        <tr class="danger" >
    <?php } ?>
            <!-- Name of Request -->
            <td> <?php echo($row['name']); ?> </td>
            <!-- Mini Buttons -->
            <td style="text-align: center; width:110;">
            <!-- Mini Toggle Filled -->
            <?php if($row['filled'] == 0){ ?>
                <a class="btn btn-default btn-xs btn-success" onclick="fillRequest( <?php echo($row['rowid']); ?> )">
                    <span class="glyphicon glyphicon-check"/>
                </a>
            <?php } else { ?>
                <a class="btn btn-default btn-xs btn-danger" onclick="fillRequest( <?php echo($row['rowid']); ?> )">
                    <span class="glyphicon glyphicon-check"/>
                </a>
            <?php } ?>
            <!-- Mini Edit Button -->
                <a class="btn btn-default btn-xs btn-warning" onclick="loadRequests( <?php echo("id=" . $row['rowid'] . ",filter=lastFilter" )?> )">
                    <span class="glyphicon glyphicon-edit"/>
                </a>
            <!-- Mini Delete Button -->
                <a class="btn btn-default btn-xs btn-danger" onclick="deleteRequest(<?php echo($row['rowid']); ?>)">
                    <span class="glyphicon glyphicon-remove"/>
                </a>
            </td>
        </tr>
        <!-- Insert ID Information if ID was given to the Request-Function -->
        <?php if( isset($_POST['id']) and $_POST['id'] == $row['rowid'] ){ ?>
            <!-- Temporarly Close the Table -->
            </table>
            <!-- Insert a Div with all the Infos -->
            <div style="margin: 5px;">
                <div class="form-group">
                    <label for="editName">Request:</label>
                    <input class="form-control" id="editName" placeholder="<?php echo($row['name']); ?>">
                </div>
                <div class="form-group">
                    <label for="editComments">Comments:</label>
                    <textarea class="form-control" style="max-width:100%;" rows="7" id="editComments"><?php echo($row['comments']); ?></textarea>
                </div>
                <button class="btn btn-default btn-success pull-right" onclick="editRequest(<?php echo("id=" . $row['rowid'] . ",filter=lastFilter") ?>)">Save</button>
                <br><br> <!-- Give me a little Space, god damnit! -->
            </div>
            <table class="table table-hover table-condensed table-striped table-bordered">
        <?php } // Close Insert Condition ?>
    <?php } // Close While Loop ?>
    </table>
    <div class="panel-footer"></div>
</div>
