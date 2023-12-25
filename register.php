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



?>


<?php



ob_start();





if (!empty($_POST['signup'])) {

  $name = $_POST['name'];

  $email = $_POST['email'];

  $password = $_POST['password'];

  $rpassword = $_POST['password2'];

  if (empty($name) || empty($email) || empty($password) || empty($rpassword)) {

    $error = "please fill all the missing blanks !!";

  }
  $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/';

  if (!preg_match($regex, $password)) {
    $error = 'you entered password or confirm password not correctly !!';
    $error = 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and the length must be 8 or more characters!';

  } elseif ($password !== $rpassword) {
    $error = 'The password and confirm password do not match!';
  }
  



  //Check if the username is legit
  $regex1 = '/^[a-zA-Z0-9._-]+@[a-zA-Z-_]+\.[a-zA-Z]{2,}$/';

if (strlen($email) < 6 || strlen($email) > 100) {
    $error = 'Email length is not valid!';
} elseif (!preg_match($regex1, $email)) {
    $error = 'Invalid email format!';
}



  if (strlen($name) < 3 || strlen($name) > 32) {

    $error = 'name length is not valid !!';

  }


  //Validate email

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $error = 'the email is not valid !!';

  }

  //Compare first to second password

  if ($password != $rpassword) {

    $error = 'you entered password or confirm password not correctly !!';

  }

  //Check if email already exists

  $SQL = $db->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :email");

  $SQL->execute(array(':email' => $email));

  $EmailCount = $SQL->fetchColumn(0);

  if ($EmailCount > 0) {

    $error = 'the email is already exists !!';

  }

  //Make registeration

  if (empty($error)) {

    $insertUser = $db->prepare("INSERT INTO `users` VALUES(NULL, :name, :email, :password)");
    $passwordhashed = password_hash($password, PASSWORD_DEFAULT);
    $insertUser->execute(array(':name' => $name, ':password' => $passwordhashed, ':email' => $email));

    $done = "Your account has been created successfully you can login now!!";

    header('refresh: 1; url=login.php');

  }

}

if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
  exit();
}

?>

<head>
  <meta charset="UTF-8">
  <title>
    <?php echo htmlspecialchars($sitename); ?> | Register Page</title>
  <script src="https://kit.fontawesome.com/1b2b1806df.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <style>
    html,
    body {
      display: grid;
      height: 100%;
      width: 100%;
      place-items: center;
      font-family: 'Poppins', sans-serif;
      /* background: rgb(233,62,88); */
      /* background: linear-gradient(135deg, #1B8AF1, #B58DED); */
background: linear-gradient(248deg, rgba(233,62,88,1) 18%, rgba(141,87,64,1) 49%, rgba(5,128,129,1) 79%); 
    }

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

    }

    input[type=email],
    input[type=password],

    input[type=text] {
      width: 90%;
      padding: 12px 20px;
      margin: 12px 10px;
      display: inline-block;
      box-sizing: border-box;

      outline: none;
      color: #999;
      border-radius: 5px;
      border: 2px solid lightgrey;
      border-bottom-width: 2px;
      font-size: 17px;
      transition: all 0.3s ease;
    }

    input[type=email],
    input[type=password],
    input[type=checkbox],
    input[type=text]:focus::placeholder {
      color: #b3b3b3;
    }

    input[type=email],
    input[type=password]::placeholder {
      color: #999;
      transition: all 0.3s ease;
    }


    form {
      max-width: 30rem;
    }

    .login-container>form:nth-child(2)>a:nth-child(12) {
      padding: 0 5rem;
      margin: 0 auto;
    }
    .link {
     margin: 0 auto;
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
	text-decoration: none;}

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
      opacity: 0.8;
    }
  </style>
</head>

<body>

  <div class="login-container">
    <h2 style="margin-top:7px;">Signup Form</h2>
    <?php if (isset($error)){?>
      <p class="error">
        <?php echo $error; ?>
      </p>
    <?php } ?>
    <?php if (isset($done)){  ?>
      <p class="success">
        <?php echo $done; ?>
      </p>
    <?php sleep(3); } ?>
    <form method="POST" action="">
      <input type="text" id="name" name="name" placeholder="Full name" value="<?php echo htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : '') ?>" required>
      <br>
      <input type="text" id="email" onkeyup="validate_email(this.value)" name="email" placeholder="Email Address"
      value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : '') ?>" >
        <p id="msg"></p>
      <br>

      <input type="password" id="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars(isset($_POST['password']) ? $_POST['password'] : '') ?>" required>
    <br>
    <input type="checkbox" onclick="showpass()">Show Password
      <br>
     
      <input type="password" id="password2" name="password2" placeholder="Confirm Password" value="<?php echo htmlspecialchars(isset($_POST['password2']) ? $_POST['password2'] : '') ?>" required>
      <br>
      <button type="submit" name="signup" value="Sign up">Signup</button>
      <br>
      <p>You have an account? <a  class="link" href="login.php">Login here</a></p>
      <a  class="link" href="index.php">back to homepage <i class="fa-solid fa-house fa-lg" style="color: #000040;"></i></a>
    </form>
  </div>


<script>
   function showpass() {
    var ps = document.getElementById("password");
    if (ps.type === "password") {
      ps.type = "text";
    } else {
      ps.type = "password";
    }
  } 
</script>

   
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
        <script src="./assets/js/script.js"></script>
    </body>

</html>

