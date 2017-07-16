/*jslint browser: true*/
/*global $, jQuery, alert*/
var lastID = null; // Init last req. ID for Toggle


function loadRequests(id) {
    console.log("called with id:" + id);
    if (id === lastID) {
        lastID = id = null; // Reset ID
    } else {
        lastID = id;
    }
    $.ajax({
        type: 'post',
        data: {
            'id': id
        },
        url: 'include/loadRequests.php',
        success: function (response) {
            // We get the element having id of display_info and put the response inside it
            $('#requestsTable').html(response);
        }
    });
}

/* Add Request to Database */
function addRequest() {
    // Get Data from Input field
    var data = document.getElementById("requestInput").value;
    if (!$.trim(data)) {
        alert("You can not request nothing." + data);
        return;
    } else {
        console.log("Data = " + data);
    }
    // Perform Ajax Call 
    // (Hint: request_data goes to php as post parameter)
    $.ajax({
        type: "post",
        data: {
            'request_data': data
        },
        url: "include/insert.php",
        success: function (response) {
            console.log("Server says: " + response);
            loadRequests();
        }
    });
    // Element zurücksetzen
    document.getElementById("requestInput").value = "";
    return;
};

function deleteRequest(id) {
    var answer = confirm("Eintrag löschen?")
    if (!answer) {
        return;
    }
    console.log("Delete id: " + id)
    $.ajax({
        type: "post",
        data: {
            'id': id
        },
        url: "include/delete.php",
        success: function (response) {
            console.log("Server says: " + response);
            loadRequests();
        }
    });
}

function fillRequest(id) {
    $.ajax({
        type: "post",
        data: {
            'id': id
        },
        url: "include/update.php",
        success: function (response) {
            console.log("Server says: " + response);
            loadRequests();
        }
    });
}

function updateRequest(id) {
    var name = document.getElementById("editName").value;
    var comments = document.getElementById("editComments").value;
    $.ajax({
        type: "post",
        data: {
            'id': id,
            'name' : name,
            'comments' : comments
        },
        url: "include/update.php",
        success: function (response) {
            console.log("Server says: " + response);
            loadRequests();
        }
    });
}

$(document).ready(function () {
    loadRequests();
});

$('requestInput').keydown(function (event) {
    console.log(event);
    var keypressed = event.keyCode || event.which;
    if (keypressed == 13) {
        addRequest();
    }
});
