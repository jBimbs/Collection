<?php
// edit.php

// Handle the edit action
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $gradeId = $_POST["grade_id"];
    $instructorId = $_POST["instructor_id"];

    // Perform the edit action (for example, update the database)

    // Return a response (you can return success or failure)
    echo json_encode(array("success" => true));
} else {
    // Return an error response if the request method is not POST
    echo json_encode(array("error" => "Invalid request method"));
}
?>
a