/*jslint browser: true*/
/*global $, jQuery, alert*/
var lastID = null; // Init last req. ID for Toggle

// Prepare DOM
$(document).ready(function () {
    loadRequests();
});

$(function(){
    /* this will be called when the DOM is ready */
    $("#requestInput").keyup(function (event) {
        /* console.log("KeyUp: " + event.which); */
        if (event.which === 13) {
            addRequest();
        }
    });
});

function loadRequests(id) {
    /* console.log("called with id:" + id); */
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
        url: "include/addRequest.php",
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
        url: "include/deleteRequest.php",
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
        url: "include/fillRequest.php",
        success: function (response) {
            console.log("Server says: " + response);
            loadRequests();
        }
    });
}

function editRequest(id) {
    var name = document.getElementById("editName").value;
    var comments = document.getElementById("editComments").value;
    $.ajax({
        type: "post",
        data: {
            'id': id,
            'name' : name,
            'comments' : comments
        },
        url: "include/editRequest.php",
        success: function (response) {
            console.log("Server says: " + response);
            loadRequests();
        }
    });
}