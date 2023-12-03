

<?php include "init/db.php"; ?>

<?php include "init/init.php"; ?>



<?php

if (!empty($maintaince)){

    header('Location: maintenance');

    die('Maintenance'. $maintaince);

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
    <title><?php echo htmlspecialchars($sitename); ?> | Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .success,  .error {
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
        	.error{
			color: #D8000C;
			background-color: #FFBABA;
            background-image: url('./css/svg/xmark-solid.svg');
		
        }
        html,body{
  display: grid;
  height: 100%;
  width: 100%;
  place-items: center;
  font-family: 'Poppins', sans-serif;
  background: -webkit-linear-gradient(left, #a445b2, #fa4299);
}
        
        .login-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color:rgba(255, 255, 255, 0.88);
            min-width: 35%;
            margin: 0 auto;
             border-radius: 15%;
             border: 2px solid white;
            font-family: 'Poppins', sans-serif;

        }
                    input[type=email], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 12px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;


  outline: none;
  color: #999;
  border-radius: 5px;
  border: 1px solid lightgrey;
  border-bottom-width: 2px;
  font-size: 17px;
  transition: all 0.3s ease;
            }
            input[type=email], input[type=password]:focus::placeholder{
             color: #b3b3b3;
}
input[type=email], input[type=password]::placeholder{
  color: #999;
  transition: all 0.3s ease;
}
 .pass-link a{
  color: rgb(255, 0, 38, 1);
  text-decoration: none;
}
.pass-link a:hover,
.signup-link a:hover{
  text-decoration: underline;
}
        form {
            max-width: 30rem;
        }
        button {
            background: -webkit-linear-gradient(left, #a445b2, #fa4299);
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
            opacity: 0.8;
            }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <!-- <label for="email">Email:</label><br> -->
            <input type="email" id="email" name="email" placeholder="Email Address" required>
            <br>
            <!-- <label for="password">Password:</label><br> -->
            <input type="password" id="password" name="password" placeholder="Password"  required>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <br>
            <button type="submit" name="login" value="login">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>