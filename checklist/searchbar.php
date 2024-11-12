<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Document</title>
    <style>
        /* Your existing CSS styles here */
    </style>
</head>
<body>
<div class="navbar">
    <ul>
        <li><a href="#" class="active" >CheckList</a></li>
        <li><a href="#"class="active" >Search</a></li>
        <li><a href="query.php" >Query</a></li>
    </ul>
</div>
<div class="container">
    <div class="container-table">
        <h2>CHECKLIST</h2>
        <form method="get" id="searchForm">
            <input type="text" class="form-control" autocomplete="off" placeholder="Search..." id="searchInput">
        </form>
        <div class="searchresult"></div>

       
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
