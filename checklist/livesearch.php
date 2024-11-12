<?php
include("config.php");

if (isset($_POST['input'])) {
    $input = $_POST['input'];
    
    $query = "
        SELECT 
            *,
            IF(
                (CAST(grade AS DECIMAL(3, 2)) <= 3 AND grade IS NOT NULL),
                'Passed',
                'Unpassed'
            ) AS status
        FROM wholeChecklist 
        WHERE course_code LIKE '%$input%' 
        OR course_title LIKE '%$input%' 
        OR credit_unit_lecture LIKE '%$input%' 
        OR credit_unit_lab LIKE '%$input%' 
        OR contact_hours_lecture LIKE '%$input%' 
        OR contact_hours_lab LIKE '%$input%' 
        OR grade LIKE '%$input%' 
        OR instructor_name LIKE '%$input%' 
        OR semester LIKE '%$input%' 
        OR year_level LIKE '%$input%'
    ";

    $result = mysqli_query($con, $query);
    echo "<style>
    table {
        border-radius: 15px;
        width: 100%;
        border-collapse: collapse;
    }
    thead {
        background-color: #333;
        color: white;
    }
    .passed {
        color: #2db92d;
    }
    .unpassed {
        color: red;
    }
    tfoot {
        background-color: #f1f1f1;
    }
    .btn-content{
        width: 150px;
        padding: 15px 0;
        text-align: center;
        margin: 20px 10px;
        border-radius: 25px;
        font-weight: bold;
        border: solid 2px #ffd800;
        background: transparent;
        color: #fff;
        cursor: pointer;
        position: relative;
        animation-delay: 0.8s;
        overflow: hidden;
    }
    .btn-content a{
        text-decoration: none;
        padding-top: .7rem;
        color: #ffd800  ;
    }
    .btn-content a:hover{
        color: whitesmoke;
        transition: 0.5s ease;
    }
    span{
        background: black;
        height: 100%;
        width: 0;
        border-radius: 25px;
        position: absolute;
        bottom: 0;
        left: 0;
        z-index: -1;
        transition: 0.5s ease;
    }

    .btn-content:hover span{
        width: 100%;
    }
    .btn-content:hover{
        border: none;
        color: whitesmoke;
    }
    button{
        width:100px;
        height:50px;
        font-size:10px;
        border-radius:15px;
        cursor:pointer;
    }
    button:hover{
        backround:green;
    }
    </style>";

    if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-bordered table-striped mt-4">
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
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { 
                    $status_class = $row['status'] == 'Passed' ? 'passed' : 'unpassed';
                ?>
                    <tr>
                        <td><?php echo $row['course_code']; ?></td>
                        <td><?php echo $row['course_title']; ?></td>
                        <td><?php echo $row['credit_unit_lecture']; ?></td>
                        <td><?php echo $row['credit_unit_lab']; ?></td>
                        <td><?php echo $row['contact_hours_lecture']; ?></td>
                        <td><?php echo $row['contact_hours_lab']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                        <td><?php echo $row['instructor_name']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td><?php echo $row['year_level']; ?></td>
                        <td class="<?php echo $status_class; ?>"><?php echo $row['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="11" style="text-align: center;">
                        <button onclick="handleButtonClick()">Reload Checklist</button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <script>
            function handleButtonClick() {
                window.location.href = 'grades.php';
            }
        </script>
    <?php } else {
        echo "<h6 class='text-danger text-center mt-3'>NO DATA FOUND</h6>";
    }
}
?>
