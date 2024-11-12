<?php
include 'config.php';

try {
    // Ensure $pdo is defined and is a PDO object
    if (!isset($pdo)) {
        throw new Exception('Database connection not properly initialized.');
    }

    $stmt = $pdo->query("SELECT * FROM wholeChecklist WHERE year_level = 'First Year'");
    $firstYearData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($firstYearData) {
        echo "<table>
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
                    </tr>
                </thead>
                <tbody>";

        foreach ($firstYearData as $row) {
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
                  </tr>";
        }

        echo "  </tbody>
              </table>";
    } else {
        echo "No data found for the first year.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
