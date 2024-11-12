<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student's Checklist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .profile {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        .profile-info {
            flex: 1;
            margin-left: 20px;
        }
        .profile-info h2 {
            margin-top: 0;
            color: #333;
        }
        .profile-info p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        #searchInput, #queryInput {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Student's Checklist</h1>
    
    <div class="profile">
        <img src="profile_pic.jpg" alt="Profile Picture">
        <div class="profile-info">
            <h2>Raina</h2>
            <p>Student ID: 123456</p>
            <p>Program: Computer Science</p>
            <p>Batch: 2022</p>
        </div>
    </div>

    <!-- Search Bar -->
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for course code..">

    <!-- Query Input
    <input type="text" id="queryInput" placeholder="Enter your SQL query here..">
    <button onclick="executeQuery()">Execute Query</button> -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="query">Enter your SQL query:</label><br>
                <textarea id="query" name="query" rows="5" cols="50"></textarea><br><br>
                <button class="btn-content" type="submit">SUBMIT
            <span></span></button>
            </form>

    

    <!-- Executed Query
    <div id="executedQuery"></div> -->

    <table id="courseTable">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Final Grade</th>
                <th>Instructor ID</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost"; // your MySQL server hostname (usually localhost)
            $username = "root"; // your MySQL username
            $password = ""; // your MySQL password
            $database = "checklist"; // your MySQL database name

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to fetch data
            $sql = "SELECT student_id, course_code, course_name, final_grade, instructor_id, semester
FROM first_yr
UNION ALL
SELECT student_id, course_code, course_name, final_grade, instructor_id, semester
FROM second_yr
UNION ALL
SELECT student_id, course_code, course_name, final_grade, instructor_id, semester
FROM third_yr
UNION ALL
SELECT student_id, course_code, course_name, final_grade, instructor_id, semester
FROM fourth_yr;
"; // Replace 'your_table_name' with the actual table name

            // Executing query
            $result = $conn->query($sql);

            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["student_id"] . "</td>";
                    echo "<td>" . $row["course_code"] . "</td>";
                    echo "<td>" . $row["course_name"] . "</td>";
                    echo "<td>" . $row["final_grade"] . "</td>";
                    echo "<td>" . $row["instructor_id"] . "</td>";
                    echo "<td>" . $row["semester"] . "</td>"; 
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>0 results</td></tr>";
            }

            // Close connection
            $conn->close();
            
            ?>
        </tbody>
    </table>
</div>



<script>
    function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("courseTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those that don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Index 1 for course code column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    //  function executeQuery() {
    //     // Get the SQL query from the textarea
    //     var query = document.getElementById("queryInput").value;
    //     var executedQuery = document.getElementById("executedQuery");
    //     executedQuery.innerText = "Executed Query: " + query;

    //     // Send an AJAX request to execute_query.php with the query
    //     var xhr = new XMLHttpRequest();
    //     xhr.open("POST", "execute_query.php", true);
    //     xhr.setRequestHeader("Content-Type", "application/json");
    //     xhr.onreadystatechange = function () {
    //         if (xhr.readyState === 4 && xhr.status === 200) {
    //             // Parse the JSON response
    //             var data = JSON.parse(xhr.responseText);
    //             // Display the fetched data in the table
    //             displayData(data);
    //         }
    //     };
    //     xhr.send(JSON.stringify({ query: query }));
    // }

    // function displayData(data) {
    //     // Get the table body element
    //     var tableBody = document.getElementById("tableBody");
    //     // Clear existing table rows
    //     tableBody.innerHTML = "";
    //     // Populate the table with fetched data
    //     data.forEach(function (row) {
    //         var tr = document.createElement("tr");
    //         tr.innerHTML = `
    //             <td>${row.student_id}</td>
    //             <td>${row.course_code}</td>
    //             <td>${row.course_name}</td>
    //             <td>${row.final_grade}</td>
    //             <td>${row.instructor_id}</td>
    //             <td>${row.semester}</td>
    //         `;
    //         tableBody.appendChild(tr);
    //     });
    // }
</script>

</body>
</html>