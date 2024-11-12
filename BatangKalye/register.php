<?php
@include 'connection.php';

$registration_errors = [];

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = $_POST['password'];
    $confirm_password = $_POST['cpassword'];
    $dateCreated = date('Y-m-d H:i:s'); // Current date and time
    if(empty($username) || empty($password) || empty($confirm_password)) {
        $registration_errors[] = 'All fields are required.';
    } else {
        if($password != $confirm_password) {
            $registration_errors[] = 'Password does not match the confirm password.';
        } else {
            $select_query = "SELECT * FROM user WHERE user_name = '$username'";
            $result = mysqli_query($conn, $select_query);

            if(mysqli_num_rows($result) > 0) {
                $registration_errors[] = 'Username already exists.';
            } else {
                $insert_query = "INSERT INTO user (user_name, password, date) VALUES ('$username', '$password','$dateCreated')";
                mysqli_query($conn, $insert_query);
                echo "<script>alert('Added successfully'); window.location.href = 'register.php';</script>";
                header('Location: login.php');
                exit;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        *,
        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom right, #391840, #401833, #251840);
        }

        .container {
            width: 50vw;
            height: 60vh;
            display: grid;
            grid-template-columns: 100%;
            grid-template-areas: "login";
            box-shadow: 0 0 17px 10px rgb(0 0 0 / 30%);
            border-radius: 20px;
            background: white;
            overflow: hidden;
        }

        .design {
            grid-area: design;
            display: none;
            position: relative;
        }

        .rotate-45 {
            transform: rotate(-45deg);
        }

        .design .pill-1 {
            bottom: 0;
            left: -40px;
            position: absolute;
            width: 80px;
            height: 200px;
            background: linear-gradient(#682a76, #89379c, #9c377d);
            border-radius: 40px;
        }

        .design .pill-2 {
            top: -100px;
            left: -80px;
            position: absolute;
            height: 450px;
            width: 220px;
            background: linear-gradient(#682a76, #89379c, #9c377d);
            border-radius: 200px;
            border: 30px solid #e2c5e2;
        }

        .design .pill-3 {
            top: -100px;
            left: 160px;
            position: absolute;
            height: 200px;
            width: 100px;
            background: linear-gradient(#682a76, #89379c, #9c377d);
            border-radius: 70px;
        }

        .design .pill-4 {
            bottom: -180px;
            left: 220px;
            position: absolute;
            height: 300px;
            width: 120px;
            background: linear-gradient( #9c377d,#682a76);
            border-radius: 70px;
        }

        .login {
            grid-area: login;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            background: white;
        }

        .login h3.title {
            margin: 15px 0;
        }

        .text-input {
            background: #e6e6e6;
            height: 40px;
            display: flex;
            width: 60%;
            align-items: center;
            border-radius: 10px;
            padding: 0 15px;
            margin: 5px 0;
        }

        .text-input input {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            height: 100%;
            margin-left: 10px;
        }

        .text-input i {
            color: #686868;
        }

        ::placeholder {
            color: #9a9a9a;
        }

        .login-btn {
            width: 68%;
            padding: 10px;
            color: white;
            background: linear-gradient(to right,#682a76, #89379c, #9c377d);
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 10px;
        }

        a {
            font-size: 12px;
            color: #9a9a9a;
            cursor: pointer;
            user-select: none;
            text-decoration: none;
        }

        a.forgot {
            margin-top: 15px;
        }

        .create {
            display: flex;
            align-items: center;
            position: absolute;
            bottom: 30px;
        }

        .create i {
            color: #9a9a9a;
            margin-left: 10px;
        }

        @media (min-width: 768px) {
            .container {
                grid-template-columns: 50% 50%;
                grid-template-areas: "design login";
            }

            .design {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="design">
            <!-- Your design elements here -->
        </div>
        <div class="login">
            <h3 class="title">User Registration</h3>
            <?php if(!empty($registration_errors)): ?>
                <div class="error-message">
                    <?php foreach($registration_errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form id="registerForm" action="register.php" method="post">
                <div class="text-input">
                    <i class="ri-user-fill"></i>
                    <input type="text" name="user_name" placeholder="Username" required>
                </div>
                <div class="text-input">
                    <i class="ri-lock-fill"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="text-input">
                    <i class="ri-lock-fill"></i>
                    <input type="password" name="cpassword" placeholder="Confirm Password" required>
                </div>
                <button type="submit" name="submit" class="login-btn">REGISTER</button>
            </form>
            <a href="login.php" class="forgot">Already have an account?</a>
        </div>
    </div>
</body>

</html>
