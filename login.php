<?php include "init/db.php"; ?>

<?php include "init/init.php"; ?>



<?php

if (!empty($maintaince)) {

    header('Location: maintenance');

    die('Maintenance' . $maintaince);

}



if ($user->LoggedIn()) {

    header('Location: dashboard.php');

    exit;

}


//Check if the user is already logged in, redirect to home page if true
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please fill the email and password fields!!";
    } else {
        // Validate the user against the database
        $stmt = $db->prepare("SELECT uid, username ,name, password FROM users WHERE username = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Authentication successful
            $_SESSION['user_id'] = $user['uid'];
            $_SESSION['user_name'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password!!";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo htmlspecialchars($sitename); ?> | Login Page
    </title>
    <script src="https://kit.fontawesome.com/1b2b1806df.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .success,
        .error {
            border: 2px solid;
            border-radius: 5px;
            margin: 10px 0px;
            padding: 15px 10px 15px 50px;
            background-repeat: no-repeat;
            background-position: 10px center;
        }

        .success {
            color: #4F8A10;
            background-color: #DFF2BF;
            background-image: url('./css/svg/check-solid.svg');
        }

        .error {
            color: #D8000C;
            background-color: #FFBABA;
            background-image: url('./css/svg/xmark-solid.svg');

        }

        html,
        body {
            display: grid;
            height: 100%;
            width: 100%;
            place-items: center;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            /* background: -webkit-linear-gradient(left, #a445b2, #fa4299); */
            background: rgb(233, 62, 88);
            background: linear-gradient(248deg, rgba(233, 62, 88, 1) 18%, rgba(141, 87, 64, 1) 49%, rgba(5, 128, 129, 1) 79%);
        }

        .login-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.88);

            margin: 0 auto;
            max-width: 26rem;
            width: 90%;

            border-radius: 15%;
            border: 2px solid white;
            font-family: 'Poppins', sans-serif;

        }

        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 12px 0;
            display: inline-block;
            box-sizing: border-box;


            outline: none;
            color: #999;
            border-radius: 5px;
            border: 1px solid lightgrey;
            border-bottom-width: 2px;
            font-size: 17px;
            transition: all 0.3s ease;
        }

        input[type=email],
        input[type=password]:focus::placeholder {
            color: #b3b3b3;
        }

        input[type=email],
        input[type=password]::placeholder {
            color: #999;
            transition: all 0.3s ease;
        }

        .pass-link a {
            color: rgb(255, 0, 38, 1);
            text-decoration: none;
        }

        .pass-link a:hover,
        .signup-link a:hover {
            text-decoration: underline;
        }

        .login-container>form:nth-child(2)>a:nth-child(12) {
            padding: 0 5rem;

            text-decoration: none;
        }

        button {
            background: #058081;
            border-radius: 5px;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 1.2rem;
        }

        button:hover {
            opacity: 0.9;
            transition: ease-out cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        a:hover {
            opacity: 0.9;
            transition: ease-out cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .link {
            position: relative;
            transition: color .3s ease-in-out;

            &::before {
                content: '';
                position: absolute;
                top: 100%;
                width: 100%;
                height: 3px;
                background-color: #D65472;
                transform: scaleX(0);
                transition: transform .3s ease-in-out;
            }

            &:hover {
                color: #D65472;
            }

            &:hover::before {
                transform: scaleX(1);
            }
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p class="error">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>
        <form method="POST" action="">
            <!-- <label for="email">Email:</label><br> -->
            <input type="email" id="email" name="email" placeholder="Email Address" required>
            <br>
            <!-- <label for="password">Password:</label><br> -->
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <br>
            <button type="submit" name="login" value="login">Login</button>
        </form>
        <p>Don't have an account? <a class="link" href="register.php">Register here</a></p>
        <a class="link" href="index.php">back to homepage <i class="fa-solid fa-house fa-lg"
                style="color: #000040;"></i></a>
    </div>
</body>

</html>