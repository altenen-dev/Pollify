<?php 
include './init/db.php';

// if ($_REQUEST["REQUEST_METHOD"] == "GET"){

    $Email = $_GET['q'];

    $sql = "SELECT * from users where username ='$Email'";
$res = $db->query($sql);
if($result = $res->fetch()){
    echo 'email is taken';
    
    
}else {
    echo 'email is available';
}
$db= null;

// }





?>