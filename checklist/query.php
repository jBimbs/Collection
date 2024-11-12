<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <title>Checklist</title>
    <style>
        h2 {
            position: relative;
            text-align: center; /* Center the text */
        }

        h2::after {
            content: "";
            display: block;
            width: 350px; /* Adjust width */
            height: 2px; /* Adjust height */
            background-color: black; /* Adjust color */
            position: absolute;
            bottom: -10px; /* Adjust position */
            left: 50%; /* Position in the middle */
            transform: translateX(-50%); /* Center horizontally */
        }
        textarea{
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        }
        textarea#query {
            width: 100%; 
            height: 100px; 
            resize: none; 
        }
        button.btn-content {
            width: 100px; /* Adjust width */
            min-height: 50px; /* Adjust height */
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        button.btn-content span {
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

        button.btn-content:hover span {
            width: 100%;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: whitesmoke;
            padding-top: 15rem; /* Adjust this value as needed */
        }
        .container-table table th{
            border-left: none;
            border-right: none;
        }
        table, th, td {
            border: 1px solid #e2e9e1;
            border-left: none;
            border-right: none;
            font-size:15px;
        }
        .container-table th{
            border-top: none;
        }
        .container-table table td{
            border-bottom: none;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .container-table input{
            width:200px;
            font-size: 20px;
            height: 20px;
        }
        .searchresult-form{
          margin-top: 2rem;
    width: 100%; /* Adjust as needed */
    border: 1px solid #e2e9e1;
    padding: 15px;
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1); /* Adjust shadow properties as needed */
    background: whitesmoke;
    box-sizing: border-box;
    overflow-x: auto; /* Enable horizontal scrolling if needed */
}   
.searchresult th {
    border: none;
    padding: 8px;
    text-align: left;
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
        <li><a href="grades.php" >Grades</a></li>
        <li><a href="#"class="active" >Live Search</a></li>
    </ul>
</div>
    <div class="container">
        <div class="container-table">
        <form method="get" id="searchForm">
            <input type="text" class="form-control" autocomplete="off" placeholder="Search..." id="searchInput">
        </form>
        <div class="searchresult-form">
            <div class="searchresult"></div>

            
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
                            }
                        });
                    } else {
                        $(".searchresult").css("display", "none");
                    }
                });
            });
        </script>
</body>
</html>
