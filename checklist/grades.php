<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Document</title>
    <style>
       h2 {
    position: relative;
    text-align: center;
    background: #32CD32;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: colorChange .5s linear infinite;
    transition: background-color 0.5s ease;
}

@keyframes colorChange {
    0% {
        background-position: 0 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}

h2::after {
    content: "";
    display: block;
    width: 220px;
    height: 2px;
    background-color: #32CD32;
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
}

.profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    
    border-radius: 25px;
    background-color: #f0f0f0;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 80%;
    margin: 0 auto;
    position: relative;
}

.profile-info {
    width: 100%;
}

.profile-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: 20px;
}

.profile-header h3 {
    font-family: 'Sifonn', sans-serif;
    margin-bottom: 10px;
    color: #32CD32;
}

.student-info {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.left-side,
.right-side {
    width: 45%;
}

.left-side p,
.right-side p {
    margin: 5px 0;
    color: #666;
}

.right-side p:nth-child(1) {
    font-weight: bold;
}

table {
    border-collapse: collapse;
    width: 100%;
    overflow-y: auto; /* This line ensures horizontal scrolling */
    background: whitesmoke;
    table-layout: fixed; /* This makes the table fixed */
}

.container {
    margin-bottom: 5rem;
}

.container h2 {
    padding-top: 1rem;
    font-size: 30px;
}

.container-table {
    display: flex;
    
    flex-direction: column; 
}

.container-table table th {
    border-left: none;
    border-right: none;
}

table, th, td {
    border: 1px solid #e2e9e1;
    border-left: none;
    border-right: none;
    font-size: 10px;
}

.container-table th {
    border-top: none;
}

.container-table table td {
    border-bottom: none;
}

th, td {
    padding: 8px;
    text-align: left;
}

.container-table form {
    display: inline-block;
    vertical-align: top;
}

.container-table form input[type="submit"] {
    width: 100px;
    min-height: 50px;
    
    
    cursor: pointer;
}


.table-box {
    width: 100%;
    border: 1px solid #e2e9e1;
    padding: 15px;
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
    background: whitesmoke;
    box-sizing: border-box;
    overflow-x: auto;
}

.table-box th {
    border: none;
    padding: 8px;
    text-align: left;
}

thead {
    background-color: #333;
    color: white;
}

.navbar .logo img {
    width: 60px;
    height: 60px;
}

.navbar h1 {
    font-size: 20px;
    padding-right: 45rem;
    color: #ccc;
}

.container-table h2 {
    color: #32CD32;
}
form{
    padding-left:37rem;
}
input {
    margin-bottom: 1rem;
    width: 10rem;
    font-size: 15px;
    
}

.table table-bordered table-striped mt-4 {
    border-radius: 15px;
}
    .profile-container .profile-header img{
        width: 60px;
    height: 60px;
    }
    .profile-header h1{
        font-size: 20px;
    }
    </style>
</head>
<body>
<div class="navbar">
    <div class="logo">
        <img src="img/cvsu.png" alt="Logo">
    </div>
    <h1>Cavite State University</h1>
    <ul>
        <li><a href="#"class="active" >Grades</a></li>
        <li><a href="query.php" >Live Search</a></li>
    </ul>
</div>
<div class="container">
    <div class="profile-container">
        <div class="profile-info">
            <div class="profile-header">
            <h2>CHECKLIST</h2>
                <div class="student-info">
                    <div class="left-side">
                        <p><b>Student ID:</b> 202211848</p>
                        <p><b>Phone Number:</b> 09612143188</p>
                        <p><b>Adviser:</b> Edhan Belgica</p>
                    </div>
                    <div class="right-side">
                        <p><b>Name:</b> John Benjamin Santillan</p>
                        <p><b>Course:</b> Bachelor of Science in Computer Science</p>
                        <p><b>Year & Section:</b> 2-7</p>
                    </div>
                </div>
            </div>
        </div>
    
    
    <form method="get" id="searchForm">
        <input type="text" class="form-control" autocomplete="off" placeholder="Search..." id="searchInput">
    </form>
    <div class="container-table">
        <div class="searchresult-form">
            <div class="searchresult">
                <?php include('pagination.php'); ?>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#searchInput").keyup(function(){
            var input = $(this).val();
            if(input !== ""){
                $.ajax({
                    url: "livesearch.php",
                    method: "POST",
                    data: {input: input},
                    success: function(data){
                        $(".searchresult").html(data);
                    },
                    error: function(xhr, status, error){
                        console.error("AJAX Error: " + status + error);
                    }
                });
            } else {
                $.ajax({
                    url: "loadFirstYearData.php",
                    success: function(data){
                        $(".searchresult").html(data);
                    },
                    error: function(xhr, status, error){
                        console.error("AJAX Error: " + status + error);
                    }
                });
            }
        });

       
    });
</script></body>
</html>
