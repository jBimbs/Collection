<?php
include('config.php');

// Define rows per page
$rows_per_page = 9;

// Determine which page to display based on a query parameter
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Default to page 1
$offset = ($page - 1) * $rows_per_page; // Calculate offset for the query

// SQL query to get the total number of rows
$count_sql = "SELECT COUNT(*) AS total FROM wholeChecklist"; 
$total_result = mysqli_query($con, $count_sql);
$total_rows = mysqli_fetch_assoc($total_result)['total'];
$total_pages = ceil($total_rows / $rows_per_page); // Total number of pages

// Modified SQL query to fetch data with the correct "Status" logic
$sql = "
  SELECT
    *,
    IF(
      (CAST(grade AS DECIMAL(3, 2)) <= 3 AND grade IS NOT NULL),
      'Passed',
      'Not Taken'
    ) AS status
  FROM
    wholeChecklist
  LIMIT $rows_per_page
  OFFSET $offset
";

// Execute the query
$result = mysqli_query($con, $sql);

// Add CSS for round pagination buttons
echo "<style>
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
.pagination a, .pagination strong {
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;
    padding: 10px 15px;
    margin: 0 5px;
    border-radius: 50%;
    text-decoration: none;
    color: #2db92d;
    display: inline-block;
    text-align: center;
}
.pagination strong {
    background-color: #2db92d;
    color: #fff;
}
.pagination a:hover {
    background-color: #ddd;
}
table{
    border-radius:15px;
}
thead{
    background-color:#333;
    color:white;
}
</style>";

// Render table and pagination if there are results
if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-bordered table-striped mt-4'>
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Credit Unit (Lecture)</th>
                    <th>Credit Unit (Lab)</th>
                    <th>Contact Hours (Lecture)</th>
                    <th>Contact Hours (Lab)</th>
                    <th>Grade</th>
                    <th>Instructor</th>
                    <th>Semester</th>
                    <th>Year Level</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>";

    $total_grade = 0;
    $num_rows = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $status_color = $row['status'] == 'Passed' ? '#2db92d' : 'red';
        echo "<tr>
                <td>{$row['course_code']}</td>
                <td>{$row['course_title']}</td>
                <td>{$row['credit_unit_lecture']}</td>
                <td>{$row['credit_unit_lab']}</td>
                <td>{$row['contact_hours_lecture']}</td>
                <td>{$row['contact_hours_lab']}</td>
                <td>{$row['grade']}</td>
                <td>{$row['instructor_name']}</td>
                <td>{$row['semester']}</td>
                <td>{$row['year_level']}</td>
                <td style='color: $status_color;'>{$row['status']}</td>
               
              </tr>";

        // Accumulate grades for GWA calculation
        $total_grade += (float)$row['grade']; // Convert grade to float
        $num_rows++;
    }

    // Calculate GWA
    $gwa = $num_rows > 0 ? $total_grade / $num_rows : 0;

    // Display GWA at the bottom of the grade column
    echo "<tr><td colspan='6'></td><td><strong>GWA: $gwa</strong></td></tr>";

    echo "</tbody>
          </table>";

    // Pagination logic
    echo "<div class='pagination'>";

    if ($page > 1) {
        echo "<b><a class='prev-btn'href='?page=" . ($page - 1) . "'><<</a></b>"; // Previous page link
    }

    for ($i = 1; $i <= $total_pages; $i++) { // Loop for individual page numbers
        if ($i == $page) {
            echo "<strong>$i</strong>"; // Highlight the current page
        } else {
            echo "<a href='?page=$i'>$i</a>"; // Link to specific pages
        }
    }

    if ($page < $total_pages) { // If not on the last page
        echo "<b><a  class='next-btn' href='?page=" . ($page + 1) . "'>>></a></b>"; // Next page link
    }

    echo "</div>"; // Close the pagination div

} else {
    echo "No data found in wholeChecklist."; // If no data is available
}

// Close the database connection
mysqli_close($con); 
?>
