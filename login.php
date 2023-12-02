

<?php include "init/db.php"; ?>

<?php include "init/init.php"; ?>



<?php




// if ($user->LoggedIn()) {

//     header('Location: dashboard.php');

//     exit;

// }





// if (!empty($_POST['login'])) {

//     $username = $_POST['email'];

//     $password = $_POST['password'];



//     //Check username exists

//     $SQLCheckLogin = $db->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username");

//     $SQLCheckLogin->execute(array(':username' => $username));

//     $countLogin = $SQLCheckLogin->fetchColumn(0);



//     if (!$countLogin == 1) {



//         $error = "اسم المستخدم غير مسجل";

//     }

//     // Check if password is corredt

//     $SQLCheckpass = $db->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username AND `password` = :password");

//     $SQLCheckpass->execute(array(':username' => $username, ':password' => SHA1(md5($password))));

//     $countpass = $SQLCheckpass->fetchColumn(0);

//     if (!$countpass == 1) {



//         $error = ' هناك خطأ ما  ';

//     }

 

//     //Insert login log and log in

//     if (empty($error)) {

//         $SQL = $db->prepare("SELECT * FROM `users` WHERE `username` = :username");
//         $SQL->execute(array(':username' => $username));

//         $userInfo = $SQL->fetch();

//         $_SESSION['username'] = $userInfo['username'];

//         $_SESSION['id'] = $userInfo['id'];

//         header('Location: dashboard.php');

//         exit;

//     }

// }

// ?>







 

<?php


//Check if the user is already logged in, redirect to home page if true
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Handle login logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user inputs (you can add more validation)
    if (empty($email) || empty($password)) {
        $error = "All fields are required";
    } else {
        // Validate the user against the database
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Authentication successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($sitename); ?> |Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <style>
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
            background-color:rgba(255, 255, 255, 0.5);
            width: 30%;
            margin: 0 auto;
             border-radius: 15%;
             border: 2px solid white;
            font-family: 'Poppins', sans-serif;

        }
                    input[type=email], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0;
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
  color: rgba(16, 10, 13, 0.88);
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