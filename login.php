

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
        body {font-family: Arial, Helvetica, sans-serif;}
        .login-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 40%;
            margin: 0 auto;
             
                background: -webkit-linear-gradient(to right, #C4E0E5, #4CA1AF);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #C4E0E5, #4CA1AF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
                    input[type=email], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            }

        form {
            max-width: 30rem;
        }
        button {
        background-color: #4CA1AF;
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
<?php include("init/header.php") ?>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit" name="login" value="login">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>