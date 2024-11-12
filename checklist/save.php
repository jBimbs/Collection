<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $host = 'localhost'; // Your host
    $dbname = 'checklist'; // Your database name
    $username = 'root'; // Your database username
    $password = 'jb30033011'; // Your database password

    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve form data
        $year = $_POST["year"]; // Get the selected year
        $semester = $_POST["semester"]; // Get the selected semester
        $search = $_POST["search"]; // Get the search query

        // Check if the instructor already exists in the table
        $checkStmt = $pdo->prepare("SELECT instructor_id FROM instructor WHERE instructor_name = :instructorName");
        $checkStmt->bindParam(':instructorName', $_POST["editInstructorName"]);
        $checkStmt->execute();

        $instructorID = null;
        if ($checkStmt->rowCount() == 0) {
            // If the instructor does not exist, insert it into the instructor table
            $insertStmt = $pdo->prepare("INSERT INTO instructor (instructor_name) VALUES (:instructorName)");
            $insertStmt->bindParam(':instructorName', $_POST["editInstructorName"]);
            $insertStmt->execute();

            // Get the ID of the newly inserted instructor
            $instructorID = $pdo->lastInsertId();
        } else {
            // If the instructor exists, fetch its ID
            $instructorID = $checkStmt->fetch(PDO::FETCH_ASSOC)["instructor_id"];
        }

        // Determine the table name based on the selected year
        $tableName = "";
        switch ($year) {
            case '1':
                $tableName = "first_year";
                break;
            case '2':
                $tableName = "second_year";
                break;
            case '3':
                $tableName = "third_year";
                break;
            case '4':
                $tableName = "fourth_year";
                break;
            default:
                $tableName = "first_year"; // Default to first year
                break;
        }

        // Insert grade information into the selected year table
        $insertGradeStmt = $pdo->prepare("INSERT INTO $tableName (student_number, course_code, grade_id, instructor_id, semester) VALUES (:studentNumber, :courseCode, :gradeID, :instructorID, :semester)");
        $insertGradeStmt->bindParam(':studentNumber', $_POST["editStudentNumber"]);
        $insertGradeStmt->bindParam(':courseCode', $_POST["editCourseCode"]);
        $insertGradeStmt->bindParam(':gradeID', $_POST["editGradeID"]);
        $insertGradeStmt->bindParam(':instructorID', $instructorID);
        $insertGradeStmt->bindParam(':semester', $semester);
        $insertGradeStmt->execute();

        // Redirect back to the previous page or display a success message
        header("Location: grades.php");
        exit();
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Error: " . $e->getMessage();
    }
}
?>
