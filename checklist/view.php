<?php
include "connection.php";

$student_no = $_GET['student_no'];
$column = $_GET['column'];

if(isset($_POST['input'])) {
    $input = $_POST['input'];

    if($column != "") {
        $search = "SELECT * FROM wholeChecklist WHERE student_number = '$student_no' AND $column LIKE '{$input}%'";
    } else {
        echo "<h5 class='text-danger text-center mt-3'>Select a column</h5>";
    }
    $query = mysqli_query($connection, $search);
    if(mysqli_num_rows($query) > 0) {
        $result = array();
        while($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
        ?>
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Title</th>
                    <th scope="col">Credit Unit</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Year</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Instructor Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $key) { ?>
                <tr>
                    <td scope="row"><?php echo $key['course_code']; ?></td>
                    <td><?php echo $key['course_title']; ?></td>
                    <td><?php echo $key['credit_unit']; ?></td>
                    <td><?php echo $key['semester']; ?></td>
                    <td><?php echo $key['year_level']; ?></td>
                    <td><?php echo $key['grade']; ?></td>
                    <td><?php echo $key['instructor_name']; ?></td>
                    <td><a href="editChecklist.php?<?php echo "student_no=".$student_no."&course_code=".$key['course_code']."&year_level=".$key['year_level']; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<h5 class='text-danger text-center mt-3'>Data not found.</h5>";
    }
}
?>