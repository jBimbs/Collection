<?php
// Establish database connection (replace these values with your actual database credentials)
$host = 'localhost';
$dbname = 'checklist';
$username = 'root';
$password = 'jb30033011';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the search query from the AJAX request
    $search = $_GET["search"];

    // Construct a more comprehensive search query to include every letter of every data possibly it matches
    $searchQuery = implode('%', str_split($search)) . '%';

    // Prepare and execute the query to fetch grades with actual grade values, instructor names, and semesters based on the search query
    $stmt = $pdo->prepare("SELECT fy.student_number, fy.course_code, fy.semester, g.grade, i.instructor_name FROM your_table_name fy INNER JOIN grade g ON fy.grade_id = g.grade_id INNER JOIN instructor i ON fy.instructor_id = i.instructor_id WHERE (fy.student_number LIKE :search OR fy.course_code LIKE :search OR g.grade LIKE :search OR i.instructor_name LIKE :search)");
    $stmt->bindParam(':search', $searchQuery);
    $stmt->execute();
    $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Start HTML table
    $output = "<table border='1'>";
    $output .= "<tr><th>Student Number</th><th>Course Code</th><th>Semester</th><th>Grade</th><th>Instructor</th></tr>";
    
    // Output table data
    foreach ($grades as $grade) {
        $output .= "<tr>";
        $output .= "<td>".$grade['student_number']."</td>";
        $output .= "<td>".$grade['course_code']."</td>";
        $output .= "<td>".$grade['semester']."</td>"; // Display semester
        $output .= "<td>".$grade['grade']."</td>"; // Displaying the actual grade from the grade table
        $output .= "<td>".$grade['instructor_name']."</td>"; // Displaying the instructor name from the instructor table
        $output .= "</tr>";
    }
    
    // End HTML table
    $output .= "</table>";

    // Return the table content
    echo $output;
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Error: " . $e->getMessage();
}
?>
